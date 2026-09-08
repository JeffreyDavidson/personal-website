<?php

use App\Enums\ProjectStatus;
use App\Enums\TestimonialStatus;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('presents featured projects without duplicated summaries or invented artwork', function (int $count) {
    foreach (range(1, $count) as $index) {
        Project::query()->create([
            'title' => "Selected project {$index}",
            'description' => "A distinct project summary {$index}.",
            'status' => ProjectStatus::Published,
            'is_featured' => true,
            'sort_order' => $index,
        ]);
    }

    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('Selected work')
        ->assertDontSee('Domain overview')
        ->assertDontSee('home-case-study-fallback');
    expect(substr_count($response->getContent(), 'data-project-entry'))->toBe($count);
    expect(substr_count($response->getContent(), 'A distinct project summary 1.'))->toBe(1);
})->with([1, 2, 4]);

it('omits selected work when no projects are featured', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('data-home-work', false);
});

it('flashes invalid newsletter input for recovery', function () {
    $this->from(route('home'))
        ->post(route('newsletter.subscribe'), ['email' => 'not-an-email'])
        ->assertSessionHasErrors('email')
        ->assertSessionHasInput('email', 'not-an-email');

});

it('presents honest inquiry links and one media destination per channel', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Discuss your project')
        ->assertDontSee('Book a review')
        ->assertSee('Listen to the podcast')
        ->assertDontSee('Browse the podcast')
        ->assertDontSee('Field notes');
});

it('loads only the testimonials displayed on the homepage while retaining the approved total', function () {
    foreach (range(1, 5) as $sortOrder) {
        Testimonial::query()->create([
            'name' => "Approved Client {$sortOrder}",
            'body' => "Approved recommendation {$sortOrder}.",
            'status' => TestimonialStatus::Approved,
            'sort_order' => $sortOrder,
        ]);
    }

    Testimonial::query()->create([
        'name' => 'Pending Client',
        'body' => 'Pending recommendation.',
        'status' => TestimonialStatus::Pending,
        'sort_order' => 6,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertViewHas('testimonials', fn ($testimonials): bool => $testimonials->count() === 3)
        ->assertViewHas('approvedTestimonialCount', 5)
        ->assertSee('Approved Client 1')
        ->assertSee('Approved Client 3')
        ->assertDontSee('Approved Client 4')
        ->assertDontSee('Pending Client');
});
