<?php
// Informations de connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL (généralement localhost pour XAMPP)
$username = "root"; // Nom d'utilisateur par défaut pour MySQL dans XAMPP
$password = ""; // Mot de passe par défaut est souvent vide pour XAMPP
$dbname = "maes"; // Remplacez ceci par le nom de votre base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les marques distinctes depuis la table vehicule
$sqlMarques = "SELECT DISTINCT marque_picture FROM vehicules";
$resultMarques = $conn->query($sqlMarques);

// Récupérer les modèles pour chaque marque
$modelesParMarque = [];
while ($rowMarques = $resultMarques->fetch_assoc()) {
    $marque_picture = $rowMarques['marque_picture'];
    $sqlModeles = "SELECT DISTINCT modele_picture FROM vehicules WHERE marque_picture='$marque_picture'";
    $resultModeles = $conn->query($sqlModeles);
    $modeles = [];
    while ($rowModeles = $resultModeles->fetch_assoc()) {
        $modeles[] = $rowModeles['modele_picture'];
    }
    $modelesParMarque[$marque_picture] = $modeles;
}

//Récupérer les couleurs pour chaque modèle
$couleursParModele = [];
$sqlCouleurs = "SELECT v.modele_picture, c.imagecolor 
                FROM vehicules v
                JOIN colors c ON v.couleur = c.id
                GROUP BY  c.imagecolor";
$resultCouleurs = $conn->query($sqlCouleurs);
while ($rowCouleurs = $resultCouleurs->fetch_assoc()) {
    $modele_picture = $rowCouleurs['modele_picture'];
    $imagecolor = $rowCouleurs['imagecolor'];
    if (!isset($couleursParModele[$modele_picture])) {
        $couleursParModele[$modele_picture] = [];
    }
    $couleursParModele[$modele_picture][] = $imagecolor;
}


// Récupérer les références pour chaque couleur
$referencesParCouleur = [];
$sqlReferences = "SELECT r.reference, c.imagecolor 
                  FROM `references` r
                  JOIN `vehicules` v ON v.reference = r.id
                  JOIN `colors` c ON r.couleur = c.id
                  GROUP BY r.reference, c.imagecolor ";
$resultReferences = $conn->query($sqlReferences);

while ($rowReferences = $resultReferences->fetch_assoc()) {
    $imagereference = $rowReferences['reference'];
    $imagecolor = $rowReferences['imagecolor']; // Ajout de la couleur à partir de la requête SQL
    // Vérifie si la couleur existe déjà dans le tableau
    if (!isset($referencesParCouleur[$imagecolor])) {
        // Si la couleur n'existe pas encore, initialise un tableau vide pour cette couleur
        $referencesParCouleur[$imagecolor] = [];
    }
    // Ajoute la référence au tableau des références correspondant à la couleur
    $referencesParCouleur[$imagecolor][] = $imagereference ;
}

// Récupérer les annees pour chaque reference
$anneesParReference = [];
$sqlCouleurs = "SELECT DISTINCT v.annee, c.reference 
                FROM vehicules v
                JOIN `references` c ON v.reference = c.id
                GROUP BY v.annee";
$resultCouleurs = $conn->query($sqlCouleurs);
while ($rowCouleurs = $resultCouleurs->fetch_assoc()) {
    $annee = $rowCouleurs['annee'];
    $imagereference = $rowCouleurs['reference'];
    if (!isset($anneesParReference[$annee])) {
        $anneesParReference[$annee] = [];
    }
    $anneesParReference[$annee][] = $annee;
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>

<title>Afficher les modèles et les couleurs</title>
<style>
  /* Style pour cacher les modèles et les couleurs par défaut */
  /* .modele, .couleur, .reference .annee {
    display: none;
  } */
  .max-height-image {
    max-height: 65px; /* Réglez la hauteur maximale selon vos besoins */
}
.border-radius{
    border-radius: 50%;
}
.text-center{
    text-align:center;
}

#boutonsCouleur{
    display: flex;
    flex-wrap: wrap;  // Permet d'avoir plusieurs lignes si nécessaire
    justify-content: flex-start;  // Aligner les boutons à gauche
}

.couleur-btn{
    flex-shrink: 0;
    max-height: 40px;
    border-radius: 5px;
    margin-right: 10px; // Ajouter un espace entre les boutons
}
.couleur-btn {
    margin-bottom: 20px; // Ajoute de l'espace sous le bouton de couleur
}
#boutonsReference {
    display: flex;
    flex-wrap: wrap;  // Permet d'avoir plusieurs lignes si nécessaire
    justify-content: flex-start;  // Aligner les boutons à gauche

}
.reference-btn{
    flex-shrink: 0;
    max-height: 40px;
    border-radius: 5px;
    margin-right: 10px; // Ajouter un espace entre les boutons
}
.reference-group {
    margin-top: 20px; // Ajoute de l'espace au-dessus du groupe de références
}
#boutonsAnnee {
    display: flex;
    justify-content: flex-start;
    flex-wrap: nowrap;
}

