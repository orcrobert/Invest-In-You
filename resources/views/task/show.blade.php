@auth
<x-layout>
    Category: {{ $task->category?->name ?? 'No category' }}<br>
    Title: {{ $task->title }}<br>
    Description: {{ $task->description }}<br>
    Deadline: {{ $task->deadline }}<br>

    <a href="/task/{{ $task->id }}/edit" >Edit task</a>
</x-layout>
@endauth

@guest
    <h1>Login to see task!</h1>
@endguest