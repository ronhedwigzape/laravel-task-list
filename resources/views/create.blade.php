@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf {{--  need to add this for every form --}}
        <div>
            <label for="title">Title</label>
            <input name="title" id="title">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5"></textarea>
        </div>

        <div>
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="10"></textarea>
        </div>

        <div>
            <button type="submit">Add Task</button>
        </div>

    </form>
@endsection
