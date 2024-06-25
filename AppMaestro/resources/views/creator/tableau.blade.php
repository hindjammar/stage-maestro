<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="relative bg-yellow-50 overflow-hidden max-h-screen">
<script src="https://cdn.tailwindcss.com"></script>

@include('creator.side')

<main class="bg-white ml-60 pt-16 max-h-screen overflow-auto flex justify-center h-full">
    
        
       <div class="container mx-auto px-4 py-8">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Références et Composants</h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">Marque</th>
                    <th class="px-4 py-3">Modèle</th>
                    <th class="px-4 py-3">Annee</th>
                    <th class="px-4 py-3">Color</th>
                    <th class="px-4 py-3">Référence</th>
                    <th class="px-4 py-3">Composants</th>
                </tr>
            </thead>
            <tbody>
                @foreach($references as $reference)
                    <!-- Afficher les véhicules associés à cette référence -->
                    @foreach($reference->vehicules as $vehicule)
                        <tr class="hover:bg-gray-50">
                            <!-- Marque et modèle des véhicules -->
                            <td class="px-4 py-3">{{ $vehicule->marque }}</td>
                            <td class="px-4 py-3">{{ $vehicule->modele }}</td>
                            <td class="px-4 py-3">{{ $vehicule->annee }}</td>

                            <td class="px-4 py-3">{{$reference->color->couleur}}</td>
                            <!-- Nom de la référence -->
                            <td class="px-4 py-3">{{ $reference->reference }}</td>
                            
                            <!-- Composants associés à cette référence -->
                            <td class="px-4 py-3">
                                @if($reference->components->isNotEmpty())
                                    <ul class="list-disc list-inside">
                                        @foreach($reference->components as $component)
                                            <li>
                                                Nom : {{ $component->name }},
                                                Quantité : {{ $component->quantity }},
                                                Unité : {{ $component->unit }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    Aucun composant trouvé
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- table3 -->




    
</main>


</body>
</html>
