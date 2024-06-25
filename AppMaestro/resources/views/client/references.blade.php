<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/navbar.css"> <!-- Pour personnaliser le style du menu -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">


    <style>
       
        .scrollable {
            overflow-x: hidden; /* Utilisez un défilement horizontal */
            overflow-y: auto; /* Masquez le défilement vertical */
            white-space: nowrap; /* Empêchez le texte de se retourner à la ligne */
        }

    </style>
</head>
<body>
    @include('nav')
<div style="margin-top:90px;" class="max-w-4xl mx-auto p-10 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 max-h-screen">
    
                <div class="scrollable">
                 @php
                    $referencesChunks = $references->chunk(72);
                @endphp
                @foreach($referencesChunks as $chunk)

                <div class="grid gap-6 grid-cols-8">

                @foreach($references as $reference)
<div class="flex flex-col relative">
    <div class="relative">
        <img class="h-8 w-8 mx-auto rounded-md" src="{{ $reference->imagereference }}">
        <div class="tooltip hidden absolute bg-gray-800 text-white text-center p-2 rounded-lg">
            {{ $reference->reference }}
        </div>
    </div>
    <div class="hovered-reference hidden text-center">
        <!-- Ajouter un événement de clic sur le nom de la référence -->
        <a href="" onclick="incrémenterPopularitéEtNaviguer({{ $reference->id }})">
            {{ $reference->reference }}
        </a>
    </div>
</div>
@endforeach


        </div>
        @endforeach
    </div>  
    </div>
</div>
</div> 

<div class="flex justify-center items-center mb-4" style="margin-top:10px;">
        <a href="/vehicule">  
            <button class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition transform duration-300 ease-in-out hover:scale-105">
          Search in Another Way</button></a>  
          </div>
          <script>
    $(document).ready(function(){
        $('.flex').hover(function(){
            $(this).find('.hovered-reference').toggleClass('hidden');
        });
    });
</script>




<script>
function incrémenterPopularitéEtNaviguer(referenceId) {
    $.post('/cliquer-sur-reference', {
        _token: '{{ csrf_token() }}',
        reference: referenceId
    }, function(response) {
        console.log("Popularité mise à jour:", response.message); // Confirmation
        // Naviguer vers les détails de la référence
        window.location.href = '/details/' + referenceId; // Rediriger après mise à jour de la popularité
    });
}



</script>


