<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoListCrudTest extends TestCase
{

    public function test_admin_can_add_new_task()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->post('/tasks', [
            'name' => 'Estudar para a prova',
            'completed' => true,
        ]);
        // dd($response->getContent());
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/tasks');
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas('tasks', ['name' => 'Estudar para a prova', 'completed' => true]);
    }

    public function test_admin_can_see_the_edit_task_page()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $task = Task::factory()->create();
        $response = $this->actingAs($admin)->get('/tasks/'. $task->id. '/edit');
        $response->assertStatus(200);
        $response->assertSee($task->name);
    }

    public function test_admin_can_update_task()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        Task::truncate();
        Task::factory()->create();
        $this->assertCount(1, Task::all());
        $task = Task::first();
        $response = $this->actingAs($admin)->put('/tasks/'. $task->id, [
            'name'  => 'Updated Task',
            'completed' => false
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/tasks');
        $this->assertEquals('Updated Task', Task::first()->name);
        $this->assertEquals(false, Task::first()->completed);
    }

    public function test_admin_can_delete_task()
    {
       $admin = User::factory()->create(['is_admin' => 1]);
       $task = Task::factory()->create();
       $this->assertEquals(1, Task::count());
       $response = $this->actingAs($admin)->delete('/tasks/'. $task->id);
       $response->assertStatus(302);
       $this->assertEquals(0, Task::count());
    }
}