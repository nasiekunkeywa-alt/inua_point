<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_based_access_control()
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $officer = Role::create(['name' => 'loan_officer']);
        $member = Role::create(['name' => 'member']);

        // Create users for each role
        $adminUser = User::factory()->create(['email' => 'admin@inua.com', 'password' => bcrypt('password'), 'role_id' => $admin->id, 'email_verified_at' => now()]);
        $officerUser = User::factory()->create(['email' => 'officer@inua.com', 'password' => bcrypt('password'), 'role_id' => $officer->id, 'email_verified_at' => now()]);
        $memberUser = User::factory()->create(['email' => 'member@inua.com', 'password' => bcrypt('password'), 'role_id' => $member->id, 'email_verified_at' => now()]);

        $routes = [
            '/roles' => ['admin'],
            '/verifications' => ['loan_officer'],
            '/payments/create' => ['member'],
        ];

        // Admin should be allowed everywhere (superuser)
        foreach ($routes as $uri => $allowed) {
            $response = $this->actingAs($adminUser)->get($uri);
            $response->assertStatus(200, "Admin should access {$uri}");
        }

        // Officer: can access verifications, not roles or member-only payments/create
        $this->actingAs($officerUser)->get('/verifications')->assertStatus(200);
        $this->actingAs($officerUser)->get('/roles')->assertStatus(403);
        $this->actingAs($officerUser)->get('/payments/create')->assertStatus(403);

        // Member: can access payments/create, denied verifications and roles
        $this->actingAs($memberUser)->get('/payments/create')->assertStatus(200);
        $this->actingAs($memberUser)->get('/verifications')->assertStatus(403);
        $this->actingAs($memberUser)->get('/roles')->assertStatus(403);
    }
}
