@include('nav')
<?php
// Informations de connexion à la base de données
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "maes"; 

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les marques distinctes depuis la table vehicule

$sqlMarques = "SELECT marque, MAX(marque_picture) AS marque_picture FROM vehicules GROUP BY marque ORDER BY popularity DESC";
$resultMarques = $conn->query($sqlMarques);





// Récupérer les modèles pour chaque marque

$modelesParMarque = [];

if ($resultMarques->num_rows > 0) {
    while ($rowMarques = $resultMarques->fetch_assoc()) {
        $marque = $rowMarques['marque'];
        $marque_picture = $rowMarques['marque_picture'];
        
        // Récupérer tous les modèles distincts pour cette marque
        $sqlModeles = "SELECT DISTINCT modele, modele_picture FROM vehicules WHERE marque = '$marque'";
        $resultModeles = $conn->query($sqlModeles);
        
        $modeles = [];
        if ($resultModeles->num_rows > 0) {
            while ($rowModeles = $resultModeles->fetch_assoc()) {
                $modeles[] = [
                    'modele' => $rowModeles['modele'],
                    'modele_picture' => $rowModeles['modele_picture']
                ];
            }
        }
        
        $modelesParMarque[] = [
            'marque' => $marque,
            'marque_picture' => $marque_picture,
            'modeles' => $modeles
        ];
    }
}

// // Afficher les résultats (optionnel)
// foreach ($modelesParMarque as $marqueInfo) {
//     echo "Marque: " . $marqueInfo['marque'] . "<br>";
//     echo "Image de la marque: " . $marqueInfo['marque_picture'] . "<br>";
//     echo "Modèles:<br>";
//     foreach ($marqueInfo['modeles'] as $modeleInfo) {
//         echo "- Modèle: " . $modeleInfo['modele'] . "<br>";
//         echo "  Image du modèle: " . $modeleInfo['modele_picture'] . "<br>";
//     }
//     echo "<br>";
// }



// $modelesParMarque = [];
// $imagesVues = []; // Pour garder la trace des images déjà ajoutées


// while ($rowMarques = $resultMarques->fetch_assoc()) {
//     $marque_picture = $rowMarques['marque_picture'];
//     // Éviter les doublons d'images de marques
//     if (!in_array($marque_picture, $imagesVues)) {
//         $imagesVues[] = $marque_picture; // Garder une trace des images ajoutées
//         $modelesParMarque[$marque_picture] = []; // Ajouter l'entrée pour la marque
//     }
    
//     $sqlModeles = "SELECT DISTINCT modele_picture FROM vehicules WHERE marque_picture='$marque_picture'";
//     $resultModeles = $conn->query($sqlModeles);
//     $modeles = [];
//     while ($rowModeles = $resultModeles->fetch_assoc()) {
//         $modeles[] =
//          $rowModeles['modele_picture'];
         

//     }
    
//     $modelesParMarque[$marque_picture] = $modeles;
// }
// $modelesParMarque = [];
    
//     while ($rowMarques = $resultMarques->fetch_assoc()) {
//         $marque_picture = $rowMarques['marque_picture'];
        
//         $sqlModeles = "SELECT DISTINCT modele_picture FROM vehicules ";
//         $resultModeles = $conn->query($sqlModeles);
        
//         $modeles = [];
//         if ($resultModeles->num_rows > 0) {
//             while ($rowModeles = $resultModeles->fetch_assoc()) {
//                 $modeles[] = $rowModeles['modele_picture'];
//             }
//         }
        
//         $modelesParMarque[$marque_picture] = $modeles;
//     }





//Récupérer les couleurs pour chaque modèle
// Requête SQL pour obtenir toutes les couleurs distinctes
$couleursUniques = [];
$couleursParModele = [];

// Requête pour obtenir les couleurs distinctes
$sqlDistinct = "SELECT DISTINCT c.imagecolor 
                FROM colors c 
                JOIN vehicules v ON v.couleur = c.id";

$resultDistinct = $conn->query($sqlDistinct);

if ($resultDistinct->num_rows > 0) {
    while ($row = $resultDistinct->fetch_assoc()) {
        $couleursUniques[] = $row['imagecolor']; // Ajouter la couleur au tableau des couleurs uniques
    }
} else {
    echo "Aucune couleur trouvée.";
}

// Requête pour obtenir les couleurs par modèle
$sqlParModele = "SELECT v.modele_picture, c.imagecolor 
                 FROM vehicules v
                 JOIN colors c ON v.couleur = c.id";

