<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body class="relative bg-yellow-50 overflow-hidden max-h-screen">
<script src="https://cdn.tailwindcss.com"></script>

@include('creator.side')

<main class="ml-60 pt-16 max-h-screen overflow-auto flex justify-between">
<div class="flex items-center justify-center w-full p-12">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="mx-auto w-full max-w-[550px] bg-white">
    <form action="/api/submit-form" method="post"
      class="py-6 px-9"  enctype="multipart/form-data"
      
    >
    @csrf
      <div class="mb-5">
        <label
          for="email"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Saisir une couleur:
        </label>
        <input
          type="text"
          name="couleur"
          id="couleur"
          placeholder="Entrer une couleur"
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
        />
      </div>

      <!-- <div class="w-full md:w-1/2 relative grid grid-cols-1 md:grid-cols-3 border border-gray-300 bg-gray-100 rounded-lg"> -->
   
    <div 
        class="relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
            <span class="text-gray-400 opacity-75">
                <svg class="w-14 h-14"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            </span>
            <img id="selectedImage" class="absolute inset-0 w-full h-full object-cover rounded-lg" src="" alt="Selected Image" style="display: none;">

    </div>
    <div
        class="rounded-l-lg p-4 bg-gray-200 flex flex-col justify-center items-center border-0 border-r border-gray-300 ">
        <label class="cursor-pointer hover:opacity-80 inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
        rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
       focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" for="restaurantImage">
           
    Select image
            <input id="restaurantImage" class="text-sm cursor-pointer w-36 hidden" type="file" name="imagecolor"  accept="image/*">
        </label>
    <button id="removeImageButton" 
    class = 'hidden inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
        rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
       focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
    remove image
</button>

<button type="submit" class = ' inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
        rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
       focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>Ajouter</button>
    </div>
</div>
       
    </form>
  </div>
</div>


<script>
  const restaurantImageInput = document.getElementById('restaurantImage');
  const removeImageButton = document.getElementById('removeImageButton');
  const selectedImage = document.getElementById('selectedImage');

  restaurantImageInput.addEventListener('change', function() {
    if (restaurantImageInput.files.length > 0) {
      const reader = new FileReader();
      reader.onload = function(e) {
        selectedImage.src = e.target.result;
        selectedImage.style.display = 'block';
      };
      reader.readAsDataURL(restaurantImageInput.files[0]);
      removeImageButton.classList.remove('hidden');
    } else {
      selectedImage.src = '';
      selectedImage.style.display = 'none';
      removeImageButton.classList.add('hidden');
    }
  });

  removeImageButton.addEventListener('click', function() {
    restaurantImageInput.value = '';
    selectedImage.src = '';
    selectedImage.style.display = 'none';
    removeImageButton.classList.add('hidden');
  });
</script>

<div class="flex items-center justify-center w-full p-12">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="mx-auto w-full max-w-[550px] bg-white">
    <form class="py-6 px-9" action="/formulaire" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-5">
        <label for="reference" class="mb-3 block text-base font-medium text-[#07074D]">
          Saisir une reference:
        </label>
        <input type="text" name="reference" required id="reference" placeholder="entrer une reference" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />

        <select  name="couleur"  class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md my-2">
          <option value="selected">Choose a Color </option>
          @foreach($colors as $color)
          <option value="{{$color->id}}">{{$color->couleur}}</option>
          @endforeach
        </select>
      </div>

      <div class="relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover">
        <span class="text-gray-400 opacity-75">
          <svg class="w-14 h-14" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
          </svg>
        </span>
        <img id="selectedImage1" class="absolute inset-0 w-full h-full object-cover rounded-lg" src="" alt="Selected Image" style="display: none;">

      </div>
      <div class="rounded-l-lg p-4 bg-gray-200 flex flex-col justify-center items-center border-0 border-r border-gray-300 ">
        <label class="cursor-pointer hover:opacity-80 inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" for="restaurantImage1">
          Select image
          <input required id="restaurantImage1" class="text-sm cursor-pointer w-36 hidden" type="file" name="imagereference">
        </label>
        <button id="removeImageButton1" class='hidden inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>Remove image</button>

        <button type="submit" class = ' inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent
        rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none 
       focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>Ajouter</button>
      </div>
    </div>

  </form>
</div>
</div>
<script>
  const restaurantImageInput1 = document.getElementById('restaurantImage1');
  const removeImageButton1 = document.getElementById('removeImageButton1');
  const selectedImage1 = document.getElementById('selectedImage1');

  restaurantImageInput1.addEventListener('change', function() {
    if (restaurantImageInput1.files.length > 0) {
      const reader = new FileReader();
      reader.onload = function(e) {
        selectedImage1.src = e.target.result;
        selectedImage1.style.display = 'block';
      };
      reader.readAsDataURL(restaurantImageInput1.files[0]);
      removeImageButton1.classList.remove('hidden');
    } else {
      selectedImage1.src = '';
      selectedImage1.style.display = 'none';
      removeImageButton1.classList.add('hidden');
    }
  });

  removeImageButton1.addEventListener('click', function() {
    restaurantImageInput1.value = '';
    selectedImage1.src = '';
    selectedImage1.style.display = 'none';
    removeImageButton1.classList.add('hidden');
  });
</script>
</main>


</body>
