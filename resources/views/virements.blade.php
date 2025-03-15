<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des virements</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <div class="w-64 bg-indigo-900 text-white h-screen p-5 fixed shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
        <ul>
            <li class="mb-4">
                <a href="{{ route('virements_list') }}" class="block p-3 hover:bg-indigo-700 rounded transition">💸 Virements</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8 w-full">
        <h1 class="text-4xl font-bold text-indigo-600 mb-6">Liste de mes virements</h1>
        
        <!-- Add Virement Button -->
        <button id="addVirementBtn" class="m-4 bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-md transition">
            Ajouter +
        </button>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4 shadow-md" id="success_message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Virements Table -->
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-md p-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Numéro virements</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Numéro compte</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Montant</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($virements as $virement)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4 text-sm">{{ $virement->num_virements }}</td>
                            <td class="py-3 px-4 text-sm">{{ $virement->num_compte }}</td>
                            <td class="py-3 px-4 text-sm">{{ $virement->montant }}</td>
                            <td class="py-3 px-4 text-sm">
                                <button class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 shadow transition" onclick="showUpdateModal({{$virement->num_virements}})">
                                    Modifier
                                </button>
                                <a href="{{ route('delete_virement', ['numVirements' => $virement->num_virements, 'montant' => $virement->montant]) }}">
                                    <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 shadow transition">
                                        Supprimer
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <!-- Update Virement Modal -->
                        <div id="virementModalUpdate-{{$virement->num_virements}}" class="fixed inset-0 bg-black/40 flex items-center justify-center hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <h2 class="text-xl font-bold text-indigo-600 mb-4">Modifier Virement</h2>
                                <form action="{{route('update_virement', ['numVirement' => $virement->num_virements])}}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-600">Montant</label>
                                        <input type="number" name="montant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                                    </div>
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600" onclick="closeUpdateModal({{$virement->num_virements}})">Annuler</button>
                                        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Virement Modal -->
    <div id="virementModal" class="fixed inset-0 bg-black/40 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-indigo-600 mb-4">Ajouter Virement</h2>
            <form method="POST" action="{{ route('store_virement') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Montant</label>
                    <input type="number" name="montant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Open modal for adding a new virement
        document.getElementById('addVirementBtn').onclick = function () {
            document.getElementById('virementModal').classList.remove('hidden');
        };

        function closeModal() {
            document.getElementById('virementModal').classList.add('hidden');
        }

        function showUpdateModal(num_virement) {
            document.getElementById(`virementModalUpdate-${num_virement}`).classList.remove('hidden');
        }

        function closeUpdateModal(num_virement) {
            document.getElementById(`virementModalUpdate-${num_virement}`).classList.add('hidden');
        }
    </script>
</body>
</html>
