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
            Create Schedule
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
    <form action="/schedule/create" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="event" placeholder="Event..." class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

        <input type="time" name="start_time" placeholder="Start Time..." class="mt-5 bg-transparent block border-b-2 w-full h-16 text-lg outline-none">

        <input type="time" name="end_time" placeholder="End Time..." class="mt-5 bg-transparent block border-b-2 w-full h-16 text-lg outline-none">

        <input type="hidden" name="conference_id" value="{{ $conference_id }}">

        <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Submit Schedule
        </button>
    </form>
</div>

</html>