.annee-btn {
    flex-shrink: 0;
    max-height: 40px;
    border-radius: 5px;
    margin-right: 18px; // Ajouter un espace entre les boutons
}


</style>
</head>
<body>
<div class="w-full max-w-sm mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
<form class="space-y-6 " action="#" >
<!-- Boutons de filtrage pour les marques -->
<div id="boutonsMarque">
  <?php foreach ($modelesParMarque as $marque_picture => $modeles) { ?>
    <button onclick="afficherModeles('<?php echo $marque_picture; ?>')">
    <img src="<?php echo $marque_picture; ?>" alt="<?php echo $marque_picture; ?>" style="max-height: 65px; border-radius: 50%;"> <!-- Ajout de l'image -->
    <!-- <?php echo $marque_picture; ?> -->

   
</button>
  <?php } ?>
</div>

<!-- Boutons de filtrage pour les modèles -->
<div id="boutonsModele">
<?php foreach ($couleursParModele as $modele_picture => $couleurs) { ?>
    <button  class="modele-btn" onclick="afficherCouleurs('<?php echo $modele_picture; ?>')">
    <img src="<?php echo $modele_picture; ?>" alt="<?php echo $modele_picture; ?>" style="max-height: 65px; border-radius: 50%;"> <!-- Ajout de l'image -->
    <!-- <?php echo $marque_picture; ?> -->

   
</button>
  <?php } ?>
  </div>
