@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Mes tâches</h1>

    <a href="{{ route('tasks.create') }}">
        <button type="button">+ Creer une tache</button>
    </a>

    <br><br>

    <!-- ===== FILTRES ===== -->
    <form method="GET">

        <select name="status">
            <option value="">Tous status</option>
            <option value="todo">A faire</option>
            <option value="in_progress">En cours</option>
            <option value="done">Terminé</option>
        </select>

        <select name="category">
            <option value="">Toutes catégories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <button type="submit">Filtrer</button>

    </form>

    <hr>

    <!-- ===== TABLE ===== -->
    <table>

        <tr>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach($tasks as $task)
            <tr>

                <!-- TITRE -->
                <td>{{ $task->titre }}</td>

                <!-- CATÉGORIE -->
                <td>{{ $task->category->name ?? 'No category' }}</td>

                <!-- STATUS + CHANGE -->
                <td>

                    <!-- badge -->
                    <span class="status status-{{ $task->status }}">
                        {{ $task->status }}
                    </span>

                    <!-- changer status -->
                    <form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
                        @csrf
                        @method('PATCH')

                        <button type="submit">
                            Changer
                        </button>
                    </form>

                </td>

                <!-- ACTIONS -->
                <td>

                    <a href="{{ route('tasks.edit', $task) }}">Modifier</a>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Supprimer ?')">
                            Delete
                        </button>
                    </form>

                </td>

            </tr>
        @endforeach

    </table>

</div>

@endsection