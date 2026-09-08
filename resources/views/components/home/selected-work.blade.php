@props(['projects'])
@inject('projectImages', 'App\Services\ResponsiveImageVariants')

@if($projects->isNotEmpty())
<section data-home-work aria-labelledby="work-heading" class="border-t border-brand-800 bg-brand-950 py-14 text-white sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-5 sm:mb-10">
            <h2 id="work-heading" class="text-3xl font-semibold tracking-tight sm:text-4xl">Selected work</h2>
            <a href="{{ route('projects.index') }}" class="rounded py-2 text-sm font-semibold text-brand-200 underline decoration-brand-600 underline-offset-4 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-300">View all projects</a>
        </div>

        <div class="divide-y divide-brand-800 border-y border-brand-800">
            @foreach($projects as $project)
                <article data-project-entry class="py-8 sm:py-12">
                    @if($project->featured_image_url)
                        @php
                            $featuredImageSrcset = $projectImages->srcset($project->featured_image_path);
                        @endphp
                        <div class="mb-8 overflow-hidden rounded-xl bg-brand-900">
                            <picture>
                                @if($featuredImageSrcset)
                                    <source type="image/webp" srcset="{{ $featuredImageSrcset }}" sizes="(min-width: 1280px) 1216px, (min-width: 640px) calc(100vw - 3rem), calc(100vw - 2rem)">
                                @endif
                                <img src="{{ $project->featured_image_url }}" alt="" loading="lazy" decoding="async" class="aspect-video w-full object-contain">
                            </picture>
                        </div>
                    @endif

                    <div class="grid gap-6 lg:grid-cols-2 lg:gap-16">
                        <div>
                            <h3 class="text-balance text-3xl font-semibold tracking-tight sm:text-4xl">
                                <a href="{{ route('projects.show', $project) }}" class="group inline-flex items-start gap-4 rounded hover:text-brand-200 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-300">
                                    {{ $project->title }}
                                    <x-heroicon-o-arrow-up-right class="mt-2 size-6 shrink-0 stroke-brand-300" aria-hidden="true" />
                                </a>
                            </h3>
                            @if($project->tech_stack)
                                <ul aria-label="Technologies used for {{ $project->title }}" class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm text-brand-200">
                                    @foreach($project->tech_stack as $tech)
                                        <li>{{ $tech }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="max-w-xl">
                            <p class="text-base leading-8 text-brand-100 sm:text-lg">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project) }}" class="mt-5 inline-block rounded py-2 text-sm font-semibold text-brand-200 underline decoration-brand-600 underline-offset-4 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-300">
                                Explore the project<span class="sr-only">: {{ $project->title }}</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
