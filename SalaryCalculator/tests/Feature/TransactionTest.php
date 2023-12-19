<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreTransaction()
    {

        $data = [
            'employee_id' => 1,
            'hours' => 8,
        ];

        $response = $this->postJson('/api/transaction', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true, // ожидаемый формат ответа
                 ]);

        $this->assertDatabaseHas('transactions', ['hours' => 8]);
    }
}