$resultParModele = $conn->query($sqlParModele);

if ($resultParModele->num_rows > 0) {
    while ($row = $resultParModele->fetch_assoc()) {
        $modele_picture = $row['modele_picture'];
        $imagecolor = $row['imagecolor'];

        if (!isset($couleursParModele[$modele_picture])) {
            $couleursParModele[$modele_picture] = [];
        }

        if (!in_array($imagecolor, $couleursParModele[$modele_picture])) {
            $couleursParModele[$modele_picture][] = $imagecolor;
        }
    }
} else {
    echo "Aucun modèle trouvé.";
}

// Requête pour obtenir les références par couleur
$sqlReferences = "SELECT r.reference, c.imagecolor 
                  FROM `references` r
                  JOIN `vehicules` v ON v.reference = r.id
                  JOIN `colors` c ON r.couleur = c.id";

$resultReferences = $conn->query($sqlReferences);

$referencesParCouleur = [];

if ($resultReferences->num_rows > 0) {
    while ($rowReferences = $resultReferences->fetch_assoc()) {
        $imagereference = $rowReferences['reference'];
        $imagecolor = $rowReferences['imagecolor']; 
        
        if (!isset($referencesParCouleur[$imagecolor])) {
            $referencesParCouleur[$imagecolor] = [];
        }

        // Éviter les doublons
        if (!in_array($imagereference, $referencesParCouleur[$imagecolor])) {
            $referencesParCouleur[$imagecolor][] = $imagereference;
        }
    }
} else {
    echo "Aucune référence trouvée.";
}

// Récupérer les annees pour chaque reference
$sqlAnnees = "SELECT r.reference, v.annee 
                  FROM `references` r
                  JOIN `vehicules` v ON v.reference = r.id
                  JOIN `colors` c ON c.id = v.couleur"; // Joindre à la table des couleurs si nécessaire

$resultAnnees = $conn->query($sqlAnnees);
$anneesParReference = [];
$sqlReferences = "SELECT v.annee, r.reference 
                  FROM vehicules v
                  JOIN `references` r ON v.reference = r.id";

$resultReferences = $conn->query($sqlReferences);

while ($rowReferences = $resultReferences->fetch_assoc()) {
    $annee = $rowReferences['annee'];
    $reference = $rowReferences['reference'];

    // Utilisation de la référence comme clé
    if (!isset($anneesParReference[$reference])) {
        $anneesParReference[$reference] = [];
    }

    if (!in_array($annee, $anneesParReference[$reference])) {
        $anneesParReference[$reference][] = $annee; // Ajoute l'année à la liste
    }
}

$conn->close();
?>



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
    max-height: 50px;
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
    border-radius: 50%;
    margin-right: 20px; // Ajouter un espace entre les boutons
}
.reference-btn {
  margin: 15px; /* Ajoute une marge autour du bouton */
  padding: 5px; /* Ajoute de l'espace interne */
  background-color: #fff; /* Couleur de fond pour les boutons */
  border: 1px ; /* Bordure légère */
  border-radius: 50%; /* Coins arrondis */
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
    margin: 10px; /* Ajoute une marge autour du bouton */
  padding: 5px; /* Ajoute de l'espace interne */
  background-color: #f0f0f0; /* Couleur de fond pour les boutons */
  border: 1px ; /* Bordure légère */
  border-radius: 50%; /* Coins arrondis */
}

.annee-btn {
    flex-shrink: 0;
    max-height: 40px;
    border-radius: 5px;
    margin-right: 10px; // Ajouter un espace entre les boutons
}
#boutonsMarque {
    display: flex; /* Pour aligner les boutons sur la même ligne */
    justify-content: flex-start; /* Aligner à gauche, utilisez 'center' ou 'space-between' selon vos besoins */
  }

  #boutonsMarque button {
    background-color: transparent; /* Style du bouton, ajustez comme nécessaire */
    border: none;
  }
</style>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div style="margin-top:100px;" class="overflow-y-auto w-full max-w-lg mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
<form class="space-y-6 " id="mainForm" action="/details-vehicule"  method="POST" >

@csrf <!-- Ajoutez un token CSRF pour la sécurité -->

 <!-- Champs cachés pour transmettre les valeurs -->
 <input type="hidden" name="marque_picture" id="marquePictureHidden">
  <input type="hidden" name="modele_picture" id="modelePictureHidden">
  <input type="hidden" name="imagecolor" id="imageColorHidden">
  <input type="hidden" name="reference" id="referenceHidden">
  <input type="hidden" name="annee" id="anneeHidden">

