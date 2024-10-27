<?php

use App\Models\User;
use App\Models\Client;
use App\Models\project;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{getJson, postJson, patchJson, deleteJson};

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->client = Client::factory()->create();
});

it('lists projects', function () {
    Sanctum::actingAs($this->user);
    $response = $this->get('/api/project');
    $response->assertStatus(200);
});

it('store projects', function () {
    $request =[
        'title' => 'project',
        'description' => 'description',
        'deadline' => '2026-10-10',
        'user_id' => $this->user->id,
        'client_id' => $this->client->id,
        'status' => 'open',
    ];
    Sanctum::actingAs($this->user);
    $response = $this->postJson('/api/project',$request);
    $response->assertStatus(200);
    $this -> assertDatabaseHas('projects',['title' => 'project']);
});

it('update projects', function () {
    $project = Project::factory()->create(['user_id' => $this->user->id]);
    $request =[
        'title' => 'project',
        'description' => 'description',
        'deadline' => '2026-10-10',
        'user_id' => $this->user->id,
        'client_id' => $this->client->id,
        'status' => 'open',
    ];
    Sanctum::actingAs($this->user);
    $response = $this->patchJson('/api/project/'.$project->id,$request);
    $response->assertStatus(200);
    $this -> assertDatabaseHas('projects',['title' => 'project']);
});

it('destroy project success', function () {
    Sanctum::actingAs($this->user);
    $project = Project::factory()->create(['user_id' => $this->user->id]);
    $response = $this->delete('/api/project/'.$project->id);
    expect(Project::find($project->id))->toBeNull();
    $response->assertStatus(200);
});
