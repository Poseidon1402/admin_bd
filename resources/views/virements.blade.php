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
        <h1 class="text-3xl font-bold text-indigo-600 mb-6">Virements List</h1>
        
        <!-- Add Virement Button -->
        <div class="mb-4">
            <button id="addVirementBtn" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Add Virement
            </button>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4" id="success_message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Virements Table -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Numéro virements</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Numéro compte</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Montant</th>
                    <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($virements as $virement)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 text-sm">{{ $virement->num_virements }}</td>
                        <td class="py-2 px-4 text-sm">{{ $virement->num_compte }}</td>
                        <td class="py-2 px-4 text-sm">{{ $virement->montant }}</td>
                        <td class="py-2 px-4 text-sm">
                            <button id="updateBtn" class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" onclick="showUpdateModal({{$virement->num_virements}})">
                                Modifier
                            </button>
                            <a href="{{ route('delete_virement', ['numVirements' => $virement->num_virements]) }}">
                                <button class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    Supprimer
                                </button>
                            </a>
                        </td>
                    </tr>
                    <!--Update virement-->
    <div id="virementModalUpdate-{{$virement->num_virements}}" class="fixed bg-black bg-opacity-30 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-indigo-600 mb-4" id="modalTitle">Mis-à-jour du virement</h2>
            <form action="{{route('update_virement', ['numVirement' => $virement->num_virements])}}" method="POST" id="virementFormUpdate">
                @csrf
                <input type="hidden" id="virementIdUpdate" name="virementId">

                <div class="mb-4">
                    <label for="montant" class="block text-sm font-medium text-gray-600">Montant</label>
                    <input type="number" name="montant" id="montant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="mb-4 hidden">
                    <label for="montant_ancien" class="block text-sm font-medium text-gray-600">Montant</label>
                    <input type="number" name="montant_ancien" id="montant-ancien" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{$virement->montant}}">
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeUpdateModal({{$virement->num_virements}})">Annuler</button>
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="submitButtonUpdate">
                            Modifier
                        </button>
                </div>
            </form>
        </div>
    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Virement Modal -->
    <div id="virementModal" class="fixed bg-black bg-opacity-30 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-indigo-600 mb-4" id="modalTitle">Add Virement</h2>
            <form method="POST" id="virementForm">
                @csrf
                <input type="hidden" id="virementId" name="virementId">

                <div class="mb-4">
                    <label for="montant" class="block text-sm font-medium text-gray-600">Montant</label>
                    <input type="number" name="montant" id="montant" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" id="submitButton">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show modal for adding or editing a virement
        const addVirementBtn = document.getElementById('addVirementBtn');
        const virementModal = document.getElementById('virementModal');
        const virementForm = document.getElementById('virementForm');
        const submitButton = document.getElementById('submitButton');
        const modalTitle = document.getElementById('modalTitle');
        const virementId = document.getElementById('virementId');
        const montant = document.getElementById('montant');

        // Open modal for adding a new virement
        addVirementBtn.onclick = function () {
            virementForm.reset();
            modalTitle.textContent = 'Ajouter Virement';
            submitButton.textContent = 'Save';
            virementId.value = '';
            virementForm.action = "{{ route('store_virement') }}"; // Store route
            virementModal.classList.remove('hidden');
        };

        // Close modal
        function closeModal() {
            virementModal.classList.add('hidden');
        }

        const updateVirementBtn = document.getElementById('updateBtn');
        const showUpdateModal = (num_virement) => {
            const virementModalUpdate = document.getElementById(`virementModalUpdate-${num_virement}`);
            virementModalUpdate.classList.remove('hidden');
        }

        function closeUpdateModal(num_virement) {
            const virementModalUpdate = document.getElementById(`virementModalUpdate-${num_virement}`);
            virementModalUpdate.classList.add('hidden');
        }
    </script>

</body>
</html>
