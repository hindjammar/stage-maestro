<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body class="relative bg-yellow-50 overflow-hidden max-h-screen">
@include('navbar')
<script src="https://cdn.tailwindcss.com"></script>
<!-- component -->

<section>@include('client.references')</section>
<section></section>

</body>
</html>