<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PayAllSalariesTest extends TestCase
{
    use RefreshDatabase;

    public function test_pay_all_salaries(): void
    {
        $employee = Employee::factory()->create();

        Transaction::factory()->create(['employee_id' => $employee->id,'paid' => false]);
        Transaction::factory()->create(['employee_id' => $employee->id,'paid' => false]);

        $response = $this->postJson('/api/pay-all-salaries');

        $response->assertStatus(200);

        $this->assertTrue(Transaction::where('paid', true)->count() === 2);
    }
}
