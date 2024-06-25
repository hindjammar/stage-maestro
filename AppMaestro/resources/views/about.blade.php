<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <title>Document</title>
    <style>
        .about{
    margin-top: 50px;
    padding: 100px;
}
.title1{
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    color:  rgb(250, 107, 126);
    letter-spacing: 0.2rem;
}
.title2{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: bold;
    font-size: 45px;
}

@keyframes zoomIn {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(1.1);
    }
}

/* Appliquer l'animation à l'image */
.image1 {
    animation: zoomIn 1.5s infinite alternate; 
    width:90%; 
    height: auto;
}


.par{
    color: rgb(90, 82, 82);
    font-size: 20px;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
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
    </style>
</head>
<body>
<section class="about fade-in " id="about">
<div class="container" >

<div class="row">
<div class="col-md-6">
<img class="image1" src="{{asset('images/crosserie2.jpg')}}" alt="PaintCar">

</div>
<div class="col-md-6">
<h1 class="title1">About Us</h1>
<h2 class="title2">We Invite you to the Enchanting World of Automotive Bodywork and Paints.
</h2>
<p class="par">Maestro is a company specializing in the production and marketing of products intended for the repair and painting of  automobile bodies.</br>
It has been present since 2005. It covers 100% of the automobile bodywork with an integrated system.</p>
</div>
</div>
</section>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function() {
    var elementsToAnimate = document.querySelectorAll('about');

    elementsToAnimate.forEach(function(element) {
        element.classList.add('fade-in');
    });
});

</script>
</body>
</html>