<x-layout>

    @guest
        <h1 class="font-bold">NOT LOGGED IN</h1>
        <br>
    @endguest

    @foreach ($tasks as $task)
        <div>
            <a href="/task/{{ $task->id }}">
                Category: {{ $task->category->name }}<br>
                Title: {{ $task->title }}<br>
                Description: {{ $task->description }}<br>
                Deadline: {{ $task->deadline }}<br>
                
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