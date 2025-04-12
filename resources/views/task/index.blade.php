<x-layout>
    <div class="mb-4">
        @if (request()->query('status') === 'not-completed')
            <a href="/tasks" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Show All Tasks
            </a>
        @else
            <a href="/tasks?status=not-completed" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Show Pending Tasks
            </a>
        @endif
    </div>

    @foreach ($tasks as $task)
    <div class="bg-white rounded-md shadow-md p-6 mb-4">
        <a href="/task/{{ $task->id }}" class="block hover:bg-gray-100 p-4 rounded-md transition duration-150 ease-in-out">
            <p class="text-lg font-semibold text-gray-800 mb-2">Title: {{ $task->title }}</p>
            <p class="text-gray-700 mb-2">Description: {{ $task->description }}</p>
            <p class="text-sm text-gray-600 mb-2">Deadline: {{ $task->deadline }}</p>
            <p class="text-sm text-gray-600">Price: {{ $task->price }}</p>
        </a>
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="/task/{{ $task->id }}/complete">
                @csrf
                @method('PATCH')
                <div class="flex items-center">
                    <input type="checkbox" name="status" value="1" {{ $task->status ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-green-500 focus:ring-green-500 border-gray-300 rounded mr-2" onchange="this.form.submit()">
                    <button type="submit" class="hidden">Update Status</button>
                </div>
            </form>
            <a href="/task/{{ $task->id }}/edit" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                Edit task
            </a>
        </div>
    </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</x-layout>