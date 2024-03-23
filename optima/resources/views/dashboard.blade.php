<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>optima</title>
</head>

<body>
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <main class="w-[calc(100%-3.73rem)] ml-auto">
    <div class="2xl:container mx-auto space-y-6">
        <div class="h-16 border-b border-gray-300 dark:border-gray-700">
            <span class="flex justify-center text-sky-700 dark:text-gray-200">Header</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
            @include('layouts.post')
            @include('layouts.post')
            @include('layouts.post')
            @include('layouts.post')
            @include('layouts.post')
        </div>
    </div>
</main>



</body>

</html>
