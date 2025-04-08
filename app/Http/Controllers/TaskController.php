<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskPosted;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::with('category')->latest()->paginate(3);

        return view('task.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create() {
        return view('task.create');
    }

    public function show($id) {
        $task = Task::find($id);
        return view('task.show', 
        ['task' => $task]);
    }

    public function store() {
        request()->validate([
            'title' => ['required', 'string', 'min:5'],
            'description' => ['string', 'min:10'],
            'deadline' => ['date', 'nullable'],
        ]);
    
        $task = Task::create([
            'title'=> request('title'),
            'user_id' => Auth::user()->id,
            'description'=> request('description'),
            'deadline' => request('deadline'),
            'category_id' => 1,
        ]);

        Mail::to(Auth::user()->email)->queue(new TaskPosted($task));
    
        return redirect('/tasks');
    }

    public function edit($id) {
        $task = Task::find($id);
        return view('task.edit', ['task' => $task]);
    }

    public function update($id) {
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
            'category_id' => 1,
        ]);
    
        return redirect('/tasks');
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/tasks');
    }
}
