<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use http\Env\Request;

class EmployeeController
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:employees', //проверка валидности email
            'password' => 'required', //проверка наличие пароля
        ]);

        $data['password'] = bcrypt($data['password']); // хеширование пароля
        $employee = Employee::create($data); //создание сотрудника
        return response()->json($employee, 201); //возврат json ответа с кодом 201
    }
}
