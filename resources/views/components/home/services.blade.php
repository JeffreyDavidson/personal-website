<section data-home-services aria-labelledby="services-heading" class="border-t border-gray-200 bg-white py-14 dark:border-brand-800/50 dark:bg-transparent sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <h2 id="services-heading" class="text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-4xl">Where I can help</h2>
            <a href="{{ route('contact') }}" class="w-fit rounded py-2 text-sm font-semibold text-brand-700 underline decoration-brand-300 underline-offset-4 hover:text-brand-900 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-500 dark:text-brand-300 dark:hover:text-white">Discuss your project</a>
        </div>

        <dl class="grid gap-8 md:grid-cols-3 md:gap-10">
            <div>
                <dt>
                    <x-heroicon-o-wrench-screwdriver class="mb-5 size-8 stroke-brand-600 dark:stroke-brand-300" aria-hidden="true" />
                    <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Make change easier</span>
                </dt>
                <dd class="mt-3 max-w-sm text-base leading-7 text-gray-600 dark:text-gray-400">Get a clear code review, untangle problem areas and strengthen tests so your team can move forward with confidence.</dd>
            </div>
            <div>
                <dt>
                    <x-heroicon-o-command-line class="mb-5 size-8 stroke-brand-600 dark:stroke-brand-300" aria-hidden="true" />
                    <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Move your product forward</span>
                </dt>
                <dd class="mt-3 max-w-sm text-base leading-7 text-gray-600 dark:text-gray-400">Bring experienced Laravel development to your team, from shaping the next feature to taking it through to production.</dd>
            </div>
            <div>
                <dt>
                    <x-heroicon-o-arrow-path class="mb-5 size-8 stroke-brand-600 dark:stroke-brand-300" aria-hidden="true" />
                    <span class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Modernize without starting over</span>
                </dt>
                <dd class="mt-3 max-w-sm text-base leading-7 text-gray-600 dark:text-gray-400">Plan Laravel upgrades and improve legacy applications while preserving the behavior your business depends on.</dd>
            </div>
        </dl>
    </div>
</section>