<!-- Boutons de filtrage pour les marques -->
<div id="boutonsMarque">
<?php foreach ($modelesParMarque as $marqueInfo) { ?>
    <button class="marque-btn" onclick="afficherModeles('<?php echo $marqueInfo['marque']; ?>', '<?php echo $marqueInfo['marque_picture']; ?>')">
                <img src="<?php echo $marqueInfo['marque_picture']; ?>" alt="<?php echo $marqueInfo['marque']; ?>" style="max-height: 65px; border-radius: 50%;">
            </button>
        <?php } ?>
</div>

<!-- Boutons de filtrage pour les modèles -->
<div id="boutonsModele">

  </div>
<!-- Boutons de filtrage pour les couleurs -->
<div id="boutonsCouleurs">
  
</div>


<!-- Boutons de filtrage pour les references -->
<div id="boutonsReference">
  
</div>

<!-- Boutons de filtrage pour les annees -->
<!-- Section pour afficher les boutons d'année -->
<div id="boutonsAnnee">
   
</div>



<div style="width: 100%;"> <!-- Assurez-vous que le conteneur a une largeur définie -->
<button style="display: block; margin: 0 auto;" type="button" onclick="validerFormulaire()" class="valider-btn text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2">
    Valider
  </button>
  
</div>


<!-- <button type="button" onclick="validerFormulaire()" class="valider-btn text-white ml-60 bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Valider</button> -->
  </form>
  </div>


  <script>
    document.getElementById("mainForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Empêcher la soumission automatique
});
    
  var modelesParMarque = <?php echo json_encode($modelesParMarque); ?>;
  var couleursParModele = <?php echo json_encode($couleursParModele); ?>;
  var referencesParCouleur = <?php echo json_encode($referencesParCouleur); ?>;
  var anneesParReference =  <?php echo json_encode($anneesParReference); ?>;
    
  function afficherModeles(marque, marque_picture) {
    document.getElementById("marquePictureHidden").value = marque_picture;
    console.log('Valeur de marque:', marque);
    console.log('Valeur de marque_picture:', marque_picture);
    console.log('Modeles par marque:', modelesParMarque);

    var marqueSelectionnee = modelesParMarque.find(function(marqueInfo) {
        return marqueInfo.marque === marque;
    });

    if (marqueSelectionnee) {
        var modeles = marqueSelectionnee.modeles;
        var boutonsModele = document.getElementById('boutonsModele');
        boutonsModele.innerHTML = '';

        modeles.forEach(function(modele) {
            var boutonModele = document.createElement('button');
            boutonModele.classList.add('modele-btn');
            boutonModele.dataset.marque = marque;

            var imageModele = document.createElement('img');
            imageModele.src = modele.modele_picture;
            imageModele.classList.add('max-height-image');
            imageModele.classList.add('border-radius');

            boutonModele.appendChild(imageModele);
            boutonsModele.appendChild(boutonModele);

            boutonModele.addEventListener('click', function() {
                document.getElementById("modelePictureHidden").value = modele.modele_picture;
                afficherCouleurs(modele.modele_picture);

                var autresBoutonsModele = document.querySelectorAll('.modele-btn');
                autresBoutonsModele.forEach(function(autreBoutonModele) {
                    if (autreBoutonModele !== boutonModele) {
                        autreBoutonModele.style.display = 'none';
                    }
                });
            });
        });

        var boutonsMarque = document.querySelectorAll('.marque-btn');
        boutonsMarque.forEach(function(boutonMarque) {
            if (boutonMarque.getAttribute("onclick") !== `afficherModeles('${marque}', '${marque_picture}')`) {
                boutonMarque.style.display = 'none';
            }
        });

        boutonsMarque.forEach(function(boutonMarque) {
            if (boutonMarque.getAttribute("onclick") === `afficherModeles('${marque}', '${marque_picture}')`) {
                boutonMarque.classList.add('active');
            } else {
                boutonMarque.classList.remove('active');
            }
        });

        var marqueElement = document.querySelector('.marque-btn.active');
        if (marqueElement) {
            var marqueRect = marqueElement.getBoundingClientRect();
            boutonsModele.style.position = 'absolute';
            boutonsModele.style.left = `${marqueRect.right}px`;
            boutonsModele.style.top = `${marqueRect.top}px`;
            window.scrollTo({
                top: marqueRect.top + window.scrollY - 50,
                behavior: 'smooth',
            });
        }
    } else {
        console.log('Aucun modèle trouvé pour la marque:', marque);
    }
}
//   function afficherModeles(marque_picture) {
    
