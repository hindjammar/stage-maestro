<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($colors as $color)
    <h1>
        {{ $color->couleur }}
<img src="{{ $color->imagecolor }}" alt="">
    </h1>
    @endforeach
</body>
</html>