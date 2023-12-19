<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUnpaidSalariesTest extends TestCase
{
    //очистка базы
    use RefreshDatabase;

    public function testGetUnpaidSalaries(): void
    {
        //создаем работников
        $employee1 = Employee::factory()->create();
        $employee2 = Employee::factory()->create();

        //создаем транзакции
        $unpaidTransaction1 = Transaction::factory()->create([
            'employee_id' => $employee1->id,
            'paid' => false,
            'hours' => 3,
        ]);

        $unpaidTransaction3 = Transaction::factory()->create([
            'employee_id' => $employee1->id,
            'paid' => false,
            'hours' => 2,
        ]);

        $unpaidTransaction2 = Transaction::factory()->create([
            'employee_id' => $employee2->id,
            'paid' => false,
            'hours' => 4,
        ]);
        //выплаченная транзакция не должна учитываться в сумме не выплаченных
        $paidTransaction = Transaction::factory()->create(['employee_id' => $employee1->id,'paid' => true]);

        //обращаемся к апи
        $response = $this->getJson('/api/unpaid-salaries');

        //статус 200 ок
        $response->assertStatus(200);

        //ожидаемый результат
        $this->assertEquals(['1' => 5000, '2' => 4000,],$response->json());
    }
}
