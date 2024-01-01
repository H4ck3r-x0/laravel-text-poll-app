<div>
    @auth
        @livewire('pool.create-pool-form')

        @livewire('pool.pools')
    @else
        <div class="px-6 pt-0 lg:px-8">
            <div class="mx-auto max-w-2xl py-12 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl dark:text-white">
                        Laravel Poll App
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-200">
                        Simplify decision-making. Create, share, and analyze polls effortlessly. Elevate engagement with
                        our intuitive and efficient interface. Your go-to solution for seamless polls!
                    </p>
                </div>
            </div>
        </div>
    @endauth
</div>
