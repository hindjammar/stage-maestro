<!-- Vue Blade: client.detailsvehicule -->
@include('nav')

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Détails du Véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Ajoutez des liens vers vos feuilles de style ou d'autres ressources -->
</head>
</html>


<!-- component -->
<div class="md:flex items-start justify-center py-12 2xl:px-20 md:px-6 px-4">
  <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

  <div class="xl:w-2/6 lg:w-2/5 w-80 md:block hidden">
    <img class="w-full" alt="image of a girl posing" src="{{ asset($marque_picture) }}" alt="Image de la marque" />
    <img class="mt-6 w-full" alt="image of a girl posing" src="{{ asset($modele_picture) }}" alt="Image de la marque" />
  </div>
  <div class="md:hidden">
  <img class="mt-6 w-full" alt="image of a girl posing" src="{{ asset($modele_picture) }}" alt="Image de la marque" />
    <div class="flex items-center justify-between mt-3 space-x-4 md:space-x-0">
    <img class="w-full" alt="image of a girl posing" src="{{ asset($marque_picture) }}" alt="Image de la marque" />
    </div>
  </div>
  <div class="xl:w-2/5 md:w-1/2 lg:ml-8 md:ml-6 md:mt-0 mt-6">
    <div class="border-b border-gray-200 pb-6">
      <p class="text-sm leading-none text-gray-600 dark:text-gray-300 ">Maestro Product</p>
      <h1 class="lg:text-2xl text-xl font-semibold lg:leading-6 leading-7 text-gray-800 dark:text-white mt-2">Details</h1>
    </div>
    <div class="py-4 border-b border-gray-200 flex items-center justify-between">
      <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Colors Family</p>
      <div class="flex items-center justify-center">
        <p class="text-sm leading-none text-gray-600 dark:text-gray-300"></p>
       
        <img  width= 30px height= 30px src="{{ asset($imagecolor)}}">
      </div>
    </div>
    <!-- <div class="py-4 border-b border-gray-200 flex items-center justify-between">
      <div class="flex items-center justify-center">
      
      </div>
    </div> -->
    
    <div>
      <p class="text-base leading-4 mt-7 text-gray-600 dark:text-gray-300">Reference: {{ $reference}}</p>
      <p class="text-base leading-4 mt-4 text-gray-600 dark:text-gray-300">Year: {{ $annee}} </p>
      <p class="text-base leading-4 mt-4 text-gray-600 dark:text-gray-300">Composants de references: 
      @if(count($components) > 0)

      <ul>
        @foreach($components as $component)
            <li>{{ $component->name }} - {{ $component->quantity }} - {{$component->unit}}</li>
        @endforeach
    </ul>
    @else
    <p>Aucun composant trouvé pour cette référence.</p>
@endif
      </p>
    </div>
    <!-- <div>
      <div class="border-t border-b py-4 mt-7 border-gray-200">
        
      </div>
    </div> -->
    <div>
    <div class="border-t border-b py-4 mt-7 border-gray-200">
        <div data-menu class="flex justify-between items-center cursor-pointer">
          <p class="text-base leading-4 text-gray-800 dark:text-gray-300">Contact us</p>
          <button class="cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 rounded" role="button" aria-label="show or hide">
            <svg class="transform text-gray-300 dark:text-white" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
        <div class="hidden pt-4 text-base leading-normal pr-12 mt-4 text-gray-600 dark:text-gray-300" id="sect">If you have any questions on how to return your item to us, contact us.</div>
      </div>

      <div class="flex justify-start w-1/2"> <!-- Ajustez la largeur ici -->
      <a          class="dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-base flex items-center justify-center leading-none text-white bg-gray-800 w-full py-4 hover:bg-gray-700 focus:outline-none " style="margin-top:10px;"
 href="/vehicule">
      <button
    >
     Back
        </button>
      </a>
  
</div>


    </div>
  </div>
</div>
<script>
    let elements = document.querySelectorAll("[data-menu]");
for (let i = 0; i < elements.length; i++) {
  let main = elements[i];
  main.addEventListener("click", function () {
    let element = main.parentElement.parentElement;
    let andicators = main.querySelectorAll("svg");
    let child = element.querySelector("#sect");
    child.classList.toggle("hidden");
    andicators[0].classList.toggle("rotate-180");
  });
}
</script>

