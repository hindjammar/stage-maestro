<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="relative bg-yellow-50 overflow-hidden max-h-screen">
<script src="https://cdn.tailwindcss.com"></script>

@include('creator.side')

<main class="ml-60 pt-48 max-h-screen overflow-auto flex justify-between">
<div class="flex items-center justify-center w-full p-12">
  <!-- Author: FormBold Team -->
  <!-- Learn More: https://formbold.com -->
  <div class="mx-auto w-full max-w-[700px] h-[900px] bg-white">

    <form  action="" method="post">
    @csrf

<div class="mb-3"  id="components">
        <label
          for="Composants"
          class="mb-1 block text-base font-medium text-[#07074D]"
        >
          Saisir le composant:
        </label>
        <input
          type="text"
          name="component_name[]"    
          id="component_name"
          placeholder="Composant"
          required
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
        />
        <input type="number" style="margin-top:15px;"
         name="component_quantity[]" 
         id="component_quantity"
         placeholder="Quantité" 
         required
        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
       />

       <select name="component_unit[]"  style="margin-top:15px;"
       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                                <option value="">Choisir une unité</option>
                                <option value="g">g (grammes)</option>
                                <option value="ml">ml (millilitres)</option>
                            </select>
      </div>
      <button type="button" onclick="addComponent()" 
                            class="rounded-md bg-black py-3 px-8 text-white font-semibold">Ajouter un Composant</button>
     
      <div class="flex justify-center items-center">
      <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-12 py-2.5 me-2 mb-2 mt-6 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Ajouter</button>
      </div>
      </form>
</div>


<script>
        function addComponent() {
            const componentSection = document.getElementById("components");

            const newDiv = document.createElement("div");
            newDiv.className = "mb-3 mt-4";
           

            // Ensemble avec nom du composant, quantité, et sélection de l'unité
            newDiv.innerHTML = `
            <input
          type="text"
          name="component_name[]"    
          id="component_name"
          placeholder="Composant"
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
        />
        <input type="number" style="margin-top:15px;"
         name="component_quantity[]" 
         id="component_quantity"
         placeholder="Quantité" 
        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
       />

       <select name="component_unit[]"  style="margin-top:15px;"
       class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                                <option value="">Choisir une unité</option>
                                <option value="g">g (grammes)</option>
                                <option value="ml">ml (millilitres)</option>
                            </select>
                <button type="button" onclick="removeComponent(this)" 
                        class="ml-2 rounded-md bg-red-500 py-2 px-4 text-white font-semibold">Supprimer</button>
            `;

            componentSection.appendChild(newDiv);
        }

        function removeComponent(button) {
            const componentDiv = button.parentNode;
            const componentSection = componentDiv.parentNode;
            componentSection.removeChild(componentDiv);
        }
    </script>
</body>