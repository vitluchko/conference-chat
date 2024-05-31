<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Optima</title>
    <link rel="icon" href="https://i.ibb.co/VwtYfT6/logo.png" type="image/x-icon" />
</head>

<div class="w-4/5 m-auto text-left">
    <div class="py-15">
        <h1 class="text-6xl">
            Edit Topic
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
    <form action="/topic/edit/{{ $topic->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $topic->name }}" placeholder="Name..." class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

        <textarea name="description" placeholder="Description..." class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $topic->description }}</textarea>

        <div class="bg-grey-lighter pt-15">
            <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                <span class="mt-2 text-base leading-normal">
                    Select a file
                </span>
                <input type="file" name="image" class="hidden">
            </label>
        </div>

        <input type="hidden" name="conference_id" value="{{ $topic->conference_id }}">

        <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Update Topic
        </button>
    </form>
</div>

</html>
