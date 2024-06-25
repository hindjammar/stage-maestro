<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclusion des dépendances nécessaires -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/navbar.css"> <!-- Pour personnaliser le style du menu -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

    <title>Navbar Responsive</title>

    <!-- CSS pour gérer la réactivité -->
    <style>
        .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffff;
}

.navbar .logoo {
    font-size: 1.5em;
    margin-left:30px;
    color: rgb(247, 100, 100);
    font-family: 'Garamond';
    font-weight: bolder;
    font-size: xx-large;
}

.navbar .links {
    display: flex;
    justify-content: center;
    list-style: none;
    gap: 35px;
    margin-top: 15px;

}
/* .navbar .links li{
    display: flex;
    justify-content: center;
    margin-left:10px;
} */

.navbar .links li a {
    text-decoration: none;
    color: rgb(247, 100, 100);
    font-family: Garamond;
}
.navbar .links li a:hover{
    color: black;
}

/* Bouton de bascule pour les petits écrans */
.toggle-btn {
    display: none; /* Masqué par défaut */
    font-size: 1.5em;
    cursor: pointer;
    padding: 10px;
}

/* Disposition pour les écrans de moins de 768px */
@media (max-width: 767px) {
    .navbar {
        flex-direction: row; /* Conserve le logo à gauche et le bouton à droite */
        justify-content: space-between;    }

    .navbar .links {
        display: none; /* Masquer les liens par défaut */
        flex-direction: column;
        width: 100%;
        padding: 10px;
        background-color: #f0f0f0;
    }

    .navbar .toggle-btn {
        display: block; /* Afficher le bouton de bascule */
    }

    .navbar .links.active {
        display: block; /* Afficher les liens lorsque 'active' */
    }
}        
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logoo">
                Maestro <!-- Ou incluez le logo ici -->
            </div>

            <!-- Bouton pour ouvrir/fermer le menu sur les écrans mobiles -->
            <div class="toggle-btn" onclick="toggleMenu()">
                <i class="fa fa-bars"></i> <!-- Icône pour le menu -->
            </div>

            <!-- Liste de liens -->
            <ul class="links" id="navbar-links">
                <li><a class="active" href="/" style="font-size: 25px;">Home</a></li>
                <li><a href="#about" style="font-size: 25px;">About</a></li>
                <li><a href="#contact" style="font-size: 25px;">Contact</a></li>
                <li><a href="#services" style="font-size: 25px;">Services</a></li>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/profil') }}" style="font-size: 25px;">Profil</a></li>
                    @else
                        <li><a href="{{url('/login')}}" style="font-size: 25px;">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{url('/register')}}" style="font-size: 25px;">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </header>

    <!-- JavaScript pour basculer le menu -->
    <script>
        function toggleMenu() {
            var links = document.getElementById("navbar-links");
            links.classList.toggle("active"); // Ajoute ou retire la classe 'active'
        }
    </script>
</body>
</html>
