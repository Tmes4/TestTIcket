<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container flex flex-wrap">

            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3 p-4">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="{{ $event->imageUrl }}?{{ $event->id }}" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                        </a>
                        <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->date }}</p>
                        <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->time }}</p>
                        <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->price }}</p>
                        <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->location }}</p>
                        <p class=" mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
