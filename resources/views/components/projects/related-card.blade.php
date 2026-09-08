@props(['project'])

<a href="{{ route('projects.show', $project) }}" class="group flex h-full flex-col border-t border-gray-200 py-6 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-400 dark:border-brand-800">
    <h3 class="text-xl font-semibold tracking-tight text-gray-900 group-hover:text-brand-700 dark:text-white dark:group-hover:text-brand-300">{{ $project->title }}</h3>
    <p class="mt-3 text-sm leading-7 text-gray-600 dark:text-gray-400">{{ $project->description }}</p>
    <span class="mt-auto inline-flex items-center gap-2 pt-5 text-sm font-semibold text-brand-700 dark:text-brand-300">
        Explore the project
        <x-heroicon-o-arrow-long-right class="size-5 shrink-0" aria-hidden="true" />
    </span>
</a>
