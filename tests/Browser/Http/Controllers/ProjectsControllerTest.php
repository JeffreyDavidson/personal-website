<?php

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('renders responsive project images without overflow', function (string $route, string $device) {
    $this->withVite();
    Storage::fake('public', ['url' => '/test-project-images?path=']);
    Storage::disk('public')->put('showcase.png', UploadedFile::fake()->image('showcase.png', 1280, 720)->getContent());

    // Serve only these isolated fixtures through the browser test application.
    Route::get('/test-project-images', function (Request $request) {
        $path = ltrim((string) $request->query('path'), '/');
        abort_unless(in_array($path, ['showcase.png', 'responsive/showcase-640.webp', 'responsive/showcase-1280.webp'], true), 404);

        return response(Storage::disk('public')->get($path), 200, [
            'Content-Type' => Storage::disk('public')->mimeType($path),
        ]);
    });

    $project = Project::query()->create([
        'title' => 'Screenshot layout fixture',
        'description' => 'A test project with an uploaded screenshot.',
        'featured_image_path' => 'showcase.png',
        'is_featured' => true,
        'status' => ProjectStatus::Published,
    ]);

    expect($project->fresh()->featured_image_path)->toBe('showcase.png');

    $page = visit(route($route, $route === 'projects.show' ? $project : [], absolute: false))
        ->on()
        ->{$device}();

    $page->assertScript('document.querySelectorAll("main picture img").length', 1)
        ->assertScript('document.querySelector("main picture img").complete && document.querySelector("main picture img").naturalWidth > 0')
        ->assertScript('document.querySelector("main picture img").currentSrc.includes("/responsive/showcase-")')
        ->assertScript('document.documentElement.scrollWidth <= document.documentElement.clientWidth')
        ->assertScript('Math.abs(document.querySelector("main picture img").getBoundingClientRect().width / document.querySelector("main picture img").getBoundingClientRect().height - 16 / 9) < 0.02')
        ->assertNoJavaScriptErrors();
})->with(['projects.index', 'projects.show'])->with(['mobile', 'desktop']);
