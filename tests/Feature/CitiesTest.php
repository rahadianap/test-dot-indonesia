<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class CitiesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $user = User::first();

        $this->actingAs($user);
    }

    public function test_check_search_province_success()
    {
        $response = $this->get('/api/search/cities?id=1');

        $response->assertStatus(200);
    }

    public function test_check_search_province_not_found()
    {
        $response = $this->get('/api/search/cities?id=1000000');

        $response->assertStatus(404);
    }
}