<!-- Boutons de filtrage pour les couleurs -->
<div id="boutonsCouleur">
    <?php foreach ($couleursParModele as $modele_picture => $couleurs) { ?>
        <div class="couleur-group" data-modele="<?php echo $modele_picture; ?>">
            <?php foreach ($couleurs as $imagecolor) { ?>
                <button class="couleur-btn" onclick="afficherReferences('<?php echo $imagecolor; ?>')">
                    <!-- Ici vous pouvez également utiliser une image pour représenter la couleur -->
                    <img src="<?php echo $imagecolor; ?>"alt="<?php echo $imagecolor; ?>" style="max-height: 65px; border-radius: 50%;" ></img>
                </button>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Boutons de filtrage pour les references -->
<div id="boutonsReference">
    <?php foreach ($referencesParCouleur as $imagecolor => $references) { ?>
        <div class="reference-group" data-couleur="<?php echo $imagecolor; ?>">
            <?php foreach ($references as $reference) { ?>
                <button class="reference-btn" data-reference="<?php echo $reference; ?>" >
                    <?php echo $reference; ?>
                </button>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Boutons de filtrage pour les annees -->
<div id="boutonsAnnee">
    <?php foreach ($anneesParReference as $annee => $references) { ?>
        <div class="annee-group" data-annee="<?php echo $annee; ?>">
            <?php foreach ($references as $reference) { ?>
                <button class="annee-btn" data-reference="<?php echo $reference; ?>" 
                data-annee="<?php echo $annee; ?>">
                    <?php echo $annee; ?>
                </button>
            <?php } ?>
        </div>
    <?php } ?>
</div>



<button type="button" class="text-white ml-60 bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Valider</button>
  </form>
  </div>

<script>
    
  var modelesParMarque = <?php echo json_encode($modelesParMarque); ?>;
  var couleursParModele = <?php echo json_encode($couleursParModele); ?>;
  var referencesParCouleur = <?php echo json_encode($referencesParCouleur); ?>;
  var anneesParReference =  <?php echo json_encode($anneesParReference); ?>;


  function afficherModeles(marque_picture) {
    // Masquer les autres boutons de marque
    var boutonsMarque = document.querySelectorAll('#boutonsMarque button');
    boutonsMarque.forEach(function(bouton) {
        if (bouton.getAttribute("onclick") !== `afficherModeles('${marque_picture}')`) {
            bouton.style.display = 'none'; // Masquer les autres boutons de marque
        }
    });


    var modeles = modelesParMarque[marque_picture];
    var boutonsModele = document.getElementById('boutonsModele');
    boutonsModele.innerHTML = ''; // Effacer les boutons de modèle précédents
    
    modeles.forEach(function(modele_picture) {
        var boutonModele = document.createElement('button');
        boutonModele.classList.add('modele-btn'); // Ajout d'une classe pour les boutons de modèle
        boutonModele.dataset.marque = marque_picture; // Ajout d'un attribut data-marque avec la marque
        
        // Création de l'image à l'intérieur du bouton
        var imageModele = document.createElement('img');
        imageModele.src = modele_picture; // Chemin de l'image du modèle provenant de la base de données
        imageModele.alt = modele_picture.altText; // Texte alternatif de l'image
        // Ajout d'une classe CSS à l'image pour définir la hauteur maximale
        // imageModele.classList.add('max-height-image');
        // imageModele.classList.add('border-radius');

        boutonModele.appendChild(imageModele); // Ajout de l'image à l'intérieur du bouton
        boutonsModele.appendChild(boutonModele);

        boutonModele.addEventListener('click', function() {
            afficherCouleurs(modele_picture);
        });
    });

    // Filtrer les boutons de modèle en fonction de la marque sélectionnée
    var tousLesModeles = document.querySelectorAll('.modele-btn');
    tousLesModeles.forEach(function(boutonModele) {
        if (boutonModele.dataset.marque !== marque_picture) {
            boutonModele.style.display = 'none';
        }
    });
}


function afficherCouleurs(modele_picture) {

    if (!couleursParModele[modele_picture]) {
        console.warn("Pas de couleurs disponibles pour ce modèle.");
        return;
    }

    var couleurs = couleursParModele[modele_picture];
    var boutonsCouleur = document.getElementById('boutonsCouleur');
    boutonsCouleur.innerHTML = ''; // Effacer les boutons de couleur précédents
    
    couleurs.forEach(function(imagecolor) {
        var boutonCouleur = document.createElement('button');
        boutonCouleur.classList.add('couleur-btn'); // Ajout d'une classe pour les boutons de couleur
        boutonCouleur.dataset.modele = modele_picture; // Ajout d'un attribut data-modele avec le modèle
        
        // Création de l'image à l'intérieur du bouton
        var imageCouleur = document.createElement('img');
        imageCouleur.src = imagecolor; // Chemin de l'image de la couleur provenant de la base de données
        imageCouleur.alt = imagecolor.altText; // Texte alternatif de l'image
        // Ajout d'une classe CSS à l'image pour définir la hauteur maximale
        imageCouleur.classList.add('max-height-image');
        imageCouleur.classList.add('border-radius');

        boutonCouleur.appendChild(imageCouleur); // Ajout de l'image à l'intérieur du bouton
        boutonsCouleur.appendChild(boutonCouleur);

        boutonCouleur.addEventListener('click', function() {
            afficherReferences(imagecolor);
        });
    });

    // Filtrer les boutons de couleur en fonction du modèle sélectionné
    var tousLesBoutonsCouleur = document.querySelectorAll('.couleur-btn');
    tousLesBoutonsCouleur.forEach(function(boutonCouleur) {
        if (boutonCouleur.dataset.modele !== modele_picture) {
            boutonCouleur.style.display = 'none';
        }
    });
}


function afficherReferences(imagecolor) {
  console.log(referencesParCouleur);
  var references = referencesParCouleur[imagecolor];
  if (references) {
    var boutonsReference = document.getElementById('boutonsReference');
    boutonsReference.innerHTML = '';
    references.forEach(function(reference) {
      var boutonReference = document.createElement('button');
      boutonReference.textContent = reference;
        // boutonReference.classList.add('max-height-image');
        // boutonReference.classList.add('border-radius');
        boutonReference.classList.add('text-center');
        boutonReference.addEventListener('click', function() {
            afficherAnnees(reference); // Appel de la fonction afficherAnnees
        });
      boutonsReference.appendChild(boutonReference);
    });
  } else {
    console.error("Aucune référence trouvée pour la couleur:", couleur);
  }
}



function afficherAnnees(reference) {
    console.log('Afficher années pour référence:', reference); // Pour le débogage
    const boutonsAnnee = document.querySelectorAll('.annee-btn');

    boutonsAnnee.forEach((bouton) => {
        // Vérifiez que data-reference correspond bien à la référence donnée
        const boutonReference = bouton.getAttribute('data-reference');
        console.log('Vérification de bouton:', bouton, 'avec data-reference:', boutonReference);

        if (boutonReference === reference) {
            bouton.style.display = 'inline-block'; // Afficher les bons boutons
        } else {
            bouton.style.display = 'none'; // Masquer les autres
        }
    });
}

// Ajoutez des événements de clic aux boutons de référence
document.querySelectorAll('.reference-btn').forEach((bouton) => {
    bouton.addEventListener('click', (event) => {
        // Récupérer la référence directement du bouton
        const reference = event.target.getAttribute('data-reference'); 
        afficherAnnees(reference); // Appeler la fonction avec la référence obtenue
    });
});



</script>

</body>
</html>