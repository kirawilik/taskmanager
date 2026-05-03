@extends('layouts.app')

@section('content')

<h1>Modifier la tache</h1>

<form method="POST" action="{{ route('tasks.update', $task) }}">
    @csrf
    @method('PUT')

    <input type="text" name="titre" value="{{ $task->titre }}"><br><br>

    <textarea name="description">{{ $task->description }}</textarea><br><br>

    <select name="categorie_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ $task->categorie_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select><br><br>

    <select name="status">
        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>
            A faire
        </option>

        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
            En cours
        </option>

        <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>
            Terminer
        </option>
    </select><br><br>

    <button type="submit">Modifier</button>
</form>

@endsection