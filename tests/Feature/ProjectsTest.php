<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_create_projects()
    {
        $attributes = factory(Project::class)->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view__a_single_project()
    {
        $project = factory(Project::class)->create([
            'owner_id' => function() {
                return factory(User::class)->create()->id;
            }
        ]);

        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)
            ->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->actingAs(factory(User::class)->create());

        $this->post('projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->actingAs(factory(User::class)->create());

        $this->post('projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->withExceptionHandling();

        $this->actingAs($user = factory(User::class)->create());

        $project = factory(Project::class)->create([
            'owner_id' => $user->id
        ]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->descriotion);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_or_others()
    {
        $this->actingAs(factory(User::class)->create());

        $project = factory(Project::class)->create([
            'owner_id' => factory(User::class)->create()
        ]);

        $this->get($project->path())->assertStatus(403);
    }
}
