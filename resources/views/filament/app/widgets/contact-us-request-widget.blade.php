<x-filament-widgets::widget>

    <div class="flex items-center justify-center">
    <x-filament::section class="w-3/4"> 
        <div class="flex items-center gap-x-3">
            <div class="flex-1 space-y-4">
                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    {{ __('Get in Touch with Us') }}
                </h2>
                <p
                    class="grid flex-1 text-sm font-normal leading-6 text-gray-950 dark:text-white">
                    {{ __('Have any questions or need assistance? Our team is here to help! Reach out to us, and we’ll get back to you as soon as possible.') }}
                </p>
            </div>


            {{ $this->contactUs }}
        </div>

    </x-filament::section>
    </div>
    <x-filament-actions::modals />
</x-filament-widgets::widget>