<x-app-layout>
      <h1 style="color:red">TEST DASHBOARD OK</h1>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
             <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- STATISTIQUES -->
            <div class="grid grid-cols-3 gap-4 mb-6">

                <div class="bg-yellow-100 p-4 rounded shadow text-center">
                    À faire<br>
                    <strong>{{ $taskCounts['todo'] ?? 0 }}</strong>
                </div>

                <div class="bg-blue-100 p-4 rounded shadow text-center">
                    En cours<br>
                    <strong>{{ $taskCounts['in_progress'] ?? 0 }}</strong>
                </div>

                <div class="bg-green-100 p-4 rounded shadow text-center">
                    Terminées<br>
                    <strong>{{ $taskCounts['done'] ?? 0 }}</strong>
                </div>

            </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
