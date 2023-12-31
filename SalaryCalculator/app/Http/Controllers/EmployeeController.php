<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController
{
    public function create(Request $request)
    {
        //валидация данных
        $data = $request->validate([
            'email' => 'required|email|unique:employees', //проверка валидности email
            'password' => 'required', //проверка наличие пароля
        ]);

        $data['password'] = bcrypt($data['password']); // хеширование пароля

        //создание нового работника
        $employee = Employee::create($data);

        return response()->json($employee, 201); //возврат json ответа с кодом 201
    }
}
