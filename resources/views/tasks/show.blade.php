@extends('layouts.app')

@section('content')

<h1>Détails de la tâche</h1>

<h3>Titre:</h3>
<p>{{ $task->titre }}</p>

<h3>Description:</h3>
<p>{{ $task->description }}</p>

<h3>Catégorie:</h3>
<p>{{ $task->category->titre ?? 'No category' }}</p>

<h3>Status:</h3>
<p>{{ $task->status }}</p>

<a href="{{ route('tasks.index') }}">Retour</a>

@endsection