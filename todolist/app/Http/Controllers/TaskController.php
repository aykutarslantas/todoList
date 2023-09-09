<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::getUserTasks();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);
        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
        ]);

        return redirect('/tasks');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $completed = $request->input('completed');
        $task->completed = filter_var($completed, FILTER_VALIDATE_BOOLEAN);

        $task->save();
        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();
        return redirect('/tasks');
    }


}
