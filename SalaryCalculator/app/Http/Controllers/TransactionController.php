<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use http\Env\Request;

class TransactionController
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id', //проверка существования сотрудника
            'hours' => 'required|numeric|min:0' //проверка наличия отработанных часов и их положительности
        ]);

        $transaction = Transaction::create($data);
        return response()->json($transaction, 201); //Возврат Json-ответа
    }

    public function getUnpaidSalaries()
    {
        $unpaidSalaries = Transaction::where('paid', false)
            ->get()
            ->groupBy('employee_id')
            ->map(function ($transactions){
               return $transactions->sum('hours');
            }); //получение неоплаченных зарплат для каждого сотрудника
        return response()->json($unpaidSalaries); //возвращаем неоплаченные зарплаты
    }

    public function payAllSalaries()
    {
        Transaction::where('paid', false)->update(['paid' => true]); //Пометка всех транзакций как оплаченных
        return response()->json(['message' => 'All salaries paid.']);
    }
}
