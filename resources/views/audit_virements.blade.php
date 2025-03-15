<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virements List</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <div class="w-64 bg-indigo-900 text-white h-screen p-6 fixed shadow-md rounded-r-lg">
        <h2 class="text-2xl font-semibold mb-8">Dashboard</h2>
        <ul>
            <li class="mb-6">
                <a href="{{ route('audit_virement_list') }}" class="block p-3 hover:bg-indigo-800 rounded-lg transition duration-300">📊 Audit Virements</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-10 w-full">
        <h1 class="text-4xl font-extrabold text-indigo-600 mb-8">Audit des Virements</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Virements Table -->
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-lg">
            <table class="min-w-full bg-white border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="py-3 px-6 text-left text-gray-600 font-medium">Type</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-medium">Date de Virement</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-medium">Numéro compte</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-medium">Montant Ancien</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-medium">Montant Nouveau</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($virements as $virement)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $virement->type_action }}</td>
                            <td class="py-3 px-6">{{ \Carbon\Carbon::parse($virement->date_virement)->format('d/m/Y H:i') }}</td>
                            <td class="py-3 px-6">{{ $virement->numero_compte }}</td>
                            <td class="py-3 px-6">{{ $virement->montant_ancien }}</td>
                            <td class="py-3 px-6">{{ $virement->montant_nouv }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Chart Container -->
        <div class="mt-10 flex flex-col items-center">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Statistiques des Actions</h2>
            <canvas id="actionsChart" class="w-96 h-96"></canvas>
        </div>
    </div>

    <!-- Pass PHP Data to JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('actionsChart').getContext('2d');
            const data = {
                labels: ["Modifications", "Suppressions", "Insertions"],
                datasets: [{
                    data: ["{{ $modification }}", "{{ $suppression }}", "{{ $ajout }}"],
                    backgroundColor: ["#f39c12", "#e74c3c", "#2ecc71"],
                    hoverBackgroundColor: ["#e67e22", "#c0392b", "#27ae60"]
                }]
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

</body>
</html>
