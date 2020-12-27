<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAUserCanCreateACompany()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $this->post('/companies', $attributes = ['name' => 'Skillbox']);

        $this->assertDatabaseHas('companies', $attributes);
    }

    public function testItRequiresNameOnCreate()
    {
        $this->actingAs($user = User::factory()->create());

        $this->post('/companies', [])->assertSessionHasErrors(['name']);
    }

    public function testGuestMayNotCreateACompany()
    {
        $this->post('/companies', [])->assertRedirect('/login');
    }
}
