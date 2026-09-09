@props(['project', 'priority' => false])
@inject('projectImages', 'App\Services\ResponsiveImageVariants')

<article data-project-entry class="grid gap-6 py-8 sm:gap-8 sm:py-12 lg:grid-cols-2 lg:items-center lg:gap-16">
    @if ($project->featured_image_url)
        @php
            $featuredImageSrcset = $projectImages->srcset($project->featured_image_path);
        @endphp
        <a
            href="{{ route('projects.show', $project) }}"
            aria-label="Explore {{ $project->title }}"
            class="focus-visible:outline-brand-500 dark:bg-brand-900 block overflow-hidden rounded-xl bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-4"
        >
            <picture>
                @if ($featuredImageSrcset)
                    <source
                        type="image/webp"
                        srcset="{{ $featuredImageSrcset }}"
                        sizes="(min-width: 1280px) 576px, (min-width: 1024px) calc((100vw - 8rem) / 2), (min-width: 640px) calc(100vw - 3rem), calc(100vw - 2rem)"
                    />
                @endif
                <img
                    src="{{ $project->featured_image_url }}"
                    alt=""
                    loading="{{ $priority ? 'eager' : 'lazy' }}"
                    decoding="async"
                    @if ($priority) fetchpriority="high" @endif
                    class="aspect-video w-full object-contain"
                />
            </picture>
        </a>
    @endif

    <div @class(['min-w-0', 'grid gap-6 lg:col-span-2 lg:grid-cols-2 lg:gap-16' => ! $project->featured_image_url])>
        <h3 class="min-w-0 text-3xl font-semibold tracking-tight text-balance break-words text-gray-900 sm:text-4xl dark:text-white">
            <a
                href="{{ route('projects.show', $project) }}"
                class="hover:text-brand-700 focus-visible:outline-brand-500 dark:hover:text-brand-300 rounded focus-visible:outline-2 focus-visible:outline-offset-4"
            >{{ $project->title }}</a>
        </h3>
        <div @class(['min-w-0', 'mt-4' => $project->featured_image_url])>
            <p class="text-base leading-8 break-words text-gray-600 sm:text-lg dark:text-gray-300">
                {{ $project->description }}
            </p>
            @if ($project->tech_stack)
                <ul
                    aria-label="Technologies used for {{ $project->title }}"
                    class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 dark:text-gray-400"
                >
                    @foreach ($project->tech_stack as $tech)
                        <li class="break-all">{{ $tech }}</li>
                    @endforeach
                </ul>
            @endif
            <a
                href="{{ route('projects.show', $project) }}"
                class="text-brand-700 hover:text-brand-900 focus-visible:outline-brand-500 dark:text-brand-300 mt-5 inline-flex items-center gap-2 rounded py-2 text-sm font-semibold underline underline-offset-4 focus-visible:outline-2 focus-visible:outline-offset-4 dark:hover:text-white"
            >
                <span>Explore the project<span class="sr-only">: {{ $project->title }}</span></span>
                <x-heroicon-o-arrow-long-right class="size-5 shrink-0" aria-hidden="true" />
            </a>
        </div>
    </div>
</article>
