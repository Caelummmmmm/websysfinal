<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the tasks page displays saved tasks and accepts a new one', function () {
    Task::query()->delete();

    Task::create([
        'task_title' => 'Existing task',
        'description' => 'Already saved',
        'completed' => false,
    ]);

    $response = $this->get('/tasks');

    $response->assertOk();
    $response->assertSee('Existing task');
    $response->assertSee('Add Task');

    $response = $this->post('/tasks', [
        'task_title' => 'New task',
        'description' => 'Fresh task',
    ]);

    $response->assertRedirect('/tasks');
    $this->assertDatabaseHas('tasks', [
        'task_title' => 'New task',
        'description' => 'Fresh task',
    ]);
});
