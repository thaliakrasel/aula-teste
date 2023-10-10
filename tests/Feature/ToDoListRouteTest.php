<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoListRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_checking_the_home_page_route_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function test_checking_the_tasks_page_route_a_successful_response(): void
    //  {
    //     $response = $this->get('/tasks');
    //     $response->assertStatus(200);
    //      $response->assertSee('ToDo List');
    //  }

    //public function test_checking_the_tasks_edit_page_route_a_successful_response(): void
    //{
    //   $response = $this->get('/tasks/edit');
    //
    //   $response->assertStatus(200);
    // }

    //public function test_checking_the_tasks_create_page_route_a_successful_response(): void
    //{
    //   $response = $this->get('/tasks/create');

    //    $response->assertStatus(200);
    // }
}
