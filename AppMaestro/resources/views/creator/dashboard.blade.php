<body class="relative bg-yellow-50 overflow-hidden max-h-screen">
<script src="https://cdn.tailwindcss.com"></script>

@include('creator.side')

<main class="ml-60 pt-16 max-h-screen overflow-auto">
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl p-8 mb-5">
                <h1 class="text-3xl text-center font-bold mb-10">
                    Welcome Creator {{ auth()->user()->name }}
                </h1>

                <hr class="my-10">

                <div class="grid grid-cols-2 gap-x-20">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <div class="p-4 bg-green-100 rounded-xl">
                                    <div class="font-bold text-xl text-gray-800 leading-none">Good day,
                                        <br>{{ auth()->user()->name }}
                                    </div>
                                    <div class="mt-5">
                                        <a href="/createProduct"
                                           class="inline-flex items-center justify-center py-2 px-3 rounded-xl bg-white text-gray-800 hover:text-green-500 text-sm font-semibold transition">
                                            Start to create products
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                <div class="font-bold text-2xl leading-none">{{$totalProducts}}</div>
                                <div class="mt-2">Total Products</div>
                            </div>
                            <!-- <div class="p-4 bg-yellow-100 rounded-xl text-gray-800">
                                <div class="font-bold text-2xl leading-none"></div>
                                <div class="mt-2">Public Posts</div>
                            </div> -->
                            <!-- <div class="col-span-2">
                                <div class="p-4 bg-purple-100 rounded-xl text-gray-800">
                                    <div class="font-bold text-xl leading-none">Your daily plan</div>
                                    <div class="mt-2">5 of 8 completed</div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">My latest Products Vehicules</h2>

                        <div class="space-y-4">
                                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                                    

                                <div class="block w-full overflow-x-auto">
                                

                                <table class="w-full text-sm text-left text-gray-500">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-gray-700">Marque</th>
                    <th class="px-4 py-3 text-gray-700">Modèle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicules as $vehicule)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $vehicule->marque }}</td>
                        <td class="px-4 py-3">{{ $vehicule->modele }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                                 </div>

                                    <a href="javascript:void(0)"
                                       class="font-bold hover:text-yellow-800 hover:underline"></a>
                                    <div class="text-sm text-gray-600">
                                       
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
