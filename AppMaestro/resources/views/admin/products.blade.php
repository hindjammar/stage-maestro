<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Références et Composants</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="text-gray-800 font-inter">
@include('admin.home')

<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
    <!-- Content -->
    <div class="p-4">
        <main>
            <div class="space-y-2 text-center bg-white p-4">
                <h2 class="text-2xl font-bold">Vehicules Requests</h2>
                <p class="font-serif text-sm dark:text-gray-400">Here you can approve or decline vehicules</p>

                <div class="grid mt-8 pt-4 gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
                    @foreach($references as $reference)
                        @foreach($reference->vehicules as $vehicule)
                            <div class="flex flex-col">
                                <div class="shadow-md rounded-3xl p-4">
                                    <div class="flex-none lg:flex">
                                        <div class="flex-auto ml-3 justify-evenly py-2">
                                            <div class="flex flex-wrap">
                                                <h2 class="flex-auto text-lg font-medium">{{ $vehicule->marque }}</h2>
                                            </div>
                                            <p class="mt-3 text-sm text-gray-500">Modèle: {{ $vehicule->modele }}</p>
                                            <p class="mt-3 text-sm text-gray-500">Année: {{ $vehicule->annee }}</p>
                                            <p class="mt-3 text-sm text-gray-500">Couleur: {{ $reference->color->couleur }}</p>
                                            <p class="mt-3 text-sm text-gray-500">Référence: {{ $reference->reference }}</p>
                                            <div class="mt-3 text-sm text-gray-500"> Composants:
                                                    @if($reference->components->isNotEmpty())
                                                        <ul class="list-disc list-inside">
                                                            @foreach($reference->components as $component)
                                                                <li>
                                                                    Composant  : {{ $component->name }},
                                                                    Quantité : {{ $component->quantity }},
                                                                    Unité : {{ $component->unit }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        Aucun composant trouvé
                                                    @endif
                                                </div>
                                            <div class="flex py-4 px-3 text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vehicule->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $vehicule->status }}
                                                </span>
                                            </div>
                                            <div class="flex p-4 pb-2 border-t border-gray-200"></div>
                                            <div class="flex space-x-3 text-sm font-medium">
                                            <div class="flex-auto flex space-x-3">
                                                <form action="/decline-vehicule/{{$vehicule->id}}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="mb-2 md:mb-0 bg-white px-4 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2">
                                                        <span class="text-red-400 hover:text-red-500 rounded-lg">
                                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                 viewBox="0 0 256 256">
                                                                <path d="M8 90c-2.047 0-4.095-.781-5.657-2.343-3.125-3.125-3.125-8.189 0-11.314l74-74c3.125-3.124 8.189-3.124 11.314 0 3.124 3.124 3.124 8.189 0 11.313l-74 74C12.095 89.219 10.047 90 8 90z" fill="rgb(236,0,0)"/>
                                                                <path d="M82 90c-2.048 0-4.095-.781-5.657-2.343l-74-74c-3.125-3.124-3.125-8.189 0-11.313 3.124-3.124 8.189-3.124 11.313 0l74 74c3.124 3.125 3.124 8.189 0 11.314C86.095 89.219 84.048 90 82 90z" fill="rgb(236,0,0)"/>
                                                            </svg>
                                                        </span>
                                                        <span>Decline</span>
                                                    </button>
                                                </form>
                                            </div>
                                            <form action="/approve-vehicule/{{$vehicule->id}}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="mb-2 md:mb-0 bg-white px-4 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2">
                                                    <span class="text-green-400 hover:text-green-500 rounded-lg">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                             viewBox="0 0 256 256">
                                                            <path d="M89.122 3.486L89.122 3.486c-2.222-3.736-7.485-4.118-10.224-.742L33.202 59.083c-1.118 1.378-3.245 1.303-4.262-.151L17.987 43.291c-3.726-5.322-11.485-5.665-15.666-.693l0 0c-2.883 3.428-3.102 8.366-.533 12.036L24.206 86.65c2.729 3.897 8.503 3.89 11.222-.014l6.435-9.239L88.87 10.265C90.28 8.251 90.378 5.598 89.122 3.486z" fill="rgb(6,188,66)"/>
                                                        </svg>
                                                    </span>
                                                    <span>Approve</span>
                                                </button>
                                            </form>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                 <!-- Affichage de la pagination -->
                 <div class="mt-8">
                </div>
            </div>
        </main>
    </div>
    <!-- End Content -->
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Votre script JavaScript ici -->

</body>
</html>
