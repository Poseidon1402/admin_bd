<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virements List</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="w-64 bg-indigo-900 text-white h-screen p-5 fixed">
        <h2 class="text-xl font-bold mb-6">Dashboard</h2>
        <ul>
            
            <li class="mb-4">
                <a href="{{ route('virements_list') }}" class="block p-2 hover:bg-indigo-700 rounded">💸 Virements</a>
            </li>
            <li class="mb-4">
                <a href="{{ route('audit_virement_list') }}" class="block p-2 hover:bg-indigo-700 rounded">📊 Audit virements</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8 w-full">
        <h1 class="text-3xl font-bold text-indigo-600 mb-6">Audit des virements</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Virements Table -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Type</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Date de virement</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Montant ancien</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Montant nouveau</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($virements as $virement)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 text-sm">{{ $virement->type_action }}</td>
                        <td class="py-2 px-4 text-sm">{{ \Carbon\Carbon::parse($virement->date_virement)->format('d/m/Y H:i') }}</td>
                        <td class="py-2 px-4 text-sm">{{ $virement->montant_ancien }}</td>
                        <td class="py-2 px-4 text-sm">{{ $virement->montant_nouv }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Action Counts -->
<div class="mt-4 text-sm text-gray-600">
    <p>Total Modifications: {{ $modification }}</p>
    <p>Total Suppression: {{ $suppression }}</p>
    <p>Total Insertion: {{ $ajout }}</p>
</div>
    </div>

</body>
</html>
