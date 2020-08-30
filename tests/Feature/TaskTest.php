<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testUnauthenticatedRoutes()
    {
        $unauthenticatedResponse = $this->json(
            'GET',
            route('tasks.index')
        );
        $unauthenticatedResponse->assertUnauthorized();
    }

    public function testIndex()
    {
        $response = $this->actingAs($this->user)->get(
            route('tasks.index')
        );
        $response->assertStatus(200);
        $response->assertViewHas('tasks');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(
            route('tasks.create')
        );
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)->post(
            route('tasks.store'), [
                'name' => 'Sally'
            ]
        );
        $response->assertRedirect(route('tasks.create'));
        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Sally'
        ]);
    }

    public function testShow()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->actingAs($this->user)->get(
            route('tasks.show', ['id' => $task->id])
        );
        $response->assertStatus(200);
        $response->assertViewHas('task');
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
        ]);
        $response = $this->actingAs($this->user)->get(
            route('tasks.edit', ['id' => $task->id])
        );
        $response->assertStatus(200);
        $response->assertViewHas('task');
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->actingAs($this->user)->put(
            route('tasks.update', ['id' => $task->id]),
            [
                'name' => 'Edited task',
                'check' => 'completed'
            ]
        );
        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'name' => 'Edited task',
            'completed' => '1'
        ]);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->actingAs($this->user)->delete(
            route('tasks.destroy', ['id' => $task->id])
        );
        $this->assertDeleted($task);
    }

    public function testCheck()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->actingAs($this->user)->post(
            route('tasks.check', ['id' => $task->id])
        );
        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
            'completed' => '1'
        ]);
    }
}
