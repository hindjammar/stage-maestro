
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>

<title>Filtrage de modèles de voiture</title>
<style>
  .car-model {
    display: flex;
  }
  
  .marque-btn {
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 5px 10px;
    /* border: 1px solid #ccc; */
    border-radius: 5px;
    cursor: pointer;
  }
  
  .marque-btn.active {
    background-color: #007bff;
    color: #fff;
  }

  .modele-btn {
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 5px 10px;
    /* border: 1px solid #ccc; */
    border-radius: 5px;
    cursor: pointer;
  }
  
</style>
</head>
<body>

<h2>Filtrer les modèles de voiture par marque</h2>
<div class="w-full max-w-sm mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
<form class="space-y-6" action="#">

        <div id="marqueButtons">
        @foreach($vehicules as $vehicule)
            @if ($loop->first || $vehicule->marque !== $vehicules[$loop->index - 1]->marque)
                <button class="marque-btn" data-marque="{{ $vehicule->marque }}">
                    <img src="{{ $vehicule->marque_picture }}" alt="" style="max-height: 45px; border-radius: 50%;">
                </button>
            @endif
        @endforeach
        </div>
   
            <div id="carModels">
            @foreach($vehicules as $vehicule)
                <div class="car-model {{ $vehicule->marque }}">
                    <button class="modele-btn" data-marque="{{ $vehicule->marque }}">
                        <img src="{{ $vehicule->modele_picture }}" alt="" style="max-height: 45px; border-radius: 50%;">
                        {{$vehicule->modele }}
                    </button>
                    
                </div>
            @endforeach
            </div>


            <div id="colorFamily">
    @foreach($vehicules as $vehicule)
        @foreach($colors as $color)
            @if ($color->marque === $vehicule->marque && $color->modele === $vehicule->modele)
                <button class="marque-btn color-btn" data-color="{{ $color->couleur }}" data-marque="{{ $color->marque }}">
                    <img src="{{ $color->imagecolor }}" style="max-height: 45px; border-radius: 50%;">
                </button>
            @endif
        @endforeach
    @endforeach
</div>

</div>

</form>

</div>
<!-- <script>
  const marqueButtons = document.querySelectorAll('.marque-btn');
  const modeleButtons = document.querySelectorAll('.modele-btn');

  marqueButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      const selectedMarque = this.getAttribute('data-marque');
      
      marqueButtons.forEach(function(btn) {
        btn.classList.remove('active');
      });
      
      this.classList.add('active');
      
      document.getElementById('carModels').scrollIntoView();
      
      document.querySelectorAll('.car-model').forEach(function(model) {
        if (model.classList.contains(selectedMarque)) {
          model.style.display = 'flex';
        } else {
          model.style.display = 'none';
        }
      });
    });
  });

  modeleButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    const selectedMarque = this.getAttribute('data-marque');
    const parentModel = this.parentNode;

    // Vérifie si la marque est déjà sélectionnée
    const isMarqueSelected = Array.from(marqueButtons).some(btn => btn.classList.contains('active'));

    if (isMarqueSelected) {
      const carModels = document.getElementById('carModels');
      const firstModel = carModels.querySelector(`.car-model.${selectedMarque}`);

      // Récupérer le premier bouton de modèle dans la première ligne
      const firstButton = firstModel.querySelector('.modele-btn');
      
      // Déplacer le bouton de modèle vers le haut
      carModels.insertBefore(this, firstButton);
    }
  });
});

</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const marqueButtons = document.querySelectorAll('.marque-btn');
        const modeleButtons = document.querySelectorAll('.modele-btn');
        const colorButtons = document.querySelectorAll('.color-btn');

        // Ajouter un écouteur d'événements à chaque bouton de marque
        marqueButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const selectedMarque = this.getAttribute('data-marque');

                // Cacher tous les boutons de marque sauf celui sélectionné
                marqueButtons.forEach(function(btn) {
                    if (btn !== button) {
                        btn.style.display = 'none';
                    }
                });

                // Afficher les boutons de modèle qui appartiennent à la marque sélectionnée
                modeleButtons.forEach(function(btn) {
                    if (btn.getAttribute('data-marque') === selectedMarque) {
                        btn.style.display = 'inline-block';
                    } else {
                        btn.style.display = 'none';
                    }
                });

                // Mettre à jour la classe active pour les boutons de marque
                marqueButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
            });
        });

        // Ajouter un écouteur d'événements à chaque bouton de modèle
        modeleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const selectedMarque = this.getAttribute('data-marque');
                const selectedModele = this.getAttribute('data-modele');

                // Cacher tous les boutons de modèle qui n'appartiennent pas au modèle sélectionné
                modeleButtons.forEach(function(btn) {
                    if (btn.getAttribute('data-marque') === selectedMarque && btn !== button) {
                        btn.style.display = 'none';
                    }
                });

                // Afficher les boutons de couleur qui appartiennent au modèle sélectionné
                colorButtons.forEach(function(btn) {
                    if (btn.getAttribute('data-color') === selectedModele && btn.getAttribute('data-marque') === selectedMarque) {
                        btn.style.display = 'inline-block';
                    } else {
                        btn.style.display = 'none';
                    }
                });
            });
        });
    });
</script>


</body>
</html>



