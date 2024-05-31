<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Optima</title>
    <link rel="icon" href="https://i.ibb.co/VwtYfT6/logo.png" type="image/x-icon" />
    <style>
        .header {
            background-image: url('https://img.freepik.com/free-photo/people-taking-part-high-protocol-event_23-2150951243.jpg?t=st=1716839334~exp=1716842934~hmac=c5aab067b77bcca73d1c2dd744eae05fd59413db0f8bc86abf39e9bee3972ace&w=900');
            background-size: cover;
            background-position: center;
            height: 400px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            border-bottom: 5px solid #1e3a8a;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-text {
            text-align: center;
            animation: fadeIn 3s ease-in-out;
            padding: 20px;
            border: 3px solid white;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .header-subtext {
            margin-top: 10px;
            animation: slideIn 2s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .transition-block {
            background-color: #ffffff;
            padding: 30px 0;
            border-top: 5px solid #1e3a8a;
            margin-top: -5px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="w-[calc(100%-3.73rem)] ml-auto">
    @if(auth()->user()->role_id == 2)
    <div class="m-3">
        <a href="{{ route('post.admin') }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-lime-100 text-lime-600 hover:text-lime-900">
            Post Tools
        </a>
    </div>
    @endif
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <main>
        <div class="header">
            <div class="header-text">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold">Welcome to Optima</h1>
                <p class="header-subtext text-xl md:text-2xl mt-2">Join us for an unforgettable experience</p>
            </div>
        </div>
        <div class="transition-block"></div>
        <div class="2xl:container mx-auto space-y-6">
            <div class="text-center">
                <p class="mt-2 text-xl md:text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    News
                </p>
                <p class="mt-4 max-w-2xl text-lg md:text-base text-gray-500 lg:mx-auto">
                    Explore the latest updates and insights from our conference
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
                @foreach ($posts as $post)
                @include('dashboard.post')
                @endforeach
            </div>
        </div>
    </main>

    @include('dashboard.contacts')

    @include('layouts.footer')
</body>

</html>
