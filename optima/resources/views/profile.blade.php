<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="_token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>Optima</title>
    <link rel="icon" href="https://i.ibb.co/VwtYfT6/logo.png" type="image/x-icon" />
</head>

<body class="w-[calc(100%-3.73rem)] ml-auto">
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <!-- component -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <main class="profile-page">
        <section class="relative block h-500-px">
            <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url(<?= asset('images/profiles/' . $user->profile->background_path) ?>)">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>

        </section>
        <section class="relative py-16 bg-blueGray-200">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative flex justify-center">
                                    <img id="profile-picture" alt="Something went wrong..." src="{{ asset('images/profiles/' . $user->profile->profile_path) }}" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                    <input type="file" id="file-input" style="display: none;">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <a href="{{ route('profile.edit', ['id' => $user->id]) }}" class="cursor-pointer bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150">
                                        Change Profile
                                    </a>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">{{ $conferenceCount }}</span><span class="text-sm text-blueGray-400">Conferences</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">{{ $workCount }}</span><span class="text-sm text-blueGray-400">Applications</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 py-5 text-center">
                                        <span class="text-xs font-bold block tracking-wide text-blueGray-600 pb-1">
                                            @if ($lastConferenceDate)
                                                {{ date('Y.m.d', strtotime($lastConferenceDate)) }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                        <span class="text-sm text-blueGray-400 whitespace-nowrap">Last Participant</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12 p-6 bg-white shadow-lg rounded-lg">
                            <!-- Success Message -->
                            @if (session('success'))
                            <div id="successMessage" class="flex justify-center items-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 mx-auto" role="alert" style="max-width: 400px;">
                                <span class="block sm:inline">{{ session('success') }}</span>
                                <span id="closeSuccess" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M14.59 7l-5 5-2.5-2.5L6 11l3.5 3.5L16 8l-1.41-1z" />
                                    </svg>
                                </span>
                            </div>
                            @endif
                            <h3 class="text-4xl font-semibold leading-normal mb-4 text-blueGray-700">
                                {{ $user->name }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-4 text-blueGray-400 font-bold uppercase flex justify-center items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                <span>{{ $user->profile->country }}, {{ $user->profile->city }}</span>
                            </div>
                            <div class="mb-4 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-envelope mr-2 text-lg text-blueGray-400"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="mb-4 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
                                <span>{{ $user->profile->degree }}</span>
                            </div>
                            <div class="mb-4 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                                <span>{{ $user->profile->institution }}</span>
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            @include('layouts.table')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeSuccess = document.getElementById('closeSuccess');
            const successMessage = document.getElementById('successMessage');

            if (closeSuccess && successMessage) {
                closeSuccess.addEventListener('click', function() {
                    successMessage.style.display = 'none';
                });
            }
        });
    </script>

</body>

@include('layouts.footer')

</html>