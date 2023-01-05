<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function index()
    {
       //
    }

    public function allTasks()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:255'],
            'user_id' => ['integer'],
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
    }

    public function update(Request $request, Task $idTask)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:255'],
            'user_id' => ['integer'],
        ]);

        $idTask->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
    }

    public function destroy(Task $idTask)
    {
        $idTask->delete();
    }
}
