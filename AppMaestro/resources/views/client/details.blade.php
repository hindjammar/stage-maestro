@include('nav')

    
<style>
  table {
    width: 100%; /* Définit la largeur du tableau à 100% */
    border-collapse: collapse; /* Fusionne les bordures des cellules pour un aspect plus net */
  }
  th, td {
    padding: 10px; /* Ajoute un padding de 10 pixels autour des cellules */
    text-align: left; /* Alignement du texte à gauche dans toutes les cellules */
    border: 1px solid #dddddd; /* Bordure de 1 pixel solide de couleur grise */
  }
  th {
    background-color: #f2f2f2; /* Couleur de fond gris clair pour les en-têtes de colonne */
  }
</style>
<!-- decr -->
<link rel="icon" type="image/png" href="{{ asset('images/maes.png') }}"> 

<head>
<script>

$(document).ready(function() {
 
 $('.color-choose input').on('click', function() {
     var headphonesColor = $(this).attr('data-image');

     $('.active').removeClass('active');
     $('.left-column img[data-image = ' + headphonesColor + ']').addClass('active');
     $(this).addClass('active');
 });

});
</script>

<style>
  .container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 15px;
  display: flex;
  margin-top:180px;
}

.left-column {
  width: 65%;
  position: relative;
}
 
.right-column {
  width: 35%;
  margin-top: 60px;
}

.left-column img {
  width: 100%;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  transition: all 0.3s ease;
}
 
.left-column img.active {
  opacity: 1;
}

/* Product Description */
.product-description {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}
.product-description span {
  font-size: 12px;
  color: #358ED7;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-decoration: none;
}
.product-description h1 {
  font-weight: 300;
  font-size: 52px;
  color: #43484D;
  letter-spacing: -2px;
}
.product-description p {
  font-size: 16px;
  font-weight: 300;
  color: #86939E;
  line-height: 24px;
}

/* Product Color */
.product-color {
  margin-bottom: 30px;
}
 
.color-choose div {
  display: inline-block;
}
 
.color-choose input[type="radio"] {
  display: none;
}
 
.color-choose input[type="radio"] + label span {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: -1px 4px 0 0;
  vertical-align: middle;
  cursor: pointer;
  border-radius: 50%;
  border: 2px solid #FFFFFF;
  box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
}
 
.color-choose input[type="radio"]#red + label span {
  background-color: #C91524;
}
.color-choose input[type="radio"]#blue + label span {
  background-color: #314780;
}
.color-choose input[type="radio"]#black + label span {
  background-color: #323232;
}
 
.color-choose input[type="radio"]:checked + label span {
  background-image: url(images/check-icn.svg);
  background-repeat: no-repeat;
  background-position: center;
}
.cable-choose {
  margin-bottom: 20px;
}
 
.cable-choose button {
  border: 2px solid #E1E8EE;
  border-radius: 6px;
  padding: 13px 20px;
  font-size: 14px;
  color: #5E6977;
  background-color: #fff;
  cursor: pointer;
  transition: all .5s;
}
 
.cable-choose button:hover,
.cable-choose button:active,
.cable-choose button:focus {
  border: 2px solid #86939E;
  outline: none;
}
 
.cable-config {
  border-bottom: 1px solid #E1E8EE;
  margin-bottom: 20px;
}
 
.cable-config a {
  color: #358ED7;
  text-decoration: none;
  font-size: 12px;
  position: relative;
  margin: 10px 0;
  display: inline-block;
}
 
.cable-config a:before {
  content: "?";
  height: 15px;
  width: 15px;
  border-radius: 50%;
  border: 2px solid rgba(53, 142, 215, 0.5);
  display: inline-block;
  text-align: center;
  line-height: 16px;
  opacity: 0.5;
  margin-right: 5px;
}

/* Product Price */
.product-price {
  display: flex;
  align-items: center;
}
 
.product-price span {
  font-size: 26px;
  font-weight: 300;
  color: #43474D;
  margin-right: 20px;
}
 
.cart-btn {
  display: inline-block;
  background-color: #7DC855;
  border-radius: 6px;
  font-size: 16px;
  color: #FFFFFF;
  text-decoration: none;
  padding: 12px 30px;
  transition: all .5s;
}
.cart-btn:hover {
  background-color: #64af3d;
}

.color-choose img{
  margin-top:20px;
}
.btn-margin {
  margin-right: 10px; /* Ajoute une marge à droite */
}

/* Responsive */
@media (max-width: 940px) {
  .container {
    flex-direction: column;
    margin-top: 60px;
  }
 
  .left-column,
  .right-column {
    width: 100%;
  }
 
  .left-column img {
    width: 300px;
    right: 0;
    top: -65px;
    left: initial;
  }
}
 
@media (max-width: 535px) {
  .left-column img {
    width: 120px;
    left: -5px;
  }
}



</style>

</head>

<main class="container">
 
  <!-- Left Column / Headphones Image -->
  <div class="left-column">
    <img class="active" src="{{ asset( $references->imagereference)}}" style="max-width: 600px; max-height: 365px;">
  </div>
 
 
  <!-- Right Column -->
  <div class="right-column">
 
    <!-- Product Description -->
    <div class="product-description">
      <h1>{{$references->reference}}</h1>
    </div>
 
    <!-- Product Configuration -->
    <div class="product-configuration">
 
      <!-- Product Color -->
      <div class="product-color">
        <span>Color Family</span>
 
        <div class="color-choose">
          <div>
          <img src="{{ $references->color->imagecolor }}" alt="Couleur" style="height: 40px; border-radius: 50%; width:40px;"> <!-- Afficher l'image de couleur avec bord arrondi -->
            <label for="red"><span></span></label>
          </div>
        
        </div>
 
      </div>
 
      <!-- Cable Configuration -->
      <div class="cable-config">
        <span>Reference</span>
 
        <div class="cable-choose">
          <button>{{$references->reference}}</button>
        
        </div>

        <div class="cable-config">
          <span style="font-weight:bold;">Composants:</span>

          <table style="margin-top:20px;">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Quantité</th>
      <th>Unité</th>
    </tr>
  </thead>
  <tbody>
    @foreach($references->components as $component)
    <tr>
      <td>{{ $component->name }}</td>
      <td>{{ $component->quantity }}</td>
      <td>{{ $component->unit }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
        </div>
 
      </div>
    </div>
 
    <!-- Product Pricing -->
    <div class="product-price">
      <a href="/refcolors">  
            <button class="cart-btn" >
          Back</button>
        </a>  
    </div>
  </div>
  
</main>




