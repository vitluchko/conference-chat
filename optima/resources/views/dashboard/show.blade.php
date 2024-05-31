<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Optima</title>
    <link rel="icon" href="https://i.ibb.co/VwtYfT6/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <style>
        /* Add some basic animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        .slide-in {
            animation: slideIn 1s ease-out;
        }

        .sticky-content {
            position: sticky;
            top: 0;
            height: calc(100vh - 4rem);
            overflow-y: auto;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* Internet Explorer 11 */
        }

        .sticky-content::-webkit-scrollbar {
            display: none;
            /* WebKit */
        }

        .sticky-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, #edf2f7, #e2e8f0);
            z-index: -1;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 767px) {
            .sticky-content {
                position: relative;
                height: auto;
                overflow-y: visible;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <section class="relative pt-16 bg-blueGray-50">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-6/12 lg:w-4/12 px-10 md:px-4 mr-auto ml-auto">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full shadow-lg rounded-lg fade-in">
                        <div class="overflow-hidden rounded-lg">
                            <img alt="..." src="{{ asset('images/' . $post->image_path) }}" class="h-48 w-full object-cover md:h-full md:w-48">
                        </div>
                        <blockquote class="relative p-8 mb-4">
                            <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold pb-1">
                                {{ $post->category }}
                            </p>
                            <h4 class="block mt-1 text-lg leading-tight font-medium text-black">
                                {{ $post->title }}
                            </h4>
                            <p class="text-md font-light mt-2 text-gray-500 flex justify-between items-center">
                                <span>{{ date('jS M Y', strtotime($post->updated_at)) }}</span>
                                <a href="{{ route('dashboard') }}" class="flex items-center text-indigo-600 hover:text-indigo-900 font-semibold">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                    </svg>
                                    Back
                                </a>
                            </p>
                        </blockquote>
                    </div>
                </div>

                <div class="sticky-content w-full md:w-6/12 px-4">
                    <div class="flex flex-wrap">
                        <div class="p-4 max-w-md slide-in">
                            <div class="flex items-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <h6 class="inline-block text-xl mb-1 font-semibold ml-4">{{ $post->title }}</h6>
                            </div>

                            <p class="mb-4 text-justify text-blueGray-500 whitespace-pre-line">
                                {{ $post->description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="sticky-background"></div>
            </div>
        </div>
    </section>
</body>

</html>