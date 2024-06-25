<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
<div class="max-w-lg mx-auto  p-16 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="grid gap-6 grid-cols-3 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-9">
                <div>
                    @foreach($references as $reference)
                    <img class="h-16 w-28 mx-auto rounded-md" src="{{$reference->imagereference}}">
                    <!-- <img src="{{$reference->imagereference}}" alt=""> -->
                     </img>
                    <h2 class="mt-3 text-gray-700 text-center font-semibold">{{$reference->reference}}</h2>
                    @endforeach

                </div>
</div>
</div> 
</body>
</html>