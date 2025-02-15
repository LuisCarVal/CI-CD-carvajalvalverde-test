<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$movie["title"]}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@if (session('success'))
    <div class="bg-[#d4edda] text-[#155724]">
        {{ session('success') }}
    </div>
@endif
<div class="flex flex-wrap">
    <!-- Imagen -->
    <div class="w-full md:w-1/3 p-4">
        <img src="{{$movie['poster']}}" class="rounded-md shadow-md w-full" alt="{{$movie['title']}}" />
    </div>

    <!-- Información de la película -->
    <div class="w-full md:w-2/3 p-4">
        <h1 class="text-2xl font-bold mb-4">{{$movie["title"]}}</h1>
        <p class="text-gray-700"><strong>Year:</strong> {{$movie["year"]}}</p>
        <p class="text-gray-700"><strong>Director:</strong> {{$movie["director"]}}</p>
        <p class="text-gray-700"><strong>Synopsis:</strong> {{$movie["synopsis"]}}</p>
        <p class="text-gray-700 mt-4">
            <strong>Status:</strong>
            <span>
                {{ $movie["rented"] ? "Movie already rented" : "Movie available" }}
            </span>
        </p>
        <div class="flex gap-4 mt-4">
            <form action="{{$movie->rented ? url("catalog/return/$movie->id"):url("catalog/rent/$movie->id")}}" method="POST">
                @csrf
                @method("put")
                <button type="submit" class="px-4 py-2 rounded {{$movie["rented"]? "bg-red-600": "bg-blue-500" }} text-white">
                    {{ $movie["rented"] ? "Return movie" : "Rent movie" }}
                </button>
            </form>
            <a href="{{route('catalog.edit', ['id' => $movie["id"]]) }}" class="px-4 py-2 rounded bg-orange-500 text-white">Edit movie</a>
            <a href="{{route('catalog.index')}}" class="px-4 py-2 rounded bg-gray-400 text-black">Back to the Catalog</a>
            <form action="{{url("catalog/delete/$movie->id")}}" method="POST">
                @csrf
                @method("DELETE")
                <button type="submit" class="px-4 py-2 bg-black text-white rounded" >Remove Movie</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
