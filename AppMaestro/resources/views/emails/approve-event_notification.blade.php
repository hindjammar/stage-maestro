<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email de demande de publication d'un vehicule </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        .details {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Cher Administrateur,</h2>
    <p>Je vous écris pour vous informer que j'ai créé un nouvel vehicule sur notre plateforme et je souhaiterais qu'il
        soit publié.</p>

    <div class="invitation">
        <p>Nous vous invitons à consulter le nouvel événement pour voir tous les détails :</p>
        <a href="http://127.0.0.1:8000/approvevehicules" target="_blank">Consulter le vehicule </>
    </div>

    <p>Je vous remercie de bien vouloir examiner cette demande et de publier les informations du vehicule  sur notre plateforme.</p>
    <p>Cordialement,<br>{{ Auth::user()->name }}</p>
</div>
</body>
</html>