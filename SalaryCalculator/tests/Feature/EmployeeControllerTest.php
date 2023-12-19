<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmployeeControllerTest extends TestCase
{
use RefreshDatabase, CreatesApplication, WithoutMiddleware;

/**
* A basic feature test example.
*/
public function testCreateEmployee(): void
{
$data = [
'email' => 'test@example.com',
'password' => 'password123',
];

$response = $this->json('POST', '/api/employees', $data);

$response->assertStatus(201)
->assertJson(['email' => 'test@example.com']);

$this->assertDatabaseHas('employees', ['email' => 'test@example.com']);
}
}
