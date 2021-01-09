<?php

namespace Tests\Unit;

use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserCanHaveTasks()
    {
        $user = User::factory()->create();

        $attributes = Task::factory()->raw(['owner_id' => $user]);

        $user->tasks()->create($attributes);

        $this->assertEquals($attributes['title'], $user->tasks->first()->title);
    }

    public function testAUserCanHaveCompany()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $user->company()->create(['name' => 'BP']);
        $this->assertEquals('BP', $user->company->name);
    }
}
