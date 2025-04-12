<x-layout>
    Title: {{ $task->title }}<br>
    Description: {{ $task->description }}<br>
    Deadline: {{ $task->deadline }}<br>
    Price: {{ $task->price }}<br>

    <a href="/task/{{ $task->id }}/edit" >Edit task</a>
</x-layout>