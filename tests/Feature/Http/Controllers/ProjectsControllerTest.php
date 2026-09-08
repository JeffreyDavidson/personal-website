<?php

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('keeps repository URLs out of public project markup and structured data', function (?string $website) {
    $project = Project::query()->create([
        'title' => 'Private repository project',
        'description' => 'Public case study, private source.',
        'github_url' => 'https://github.com/example/confidential-repository',
        'url' => $website,
        'status' => ProjectStatus::Published,
    ]);

    $response = $this->get(route('projects.show', $project));

    $response->assertOk()
        ->assertDontSee('confidential-repository', false)
        ->assertDontSee('Explore the code')
        ->assertSee('Discuss a similar project');

    if ($website !== null) {
        $response->assertSee($website, false);
    }

    expect($project->fresh()->github_url)->toBe('https://github.com/example/confidential-repository');
})->with([null, 'https://example.com/product']);

it('loads only the related projects displayed on a project page', function () {
    $project = Project::query()->create([
        'title' => 'Current Project',
        'slug' => 'current-project',
        'description' => 'The current project.',
        'status' => ProjectStatus::Published,
        'sort_order' => 1,
    ]);

    foreach (range(2, 5) as $sortOrder) {
        Project::query()->create([
            'title' => "Related Project {$sortOrder}",
            'slug' => "related-project-{$sortOrder}",
            'description' => "Related project {$sortOrder}.",
            'status' => ProjectStatus::Published,
            'sort_order' => $sortOrder,
        ]);
    }

    Project::query()->create([
        'title' => 'Draft Project',
        'slug' => 'draft-project',
        'description' => 'A draft project.',
        'status' => ProjectStatus::Draft,
        'sort_order' => 0,
    ]);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertViewHas('otherProjects', fn ($otherProjects): bool => $otherProjects->count() === 3)
        ->assertSee('Related Project 2')
        ->assertSee('Related Project 4')
        ->assertDontSee('Related Project 5')
        ->assertDontSee('Draft Project');
});
