<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">

</head>
<body>
<h1>My To-Do List</h1>

<div class="logout-button">
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="button">Logout</button>
    </form>
</div>

<div class="task-form">
    <h2>Add New Task</h2>
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <button type="submit">Add</button>
    </form>
</div>

<ul>
    @foreach ($tasks as $task)
        <li class="task-card {{ $task->completed ? 'completed' : '' }}">
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('PUT')
                <label class="checkbox-container">
                    <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                </label>
                <button type="submit" class="button">Update</button>
                <span class="task-title">{{ $task->title }}</span>
            </form>
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="button delete-button" type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

</body>
</html>
