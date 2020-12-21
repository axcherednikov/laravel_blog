<?php

namespace Tests\Unit;

use App\Models\Company;
use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserCanHaveTasks()
    {
        $user = factory(User::class)->create();

        $attributes = factory(Task::class)->raw(['owner_id' => $user]);

        $user->tasks()->create($attributes);

        $this->assertEquals($attributes['title'], $user->tasks->first()->title);
    }

    public function testAUserCanHaveCompany()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        $user->company()->create(['name' => 'BP']);
        $this->assertEquals('BP', $user->company->name);
    }
}
