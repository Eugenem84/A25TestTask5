<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreTransaction()
    {
        Employee::factory()->create(['id' => 1]);
        // данные для транзации
        $data = [
            'employee_id' => 1,
            'hours' => 8,
        ];
        // апи
        $response = $this->postJson('/api/transaction', $data);
        // смотрим статус
        $response->assertStatus(201);
        //сверяем данные
        $this->assertDatabaseHas('transactions', [
            'employee_id' => 1,
            'hours' => 8,
        ]);
    }
}
