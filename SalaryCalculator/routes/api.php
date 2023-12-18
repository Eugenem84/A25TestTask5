<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// создание сотрудника
Route::post('/employees', [EmployeeController::class, 'create']);
// внесение отработанных часов
Route::post('/transaction', [TransactionController::class, 'store']);
// получение неоплаченных зарплат
Route::get('/unpaid-salaries', [TransactionController::class, 'getUnpaidSalaries']);
// выплата всех зарплат
Route::post('/pay-all-salaries', [TransactionController::class, 'payAllSalaries']);
