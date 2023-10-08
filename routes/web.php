<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('employees', EmployeeController::class);
Route::delete('/employees/softDelete/{id}', [EmployeeController::class, 'softDelete'])->name('employees.softDelete');
Route::put('/employees/{id}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');

Route::get('/employees/trash', [EmployeeController::class, 'trash'])->name('employees.trash');
