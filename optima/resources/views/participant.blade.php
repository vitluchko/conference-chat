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

<body class="w-[calc(100%-3.73rem)] ml-auto">
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <div class="p-10">
        <h1 class="mb-8 font-extrabold text-4xl text-center text-indigo-700">Registration on the "{{ $conferenceTitle }}"</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="rounded-lg shadow-lg bg-white p-6">
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
                <form action="/participant/create" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-4">
                        <label class="block font-semibold mb-2 text-gray-800" for="subject">Work subject</label>
                        <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-gray-600 text-xl p-4 border border-gray-300 block mt-1 focus:outline-none focus:border-indigo-500" id="subject" name="subject" placeholder="Machine Learning in Healthcare" required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-semibold mb-2 text-gray-800" for="link">Work Link</label>
                        <input class="w-full shadow-inner bg-gray-100 rounded-lg placeholder-gray-600 text-xl p-4 border border-gray-300 block mt-1 focus:outline-none focus:border-indigo-500" id="link" type="url" name="link" placeholder="https://example.com/my-work" required>
                    </div>

                    <div class="flex items-center justify-center mt-8">
                        <button type="submit" class="px-8 py-3 border border-transparent text-lg font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300 ease-in-out">Register</button>
                    </div>
                </form>
            </div>

            <aside class="bg-gray-100 p-8 rounded">
                <h2 class="font-bold text-2xl mb-4 text-gray-800">How to Register</h2>
                <p class="mb-4 text-gray-700">Follow these simple steps to register for the conference:</p>
                <ol class="list-decimal list-inside">
                    <li class="mb-2">Specify the subject of your work in the <b>"Work Subject"</b> field.</li>
                    <li class="mb-2">Enter the link to your work in the <b>"Work Link"</b> field.</li>
                    <li class="mb-2">Click the <b>"Register"</b> button to complete the registration process.</li>
                </ol>
                <p class="mt-4 text-gray-700">If you encounter any issues during registration, please contact our support team <a href="mailto:post@kpnu.edu.ua" class="md:text-base text-indigo-600 font-semibold tracking-wide pt-2">post@kpnu.edu.ua</a> for assistance.</p>
            </aside>
        </div>
    </div>

</body>

<footer style="position: fixed; bottom: 0; width: 100%;">
    @include('layouts.footer')
</footer>

<script>
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

</html>