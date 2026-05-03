@extends('layouts.app')

@section('content')

<h1>Créer une tâche</h1>

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <input type="text" name="titre" placeholder="Titre"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <select name="categorie_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">
                {{ $cat->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Créer</button>
</form>

@endsection