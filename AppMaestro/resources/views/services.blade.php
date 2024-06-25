<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <!-- <link rel="stylesheet" href="{{ asset('styles/services.css') }}"> -->



    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

/* *{
    font-family: 'Poppins', sans-serif;
    margin:0; padding:0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition: .2s linear;
} */

.containerr{
    /* background:linear-gradient(45deg, blueviolet, lightgreen); */
    padding:15px 9%;
    padding-bottom: 100px;
}

.containerr .heading{
    text-align: center;
    padding-bottom: 15px;
    color:black;
    text-shadow: 0 5px 10px rgba(0,0,0,.2);
    font-size: 50px;
}

.containerr .box-containerr{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap:15px;
}

.containerr .box-containerr .box{
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    border-radius: 5px;
    background: white;
    text-align: center;
    padding:30px 20px;
    
}

.containerr .box-containerr .box img{
    height: 80px;
}

.containerr .box-containerr .box h3{
    color:#444;
    font-size: 22px;
    padding:10px 0;
}

.containerr .box-containerr .box p{
    color:#777;
    font-size: 15px;
    line-height: 1.8;
}

.containerr .box-containerr .box .btn{
    margin-top: 10px;
    display: inline-block;
    background:#333;
    color:#fff;
    font-size: 17px;
    border-radius: 5px;
    padding: 8px 25px;
}

.container .box-containerr .box .btn:hover{
    letter-spacing: 1px;
}

.containerr .box-containerr .box:hover{
    box-shadow: 0 10px 15px rgba(0,0,0,.3);
    transform: scale(1.03);
}

@media (max-width:768px){
    .containerr{
        padding:20px;
    }
}
    </style>
</head>
<body>
    
<div class="containerr">

    <h1 class="heading">Our Services</h1>

    <div class="box-containerr">

        <div class="box">
            <img src="{{asset('images/loupe.png')}}" alt="">
            <h3>Recherche des produits</h3>
        </div>

        <div class="box">
            <img src="{{asset('images/utilisateur.png')}}" alt="">
            <h3>Gestion des comptes</h3>
        </div>

        <div class="box">
            <img src="{{asset('images/authentification.png')}}" alt="">
            <h3>Authentification et autorisation</h3>
        </div>

       
    </div>

</div>

</body>
</html>