//     document.getElementById("marquePictureHidden").value = marque_picture;

//     console.log('Valeur de marque_picture:', marque_picture);
//     console.log('Modeles par marque:', modelesParMarque);

//     // Recherche de l'objet correspondant à la marque sélectionnée
//     var marqueSelectionnee = modelesParMarque.find(function(marque) {
//         return marque.marque === marque_picture;

//     });

//     if (marqueSelectionnee) {
//         // Si la marque sélectionnée est trouvée, afficher ses modèles
//         var modeles = marqueSelectionnee.modeles;
//         var boutonsModele = document.getElementById('boutonsModele');
//         boutonsModele.innerHTML = ''; // Effacer les boutons de modèle précédents

//         modeles.forEach(function(modele) {
//     var boutonModele = document.createElement('button');
//     boutonModele.classList.add('modele-btn');
//     boutonModele.dataset.marque = marque_picture;

//     var imageModele = document.createElement('img');
//     imageModele.src = modele.modele_picture;
//     // imageModele.alt = modele_picture.altText; 
//     imageModele.classList.add('max-height-image');
//     imageModele.classList.add('border-radius');

//     boutonModele.appendChild(imageModele);

//     // Ajout du bouton au conteneur des modèles
//     boutonsModele.appendChild(boutonModele);
//     // Ajouter un écouteur d'événements pour gérer le clic sur le bouton de modèle
// boutonModele.addEventListener('click', function() {
//     document.getElementById("modelePictureHidden").value = modele.modele_picture;
//         // Lorsque le bouton de modèle est cliqué, afficher les couleurs associées à ce modèle
//         afficherCouleurs(modele.modele_picture);

//         // Cacher les autres boutons de modèle
//         var autresBoutonsModele = document.querySelectorAll('.modele-btn');
//                 autresBoutonsModele.forEach(function(autreBoutonModele) {
//                     if (autreBoutonModele !== boutonModele) {
//                         autreBoutonModele.style.display = 'none';
//                     }
//                 });
// });


//     });

//         // Cacher les autres boutons de marque
//         var boutonsMarque = document.querySelectorAll('.marque-btn');
//         boutonsMarque.forEach(function(boutonMarque) {
//             if (boutonMarque.getAttribute("onclick") !== `afficherModeles('${marque_picture}')`) {
//                 boutonMarque.style.display = 'none';
//             }
//         });

//         // Ajouter la classe active au bouton de marque sélectionné
//         boutonsMarque.forEach(function(boutonMarque) {
//             if (boutonMarque.getAttribute("onclick") === `afficherModeles('${marque_picture}')`) {
//                 boutonMarque.classList.add('active');
//             } else {
//                 boutonMarque.classList.remove('active');
//             }
//         });

     
//         // Positionner le conteneur des modèles à droite du bouton de marque
//         var marqueElement = document.querySelector('.marque-btn.active');
//         if (marqueElement) {
//             var marqueRect = marqueElement.getBoundingClientRect();
//             boutonsModele.style.position = 'absolute';
//             boutonsModele.style.left = `${marqueRect.right}px`;
//             boutonsModele.style.top = `${marqueRect.top}px`;
//             window.scrollTo({
//                 top: marqueRect.top + window.scrollY - 50,
//                 behavior: 'smooth',
//             });
//         }
//     } else {
//         console.log('Aucun modèle trouvé pour la marque:', marque_picture);
//     }
// }


//   function afficherModeles(marque_picture) {

//     document.getElementById("marquePictureHidden").value = marque_picture;
//      // Mettre à jour le champ caché
   

//     // Masquer les autres boutons de marque
//     var boutonsMarque = document.querySelectorAll('#boutonsMarque button');
//     boutonsMarque.forEach(function(bouton) {
//         if (bouton.getAttribute("onclick") !== `afficherModeles('${marque_picture}')`) {
//             bouton.style.display = 'none'; // Masquer les autres boutons de marque
//         }
//     });
    
//      // Debug: Vérifiez le contenu de modelesParMarque
//      console.log('modelesParMarque:', modelesParMarque);
//     console.log('Marque sélectionnée:', marque_picture);

//     var modeles = modelesParMarque[marque_picture];
//     console.log('Modeles pour la marque:', marque_picture, modeles);

//     var boutonsModele = document.getElementById('boutonsModele');
//     boutonsModele.innerHTML = ''; // Effacer les boutons de modèle précédents

