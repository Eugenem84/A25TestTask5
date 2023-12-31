<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

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
        $hourlyRate = 1000;

        $unpaidSalaries = Transaction::where('paid', false)
            ->get()
            ->groupBy('employee_id')
            ->map(function ($transactions) use ($hourlyRate) {
               return $transactions->sum('hours') * $hourlyRate;
            }); //получение неоплаченных часов для каждого сотрудника
        info($unpaidSalaries);
        return response()->json($unpaidSalaries); //возвращаем неоплаченные зарплаты
    }

    public function payAllSalaries()
    {
        Transaction::where('paid', false)->update(['paid' => true]); //Пометка всех транзакций как оплаченных
        return response()->json(['message' => 'All salaries paid.']);
    }
}
