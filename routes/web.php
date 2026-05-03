<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $tasks = auth()->user()->tasks;

    $taskCounts = [
        'todo' => $tasks->where('status', 'todo')->count(),
        'in_progress' => $tasks->where('status', 'in_progress')->count(),
        'done' => $tasks->where('status', 'done')->count(),
    ];
    
    

    return view('dashboard', compact('taskCounts'));

})->middleware(['auth'])->name('dashboard');
      
         

   

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {

    Route::resource('tasks', TaskController::class);

    Route::patch('/tasks/{task}/status', [TaskController::class, 'updatstatus'])
        ->name('tasks.updateStatus');

});

require __DIR__.'/auth.php';
