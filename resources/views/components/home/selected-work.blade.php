@props(['projects'])
@inject('projectImages', 'App\Services\ResponsiveImageVariants')

@if ($projects->isNotEmpty())
    <section
        data-home-work
        aria-labelledby="work-heading"
        class="border-brand-800 bg-brand-950 border-t py-14 text-white sm:py-20"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-5 sm:mb-10">
                <h2 id="work-heading" class="text-3xl font-semibold tracking-tight sm:text-4xl">Selected work</h2>
                <a
                    href="{{ route('projects.index') }}"
                    class="text-brand-200 decoration-brand-600 focus-visible:outline-brand-300 rounded py-2 text-sm font-semibold underline underline-offset-4 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4"
                >View all projects</a>
            </div>

            <div class="divide-brand-800 border-brand-800 divide-y border-y">
                @foreach ($projects as $project)
                    <article data-project-entry class="py-8 sm:py-12">
                        @if ($project->featured_image_url)
                            @php
                                $featuredImageSrcset = $projectImages->srcset($project->featured_image_path);
                            @endphp
                            <div class="bg-brand-900 mb-8 overflow-hidden rounded-xl">
                                <picture>
                                    @if ($featuredImageSrcset)
                                        <source
                                            type="image/webp"
                                            srcset="{{ $featuredImageSrcset }}"
                                            sizes="(min-width: 1280px) 1216px, (min-width: 640px) calc(100vw - 3rem), calc(100vw - 2rem)"
                                        />
                                    @endif
                                    <img
                                        src="{{ $project->featured_image_url }}"
                                        alt=""
                                        loading="lazy"
                                        decoding="async"
                                        class="aspect-video w-full object-contain"
                                    />
                                </picture>
                            </div>
                        @endif

                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-16">
                            <div>
                                <h3 class="text-3xl font-semibold tracking-tight text-balance sm:text-4xl">
                                    <a
                                        href="{{ route('projects.show', $project) }}"
                                        class="group hover:text-brand-200 focus-visible:outline-brand-300 inline-flex items-start gap-4 rounded focus-visible:outline-2 focus-visible:outline-offset-4"
                                    >
                                        {{ $project->title }}
                                        <x-heroicon-o-arrow-up-right
                                            class="stroke-brand-300 mt-2 size-6 shrink-0"
                                            aria-hidden="true"
                                        />
                                    </a>
                                </h3>
                                @if ($project->tech_stack)
                                    <ul
                                        aria-label="Technologies used for {{ $project->title }}"
                                        class="text-brand-200 mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm"
                                    >
                                        @foreach ($project->tech_stack as $tech)
                                            <li>{{ $tech }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="max-w-xl">
                                <p class="text-brand-100 text-base leading-8 sm:text-lg">{{ $project->description }}</p>
                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="text-brand-200 decoration-brand-600 focus-visible:outline-brand-300 mt-5 inline-block rounded py-2 text-sm font-semibold underline underline-offset-4 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4"
                                >
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
