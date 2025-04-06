<x-layout>
    @foreach ($tasks as $task)
        Category: {{ $task->category->name }}<br>
        Title: {{ $task->title }}<br>
        Description: {{ $task->description }}<br>
        Deadline: {{ $task->deadline }}<br>
        <a href="/task/{{ $task->id }}/edit" >Edit task</a>
        <br>
        <br>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</x-layout>