<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class TaskController extends Controller
{
 
    public function index(Request $request)
    {
        $query = auth()->user()->tasks()->with('category');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category) {
            $query->where('categorie_id', $request->category);
        }

        $tasks = $query->latest()->get();

        $categories = Category::all();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

   
    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'todo';

        Task::create($data);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        $categories = Category::all();

        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
             'status' => 'required|in:todo,in_progress,done'
            
        ]);

        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function updatStatus(Task $task)
    {
        $this->authorizeTask($task);


        $nextStatus = match ($task->status) {
            'todo' => 'in_progress',
            'in_progress' => 'done',
            default => 'todo',
        };

        $task->update(['status' => $nextStatus]);

        return back();
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
    }
}