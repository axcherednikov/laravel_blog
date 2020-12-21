<?php

namespace Tests\Feature;

use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAUserCanCreateATask()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = factory(\App\Models\User::class)->create());

        $attributes = factory(Task::class)->raw(['owner_id' => $user]);

        $this->post('/tasks', $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

    public function testGuestMayNotCreateTask()
    {
        $this->post('/tasks', [])->assertRedirect('/login');
    }
}
