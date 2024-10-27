<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\{getJson, postJson, patchJson, deleteJson};


uses(RefreshDatabase::class);

beforeEach(function () {
    $this->adminRole = Role::create(['name' => 'admin']);

    $this->admin = User::factory()->create();
    $this->admin->assignRole($this->adminRole);

    $this->user = User::factory()->create();
});

it('lists users for admin', function () {
    Sanctum::actingAs($this->admin);
    $response = $this->get('/api/user');
    $response->assertStatus(200);
});


it('block users for user', function () {
    Sanctum::actingAs($this->user);
    $response = $this->get('/api/user');
    $response->assertStatus(403);
});


it('store user success', function () {
    $request =[
        "name" => "test",
        "email" => "test@test.test",
        "password" =>"testtesttest",
        "password_confirmation" => "testtesttest"
    ];
    $response = $this->postJson('/api/user',$request);
    $response->assertStatus(200);
    $this -> assertDatabaseHas('users',['email' => 'test@test.test']);
});


it('store user fail', function () {
    $request =[
        "name" => "test",
        "email" => "testtesttest",
        "password" =>"testtesttest",
        "password_confirmation" => "testtesttest"
    ];
    $response = $this->postJson('/api/user',$request);
    $response->assertStatus(422);
    $this -> assertDatabaseMissing('users',['email' => 'testtesttest']);
});


it('show user success', function () {
    Sanctum::actingAs($this->user);
    $response= $this->get('/api/user/'.$this->user->id);
    $response->assertStatus(200);
});

it('update user success', function () {
    Sanctum::actingAs($this->user);
    $request =[
        "name" => "test",
        "email" => "test@test.test",
        "password" =>"testtesttest",
        "password_confirmation" => "testtesttest"
    ];
    $response = $this->patchJson('/api/user/'.$this->user->id,$request);
    $this -> assertDatabaseHas('users',['email' => 'test@test.test']);
    $response->assertStatus(200);
});


it('destroy user success', function () {
    Sanctum::actingAs($this->user);
    $response = $this->delete('/api/user/'.$this->user->id);
    expect(User::find($this->user->id))->toBeNull();
    $response->assertStatus(200);
});


