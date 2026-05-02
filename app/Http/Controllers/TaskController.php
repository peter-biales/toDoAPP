<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return Inertia::render('App', [
            'tasks' => $tasks
        ]);
    }

    public function addTask(Request $request) {
        
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        Task::create([
            'title' => $data['title'],
            'done' => false,
        ]);

        return back();
    }

    public function updateTask(Request $request) {
        $data = $request->validate([
            'id' => ['required', 'integer', 'exists:tasks,id'],
            'title' => ['required', 'string', 'max:255'],
            'done' => ['boolean'],
        ]);

        $task = Task::findOrFail($data['id']);
        $task->update($data);

        return back();
    }

    public function deleteTask(Task $task) {
        $task->delete();
        return back();
    }

    /*public function deleteTask(Request $request) {
        $data = $request->validate([
            'id' => ['required', 'integer', 'exists:tasks,id'],
            'title' => ['required', 'string', 'max:255'],
            'done' => ['boolean'],
        ]);

        $task = Task::findOrFail($data['id']);
        $task->->delete();

        return back();
    }*/
}
