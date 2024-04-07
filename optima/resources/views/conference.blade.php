<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>optima</title>
    <style>
        body::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        header {
            background-image: url('conference-images/header.jpg');
            background-size: cover;
            background-position: center;
            height: 30rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        @keyframes switchColors {
            0% {
                color: black;
            }

            50% {
                color: white;
            }

            100% {
                color: black;
            }
        }

        .switch-color-animation {
            animation: switchColors 5s infinite;
        }


        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="w-[calc(100%-3.73rem)] ml-auto">
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <header >
        <h1 class="font-bold text-center text-3xl switch-color-animation">{{ $activeConference->title }}</h1>
        <p class="switch-color-animation">Welcome to the future of technology</p>
    </header>


    <main>
        <section class="mb-12 px-4">
            <h2 class="text-3xl font-semibold mb-6 text-center pt-8">About the Conference</h2>
            <div class="flex justify-center mt-2">
                <p class="text-lg text-gray-600">
                    {{ date('F j, Y', strtotime($activeConference->start_date)) }}
                    -
                    {{ date('F j, Y', strtotime($activeConference->end_date)) }}
                </p>
            </div>
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                <p class="text-lg text-gray-700 text-justify">{{ $activeConference->description }}</p>
            </div>
        </section>

        <div class="mb-6 border-b border-gray-300"></div>

        <section class="mb-12 px-4">
            <h2 class="text-3xl font-semibold text-center mb-6">Topics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @foreach($topics as $topic)
                <div class="card bg-gradient-to-br from-teal-100 to-sky-200">
                    <img src="conference-images/register.jpg" alt="Topic 1 Image">
                    <div class="p-6">
                        <h3>{{ $topic->name }}</h3>
                        <p class="text-justify">{{ $topic->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <div class="mb-6 border-b border-gray-300"></div>

        <section class="mb-12">
            <h2 class="text-3xl font-semibold text-black pb-6 mx-auto text-center">Schedule</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">Time</th>
                            <th class="px-6 py-3 text-left">Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                        <tr class="border-t border-gray-300">
                            <td class="px-6 py-4">
                                {{ date('g:i A', strtotime($schedule->start_time)) }}
                                -
                                {{ date('g:i A', strtotime($schedule->end_time)) }}
                            </td>
                            <td class="px-6 py-4">{{ $schedule->event }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="py-10 md:px-8 h-full w-full object-cover md:h-full md:w-full" style="background-image: url('conference-images/register.jpg'); background-size: cover; background-position: center;">
            <h2 class="text-3xl font-semibold mb-6 text-center text-indigo-300">Registration</h2>
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden bg-gradient-to-br from-indigo-200 to-cyan-200">
                <div class="p-6 text-center">
                    <p class="text-lg text-gray-700 mb-8">Registration is open! <a href="#" class="text-blue-500 hover:underline">Click here to register</a>.</p>
                    <a href="https://example.com/register" class="inline-block bg-sky-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">Register Now</a>
                </div>
        </section>
    </main>

    @include('layouts.footer')
</body>

</html>