<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskPosted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->query('status') === 'not-completed') {
            $query->where('completed', false);
        } elseif ($request->query('status') === 'completed') {
            $query->where('completed', true);
        }

        $tasks = $query->latest()->paginate(10);

        $statsData = [
            'total' => Task::where('user_id', Auth::id())->count(),
            'completed' => Task::where('user_id', Auth::id())->where('completed', true)->count(),
            'pending' => Task::where('user_id', Auth::id())->where('completed', false)->count(),
            'overdue' => Task::where('user_id', Auth::id())
                ->where('completed', false)
                ->where('deadline', '<', now())
                ->count(),
        ];

        if ($statsData['total'] > 0) {
            $statsData['completion_rate'] = round(($statsData['completed'] / $statsData['total']) * 100);
        } else {
            $statsData['completion_rate'] = 0;
        }

        $statsData['total_penalties'] = Task::where('user_id', Auth::id())
            ->where('completed', false)
            ->where('deadline', '<', now())
            ->sum('price');

        return view('task.index', compact('tasks', 'statsData'));
    }

    public function create()
    {
        return view('task.create');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view(
            'task.show',
            ['task' => $task]
        );
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'string', 'min:5'],
            'description' => ['string', 'nullable'],
            'deadline' => ['date', 'nullable'],
            'price' => ['numeric', 'min:1'],
        ]);

        $user = Auth::user();

        if ($user->balance < request()->price) {
            throw ValidationException::withMessages([
                'errors' => "Task price higher than user balance",
            ]);
        }

        $user->balance -= request()->price;
        $user->save();

        $task = Task::create([
            'title' => request('title'),
            'user_id' => Auth::user()->id,
            'description' => request('description'),
            'deadline' => request('deadline'),
            'price' => request('price'),
        ]);

        Mail::to(Auth::user()->email)->queue(new TaskPosted($task));

        return redirect('/tasks');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('task.edit', ['task' => $task]);
    }

    public function update($id)
    {
        request()->validate([
            'title' => ['required', 'string', 'min:5'],
            'description' => ['string', 'min:10'],
            'deadline' => ['date', 'nullable'],
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => request('title'),
            'description' => request('description'),
            'deadline' => request('deadline'),
        ]);

        return redirect('/tasks');
    }

    public function complete($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->update(['completed' => true]);

            if ($task->deadline == null) {
                $user = Auth::user();

                $user->update([
                    'balance' => $user->balance + $task->price
                ]);

                return redirect('/tasks');
            }

            if ($task->deadline && $task->price) {
                $now = now();
                $deadline = \Carbon\Carbon::parse($task->deadline);

                if ($now->lt($deadline)) {
                    $user = Auth::user();

                    $user->update([
                        'balance' => $user->balance + $task->price
                    ]);
                }
            }
        }

        return redirect('/tasks');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks');
    }
}
