<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>optima</title>
</head>

<body class="w-[calc(100%-3.73rem)] ml-auto">
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <main>
        <div class="2xl:container mx-auto space-y-6">
            <div class="h-16 border-b border-gray-300 dark:border-gray-700">
                <span class="flex justify-center text-sky-700 dark:text-gray-200">Header</span>
                @if (Auth::check())
                <div class="pt-15 w-4/5 m-auto">
                    <a href="{{ route('post.create') }}">
                        Create post
                    </a>
                </div>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
                @foreach ($posts as $post)
                @include('dashboard.post')
                <div class="pt-15 w-4/5 m-auto flex justify-between items-center">
                    <a href="{{ route('post.edit', ['id' => $post->id, 'slug' => $post->slug]) }}" class="text-blue-500 hover:underline">
                        Edit post
                    </a>
                    <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>

</html>