//      // Ajouter la classe active au bouton sélectionné

    
//     modeles.forEach(function(modele_picture) {
//         var boutonModele = document.createElement('button');
//         boutonModele.classList.add('modele-btn'); // Ajout d'une classe pour les boutons de modèle
//         boutonModele.dataset.marque = marque_picture; // Ajout d'un attribut data-marque avec la marque
        
//         // Création de l'image à l'intérieur du bouton
//         var imageModele = document.createElement('img');
//         imageModele.src = modele_picture; // Chemin de l'image du modèle provenant de la base de données
//         imageModele.alt = modele_picture.altText; // Texte alternatif de l'image
        

        
//         // Ajout d'une classe CSS à l'image pour définir la hauteur maximale
//         imageModele.classList.add('max-height-image');
//         imageModele.classList.add('border-radius');

//         boutonModele.appendChild(imageModele); // Ajout de l'image à l'intérieur du bouton

        

//         // Ajouter le bouton au conteneur des modèles
//         boutonsModele.appendChild(boutonModele);


//         boutonModele.addEventListener('click', function() {
//             document.getElementById("modelePictureHidden").value = modele_picture;
            
//             // Déplacez visuellement le bouton de modèle vers le haut, près du bouton de marque
//             const marqueRect = document.querySelector(`button[onclick="afficherModeles('${marque_picture}')"]`).getBoundingClientRect();
//             const modeleRect = boutonModele.getBoundingClientRect();

//             // Ajustez la position du bouton de modèle pour le déplacer visuellement vers le haut
//             const yOffset = marqueRect.top - modeleRect.top;

//             boutonsModele.style.transform = `translateY(${yOffset}px)`;

//             afficherCouleurs(modele_picture);
//         });
//     });

//    // Aligner le conteneur des modèles avec le bouton de marque associé
//    const marqueElement = document.querySelector(`button[onclick="afficherModeles('${marque_picture}')"]`);
//     if (marqueElement) {
//         const marqueRect = marqueElement.getBoundingClientRect();

//         // Positionner le conteneur des modèles à droite du bouton de marque
//         boutonsModele.style.position = 'absolute';
//         boutonsModele.style.left = `${marqueRect.right}px`; // Aligné à droite du bouton de marque
//         boutonsModele.style.top = `${marqueRect.top}px`; // Aligné verticalement au bouton de marque

//         // Faire défiler la page pour assurer que le conteneur est visible
//         window.scrollTo({
//             top: marqueRect.top + window.scrollY - 50, // Ajustement vertical
//             behavior: 'smooth',
//         });
//     }

//     // Filtrer les boutons de modèle en fonction de la marque sélectionnée
//     var tousLesModeles = document.querySelectorAll('.modele-btn');
//     tousLesModeles.forEach(function(boutonModele) {
//         if (boutonModele.dataset.marque !== marque_picture) {
//             boutonModele.style.display = 'none';
//         }
//     });
// }

function afficherCouleurs(modele_picture) {
    const boutonsCouleur = document.getElementById("boutonsCouleurs");
    boutonsCouleur.innerHTML = ""; // Effacer les anciens boutons de couleur

   

    <?php foreach ($couleursParModele as $modele_picture => $couleurs) { ?>
        if (modele_picture === "<?php echo $modele_picture; ?>") {
            <?php foreach ($couleurs as $imagecolor) { ?>
                const bouton = document.createElement("button");
                bouton.className = "couleur-btn";
                
                // Crée une image pour le bouton
                const img = document.createElement("img");
                img.src = "<?php echo $imagecolor; ?>"; // Utilise l'URL de l'imagecolor
                img.alt = "Couleur"; // Texte alternatif de l'image
                img.style.maxHeight = "55px"; // Limiter la hauteur de l'image
                img.style.borderRadius = "50%"; // Arrondir les coins de l'image
                
                bouton.appendChild(img); // Ajoute l'image au bouton
                bouton.addEventListener("click", function() {
                    document.getElementById("imageColorHidden").value = "<?php echo $imagecolor; ?>"; // Mettre à jour le champ caché

                    // Positionner le bouton de couleur près du bouton de modèle
                    const modeleElement = document.querySelector(`button img[src="${modele_picture}"]`);
                    if (modeleElement) {
                        const modeleRect = modeleElement.getBoundingClientRect();
                        

                        // Positionner le bouton de couleur près du bouton de modèle
                        boutonsCouleur.style.position = 'absolute';
                        boutonsCouleur.style.left = `${modeleRect.right + 9}px`; // À droite du bouton de modèle
                        boutonsCouleur.style.top = `${modeleRect.top - 15}px`; // Alignement vertical

                        // Faire défiler pour que le conteneur soit visible
                        boutonsCouleur.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }

                  
                    afficherCouleur("<?php echo $imagecolor; ?>"); // Action lors du clic sur le bouton
                });
                
                boutonsCouleur.appendChild(bouton); // Ajoute le bouton au conteneur

            <?php } ?>
        }
    <?php } ?>
}


