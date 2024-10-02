<x-filament-panels::page>

    {{-- <div class="fixed bottom-8 left-0 right-0">
        @livewire(\App\Filament\App\Widgets\ContactUsRequestWidget::class)
    </div> --}}

    <div class="flex items-center justify-center">
        <x-filament::section class="w-3/4">
            <div class="flex items-center gap-x-3">
                <div class="flex-1 space-y-4">
                    <h2
                        class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        {{ __('') }}
                    </h2>
                    <p
                        class="grid flex-1 text-sm font-normal leading-6 text-gray-950 dark:text-white">
                        {{ __('') }}
                    </p>
                </div>
                {{ $this->addPost }}
            </div>
        </x-filament::section>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-4">
    @foreach ($posts as $post)
        <div class="flex items-center justify-center">
            <x-filament::section class="p-0">
                <img src="{{ $post->attachments[0] }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg">

                <div class="flex items-center gap-x-3">
                    <div class="flex-1 space-y-4">
                        <h2
                            class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white">
                            {{ $post->title }}
                        </h2>
                        <p
                            class="grid flex-1 text-sm font-normal leading-6 text-gray-950 dark:text-white">
                            {{ $post->content }}
                        </p>
                    </div>
                </div>
            </x-filament::section>
        </div>
    @endforeach
    </div>
</x-filament-panels::page>