<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>optima</title>
</head>

<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            Edit Conference
        </h1>
    </div>
</div>

@if ($errors->any())
<div class="w-4/5 m-auto">
    <ul>
        @foreach ($errors->all() as $error)
        <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif

<div class="w-4/5 m-auto pt-20">
    <form action="/conference/edit/{{ $conference->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $conference->title }}" class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

        <input type="date" name="start_date" value="{{ $conference->start_date }}" class="mt-5 bg-transparent block border-b-2 w-full h-16 text-lg outline-none">

        <input type="date" name="end_date" value="{{ $conference->end_date }}" class="mt-5 bg-transparent block border-b-2 w-full h-16 text-lg outline-none">


        <textarea name="description" placeholder="Description..." class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">
        {{ $conference->description }}
        </textarea>

        <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Update Conference
        </button>
    </form>
</div>

</html>
