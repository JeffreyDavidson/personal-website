@props(['project', 'priority' => false])

<article data-project-entry class="grid gap-6 py-8 sm:gap-8 sm:py-12 lg:grid-cols-2 lg:items-center lg:gap-16">
    <a href="{{ route('projects.show', $project) }}" aria-label="Explore {{ $project->title }}" class="block min-w-0 rounded-xl focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-500">
        <x-projects.artwork :project="$project" :priority="$priority" />
    </a>

    <div class="min-w-0">
        <h3 class="min-w-0 break-words text-balance text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
            <a href="{{ route('projects.show', $project) }}" class="rounded hover:text-brand-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-500 dark:hover:text-brand-300">{{ $project->title }}</a>
        </h3>
        <div class="mt-4 min-w-0">
            <p class="break-words text-base leading-8 text-gray-600 dark:text-gray-300 sm:text-lg">{{ $project->description }}</p>
            @if($project->tech_stack)
                <ul aria-label="Technologies used for {{ $project->title }}" class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 dark:text-gray-400">
                    @foreach($project->tech_stack as $tech)
                        <li class="break-all">{{ $tech }}</li>
                    @endforeach
                </ul>
            @endif
            <a href="{{ route('projects.show', $project) }}" class="mt-5 inline-flex items-center gap-2 rounded py-2 text-sm font-semibold text-brand-700 underline underline-offset-4 hover:text-brand-900 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-500 dark:text-brand-300 dark:hover:text-white">
                <span>Explore the project<span class="sr-only">: {{ $project->title }}</span></span>
                <x-heroicon-o-arrow-long-right class="size-5 shrink-0" aria-hidden="true" />
            </a>
        </div>
    </div>
</article>
