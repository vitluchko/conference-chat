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
        body {
            background-image: url('https://wallpapercave.com/wp/wp2298408.jpg');
            background-size: cover;
            background-position: center;
        }

        @keyframes customFadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-customFadeInDown {
            animation: customFadeInDown 1s ease-in-out;
        }

        .custom-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <header class="flex items-center justify-between p-6 bg-opacity-50 bg-gray-800">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2">
            <img src="https://i.ibb.co/VwtYfT6/logo.png" class="h-auto max-w-full" style="width: 30px; height: auto;">
            <span class="text-xl font-black text-white">Optima</span>
        </a>
        <div>
            @guest
            <a href="{{ route('login') }}" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Log In</a>
            <a href="{{ route('register') }}" class="rounded-md bg-sky-600 py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-sky-700 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">Register</a>
            @endguest
            @auth
            <a href="{{ route('dashboard') }}" class="rounded-md bg-gray-200 py-2 px-4 font-semibold text-gray-900 shadow-lg transition duration-150 ease-in-out hover:bg-gray-300 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">Dashboard</a>
            @endauth
        </div>
    </header>
    <main class="flex flex-col items-center justify-center min-h-screen p-4">
        <h1 class="text-5xl font-bold text-white mb-8 animate-customFadeInDown custom-shadow">Welcome to Optima</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white bg-opacity-75 rounded-lg shadow-lg p-6 transform transition duration-500 hover:scale-105 hover:shadow-xl border border-gray-200">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-sky-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v4.586l2.293-2.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L9 8.586V4a1 1 0 011-1z" /></svg>
                </div>
                <h2 class="text-2xl font-bold mb-2 text-center">Step 1</h2>
                <p class="text-gray-700 text-center">Welcome to Optima Conferences, where excellence meets opportunity. Dive into a world of cutting-edge insights and collaborative synergy as we convene leading minds and industry pioneers.</p>
            </div>
            <div class="bg-white bg-opacity-75 rounded-lg shadow-lg p-6 transform transition duration-500 hover:scale-105 hover:shadow-xl border border-gray-200">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-sky-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v4.586l2.293-2.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L9 8.586V4a1 1 0 011-1z" /></svg>
                </div>
                <h2 class="text-2xl font-bold mb-2 text-center">Step 2</h2>
                <p class="text-gray-700 text-center">Discover the pinnacle of knowledge exchange at Optima Conferences. As the premier destination for thought leaders and change-makers alike, we provide a dynamic platform for exploring the forefront of science.</p>
            </div>
            <div class="bg-white bg-opacity-75 rounded-lg shadow-lg p-6 transform transition duration-500 hover:scale-105 hover:shadow-xl border border-gray-200">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-sky-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v4.586l2.293-2.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L9 8.586V4a1 1 0 011-1z" /></svg>
                </div>
                <h2 class="text-2xl font-bold mb-2 text-center">Step 3</h2>
                <p class="text-gray-700 text-center">At Optima Conferences, we believe in the power of optimal solutions. Join us as we embark on a journey of discovery and advancement in any technologies.</p>
            </div>
        </div>
    </main>
</body>

</html>