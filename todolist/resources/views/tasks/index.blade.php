<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="{{ asset('css/todo.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}"></script>

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
        <li class="task-card {{ $task->completed ? 'completed' : '' }}" data-task-id="{{ $task->id }}">
            <div class="container">
                <div class="left-div">
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="checkbox-container">
                            <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        <button type="submit" class="button">Update</button>
                        <span class="task-title" data-task-identifier="{{ $task->id }}">{{ $task->title }}</span>
                    </form>
                </div>
                <div class="right-div">
                    <form class="update-form" data-task-identifier="{{ $task->id }}">
                        @csrf
                        @method('PUT')
                        <div class="custom-input">
                            <input type="text" name="new_title" placeholder="New Task Title" required>
                        </div>
                        <button type="submit" class="button">Update Title</button>
                    </form>
                    <form action="/tasks/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button delete-button" type="submit">Delete</button>
                    </form>
                </div>
                <div class="task-details">
                    <span class="task-date">Creation Date: {{ $task->created_at->format('Y-m-d H:i:s') }}</span>
                    <span class="task-date" data-task-identifier="{{ $task->id }}">Last Updated: {{ $task->updated_at->format('Y-m-d H:i:s') }}</span>
                </div>
            </div>

        </li>
    @endforeach

</ul>

</body>
</html>
