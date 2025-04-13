<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskPosted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Get tasks for the listing
        $tasks = $query->latest()->paginate(10);

        // Calculate statistics for the dashboard
        $statsData = [
            'total' => Task::where('user_id', Auth::id())->count(),
            'completed' => Task::where('user_id', Auth::id())->where('completed', true)->count(),
            'pending' => Task::where('user_id', Auth::id())->where('completed', false)->count(),
            'overdue' => Task::where('user_id', Auth::id())
                ->where('completed', false)
                ->where('deadline', '<', now())
                ->count(),
        ];

        // Calculate completion rate
        if ($statsData['total'] > 0) {
            $statsData['completion_rate'] = round(($statsData['completed'] / $statsData['total']) * 100);
        } else {
            $statsData['completion_rate'] = 0;
        }

        // Calculate total penalties for overdue tasks
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
            'description' => ['string', 'min:10'],
            'deadline' => ['date', 'nullable'],
            'price' => ['numeric', 'min:1'],
        ]);

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
        Log::info('Update method called for task ID: ' . $id);
        Log::info('Request method: ' . request()->method());
        Log::info('Request data: ', request()->all());

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
        $task->update(['completed' => true]);

        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks');
    }
}