function afficherCouleur(imagecolor) {
    // Obtenir le conteneur des références
    const boutonsReference = document.getElementById("boutonsReference");

    // Effacer le contenu précédent
    boutonsReference.innerHTML = ""; 
    
    // Obtenir les références associées à cette couleur
    const references = referencesParCouleur[imagecolor] || [];

    // Afficher les références ou un message s'il n'y en a pas
    if (references.length > 0) {
        // Parcourir les références et créer des boutons pour chacun
        references.forEach((reference) => {
            const bouton = document.createElement("button"); // Créer un bouton au lieu d'un élément de liste
            bouton.textContent = reference; // Le texte du bouton est le nom de la référence
            bouton.classList.add("reference-btn"); // Appliquer la classe CSS pour la marge

            
            // Ajouter un événement de clic pour appeler afficherDates avec la référence
            bouton.addEventListener("click", function () {
                document.getElementById("referenceHidden").value = reference; // Mettre à jour le champ caché

                // Afficher les détails de la référence
                afficherDates(reference);
               
            });

            boutonsReference.appendChild(bouton); // Ajouter le bouton au conteneur
        });
    } else {
        boutonsReference.textContent = "Aucune référence trouvée pour cette couleur."; // Message d'absence de référence
    }
}


function afficherDates(reference) {
    console.log("Afficher les années pour la référence:", reference); // Message de débogage
    const boutonsAnnee = document.getElementById("boutonsAnnee");

    boutonsAnnee.innerHTML = "";

    


    const annees = anneesParReference[reference] || [];

    if (annees.length > 0) {
        annees.forEach((annee) => {
            const bouton = document.createElement("button");
            bouton.className = "annee-btn";
            bouton.textContent = annee;
            bouton.classList.add("annee-btn"); // Appliquer la classe CSS pour la marge
            bouton.style.borderRadius = "50%";

            
 // Ajouter un gestionnaire de clic pour chaque bouton
 bouton.addEventListener("click", function () {

    document.getElementById("anneeHidden").value = annee;

                // Masquer tous les autres boutons d'année
                const tousLesBoutons = boutonsAnnee.getElementsByClassName("annee-btn");
                for (let btn of tousLesBoutons) {
                    btn.style.display = "none"; // Masquer les autres boutons
                }
                // Afficher uniquement le bouton cliqué
                bouton.style.display = "block"; 
                // bouton.style.backgroundColor = "#ccc"; // Changer le style pour mettre en évidence
                bouton.style.border = "0px  "; 


            });

            boutonsAnnee.appendChild(bouton);
        });
    } else {
        boutonsAnnee.textContent = "Aucune année trouvée pour cette référence.";
    }

    console.log("Années affichées:", annees); // Vérifier si des années sont affichées
}



function afficherAnnee(reference, annee) {
    // Obtenir le conteneur des boutons d'années
    const boutonsAnnee = document.getElementById("boutonsAnnee");

    // Masquer tous les boutons
    const tousLesBoutons = boutonsAnnee.getElementsByClassName("annee-btn");
    for (let bouton of tousLesBoutons) {
        bouton.style.display = "none"; // Masquer tous les autres boutons
    }

    // Afficher uniquement le bouton correspondant à l'année sélectionnée
    const boutonSelectionne = Array.from(tousLesBoutons).find(
        (btn) => btn.textContent === annee
    );
    if (boutonSelectionne) {
        boutonSelectionne.style.display = "block"; // Afficher le bouton sélectionné
        // boutonSelectionne.style.backgroundColor = "#ccc"; // Changer le style pour mettre en évidence
        boutonSelectionne.style.border = "1px "; // Bordure pour différencier le bouton sélectionné

        // Mettre à jour le champ caché avec l'année sélectionnée
        document.getElementById("anneeHidden").value = annee;

    }
}


function validerFormulaire() {
  document.getElementById("mainForm").submit(); // Soumettre le formulaire
}













</script>


</body>
</html>

