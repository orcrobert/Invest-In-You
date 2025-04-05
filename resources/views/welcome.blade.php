<x-layout>
    <h1>Home page</h1>

    @foreach ($tasks as $task)
        Category: {{ $task->category->name }}<br>
        Title: {{ $task->title }}<br>
        Description: {{ $task->description }}<br>
        Deadline: {{ $task->deadline }}<br>

        <br>
    @endforeach

    <div>
        {{ $tasks->links() }}
        
    </div>

</x-layout>