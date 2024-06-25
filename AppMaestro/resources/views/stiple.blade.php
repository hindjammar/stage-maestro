<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="{{ asset('styles/stiple.css') }}">
    
    <title>Document</title>

    <style>
    .btnH {
        background-color: #CCCCCC;
    }

    .fade-in {
            opacity: 0;
            animation: fadeInAnimation 1s ease-in-out forwards;
        }

        @keyframes fadeInAnimation {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .banner {
            opacity: 0;
        }
        .text-white{
            margin-top:15px;
        }
        
</style>
</head>
<body>
    
<section class="banner fade-in" id="home">
<div class="container ">

<span class="tagline" style="color:black">Welcome to Our Website Maestro</span>
<p class="par">Maestro Products is simply an innovative platform that will allow its users to create and search for any product.This platform was created to facilitate access to everyday products as well as communication between creators and visitors.
</p>
<a href="{{ url('/profclic')}}" style="text-decoration: none;"><button type="button" class="text-white  custom-button bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 " style="background-color: rgba(255, 128, 128, 0.8);">Get Started</button>
 </a>
</section>



<script>

document.addEventListener('DOMContentLoaded', function() {
    var elementsToAnimate = document.querySelectorAll('home');

    elementsToAnimate.forEach(function(element) {
        element.classList.add('fade-in');
    });
});

</script>
</body>
</html>