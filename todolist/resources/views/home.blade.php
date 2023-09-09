@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                        <hr>
                            <ul class="list-group">
                                <!-- Örnek görevler -->
                                <li class="list-group-item"><a href="{{ route('tasks.index') }}">Todo App</a></li>
                                <li class="list-group-item">Task 2</li>
                                <li class="list-group-item">Task 3</li>
                            </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
