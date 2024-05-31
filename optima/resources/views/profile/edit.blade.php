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
                                    <label for="file-input" class="cursor-pointer">
                                        <img id="profile-picture" alt="Profile Picture" src="{{ asset('images/profiles/' . $user->profile->profile_path) }}" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px hover:opacity-75 transition duration-300">
                                    </label>
                                    <input type="file" id="file-input" style="display: none;">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <form id="background-form" action="/update-background-image" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->profile->id }}">
                                    <div class="py-6 px-3 mt-32 sm:mt-0">
                                        <label for="image-upload" class="cursor-pointer bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150">
                                            Update Background
                                        </label>
                                        <input id="image-upload" type="file" name="image" class="hidden">
                                    </div>
                                </form>
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
                        <form action="/user-profile/edit/{{ $user->id }}" method="POST" class="text-center mt-12 p-6 bg-white shadow-lg rounded-lg max-w-lg mx-auto">
                            @csrf
                            @method('PUT')

                            <!-- Error Message -->
                            @if ($errors->any())
                            <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <span id="closeError" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M14.59 7l-5 5-2.5-2.5L6 11l3.5 3.5L16 8l-1.41-1z" />
                                    </svg>
                                </span>
                            </div>
                            @endif

                            <h3 class="text-4xl font-semibold leading-normal mb-6 text-blueGray-700">
                                <label for="name" class="block text-xl font-semibold leading-normal text-blueGray-700">
                                    Name
                                </label>
                                <input type="text" name="name" value="{{ $user->name }}" placeholder="Name" class="text-center bg-gray-100 border border-gray-300 rounded-md w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </h3>

                            <div class="text-sm leading-normal mb-6 text-blueGray-400 font-bold uppercase flex justify-center items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                <input type="text" name="location" value="{{ $user->profile->country }}, {{ $user->profile->city }}" placeholder="Country, City" class="bg-gray-100 border border-gray-300 rounded-md w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div class="mb-6 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-envelope mr-2 text-lg text-blueGray-400"></i>
                                <input type="email" name="email" value="{{ $user->email }}" placeholder="Email" class="bg-gray-100 border border-gray-300 rounded-md w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div class="mb-6 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
                                <input type="text" name="degree" value="{{ $user->profile->degree }}" placeholder="Degree" class="bg-gray-100 border border-gray-300 rounded-md w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div class="mb-6 text-blueGray-600 flex justify-center items-center">
                                <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                                <input type="text" name="institution" value="{{ $user->profile->institution }}" placeholder="Institution" class="bg-gray-100 border border-gray-300 rounded-md w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <button type="submit" class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded transition-all duration-150 ease-linear">
                                Save Changes
                            </button>
                        </form>

                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profilePicture = document.getElementById("profile-picture");
            const fileInput = document.getElementById("file-input");
            const profileId = "{{ $user->profile->id }}";

            profilePicture.addEventListener("click", function() {
                fileInput.click();
            });

            fileInput.addEventListener("change", function() {
                const file = fileInput.files[0];

                const formData = new FormData();
                formData.append('image', file);
                formData.append('id', profileId);

                fetch('/update-profile-image', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const profilePicture = document.getElementById("profile-picture");
                            profilePicture.src = data.profile_path;
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("background-form");
            const imageUpload = document.getElementById("image-upload");

            imageUpload.addEventListener("change", function() {
                form.submit();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const closeError = document.getElementById('closeError');
            const errorMessage = document.getElementById('errorMessage');

            if (closeError && errorMessage) {
                closeError.addEventListener('click', function() {
                    errorMessage.style.display = 'none';
                });
            }
        });
    </script>

</body>

@include('layouts.footer')

</html>