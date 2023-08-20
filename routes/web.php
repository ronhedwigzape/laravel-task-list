<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// redirect to `/tasks`
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// list of tasks (home)
Route::get('/tasks', function() { // anonymous function
    return view('index', [
        'tasks' => Task::latest()->paginate(10) // gets most recent tasks
    ]);
})->name('tasks.index');

// create task route
Route::view('/tasks/create', 'create')
->name('tasks.create');

// edit task route
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// show task route
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// post task route
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id ])
        ->with('success', 'Task created successfully');
})->name('tasks.store');

// toggle complete
Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');

// update task route
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id ])
        ->with('success', 'Task updated successfully');
})->name('tasks.update');

// delete task route
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// fallback
Route::fallback(function () {
    return "Still got somewhere";
});


//Route::get('/hello', function () {
//    return 'Hello'; // can't insert <tags> because it will escape from it
//})->name('world');
//
//Route::get('/halo', function () {
//    return redirect()->route('helliwordl');
//});
