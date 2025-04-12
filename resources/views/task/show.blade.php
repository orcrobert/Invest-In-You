<x-layout>
    <div class="bg-white rounded-md shadow-md p-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">{{ $task->title }}</h1>
        <p class="text-lg text-gray-700 mb-4">Description: {{ $task->description }}</p>
        <p class="text-md text-gray-600 mb-2">Deadline: {{ $task->deadline }}</p>
        <p class="text-md text-gray-600 mb-6">Price: {{ $task->price }}</p>

        <a href="/task/{{ $task->id }}/edit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
            Edit task
        </a>
    </div>
</x-layout>