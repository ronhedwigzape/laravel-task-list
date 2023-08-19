<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function() { // anonymous function
    return view('index', [
        'tasks' => \App\Models\Task::latest()->where('completed', true)->get() // gets most recent tasks where tasks are completed
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id) {
    return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');

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
