<x-layout>
    @foreach ($tasks as $task)
        <div>
            <a href="/task/{{ $task->id }}">
                Title: {{ $task->title }}<br>
                Description: {{ $task->description }}<br>
                Deadline: {{ $task->deadline }}<br>
                Price: {{ $task->price }}<br>
                
            </a>
            <a href="/task/{{ $task->id }}/edit" >Edit task</a>
            <br>
            <br>
        </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</x-layout>
