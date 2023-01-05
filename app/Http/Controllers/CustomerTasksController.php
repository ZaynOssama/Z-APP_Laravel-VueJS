<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerTasksController extends Controller
{

    public function index()
    {
       //
    }

    public function allTasks()
    {
        $user = auth()->user();
        $data = DB::table('tasks')->join('users', 'users.id', '=', 'tasks.user_id')->select('tasks.id', 'tasks.title', 'tasks.description', 'users.name', 'tasks.user_id', 'tasks.created_at', 'tasks.updated_at')->where('tasks.user_id', '=', $user->id)->get();
        return $data;
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);
    }

    public function update(Request $request, Task $idTask)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:20'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $idTask->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }

    public function destroy(Task $idTask)
    {
        $idTask->delete();
    }
}
