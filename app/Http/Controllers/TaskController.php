<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    /*public function index()
    {
        $task = Task::first();

        return Inertia::render('Welcome', [
            'task' => $task,
        ]);
    }*/

    public function getAllTasks()
    {
        $tasks = Task::all();

        return Inertia::render('Welcome', [
            'tasks' => $tasks
        ]);
    }

    public function deleteById(Task $task)
    {
        $task->delete();
        return back();
    }

    /*public function edit()
    {
        $task = Task::first();

        return Inertia::render('Task/Edit', [
            'task' => $task,
        ]);
    }*/

    /*public function update(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'done' => ['boolean'],
        ]);

        $task = Task::first();
        $task->update($data);

        return back();
    }*/
}
