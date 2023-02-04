<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

Route::get(
    '/',
    [TodoListController::class, 'index']
);

Route::post(
    '/saveItem',
    [TodoListController::class, 'saveItem']
)->name('saveItem');

Route::post(
    '/markCompleteRoute/{id}',
    [TodoListController::class, 'markComplete']
)->name('markComplete');
Route::post(
    '/deleteCompleteRoute/{id}',
    [TodoListController::class, 'deleteComplete']
)->name('deleteComplete');