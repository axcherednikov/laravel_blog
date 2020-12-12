<?php

namespace Tests\Feature;

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

        $this->actingAs($user = factory(\App\Models\User::class)->create());

        $this->post('/companies', $attributes = ['name' => 'Skillbox']);

        $this->assertDatabaseHas('companies', $attributes);
    }

    public function testItRequiresNameOnCreate()
    {
        $this->actingAs($user = factory(\App\Models\User::class)->create());

        $this->post('/companies', [])->assertSessionHasErrors(['name']);
    }

    public function testGuestMayNotCreateACompany()
    {
        $this->post('/companies', [])->assertRedirect('/login');
    }
}
