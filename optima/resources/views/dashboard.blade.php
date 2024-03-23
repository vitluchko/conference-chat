<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/svg+xml" href="./assets/favicon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>optima</title>
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        <div class="sidebar min-h-screen w-[3.35rem] overflow-hidden border-r hover:w-56 hover:bg-white hover:shadow-lg">
            <div class="flex h-screen flex-col justify-between pt-2 pb-6">
                <div>
                    <div class="relative flex items-center space-x-4 bg-gradient-to-r from-sky-400 to-sky-200 px-4 py-3 text-white">
                        <img src="https://i.ibb.co/VwtYfT6/logo.png" class="h-auto max-w-full" style="width: 35px; height: auto;">
                        <span class="-mr-1 font-medium">Optima</span>
                    </div>
                    <ul class="mt-6 space-y-2 tracking-wide">
                        <li class="min-w-max">
                            <a href="{{ route('dashboard') }}" class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-gray-600">
                                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path class="stroke-current group-hover:text-sky-600" d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                    <line class="stroke-current group-hover:text-sky-500" x1="8" y1="8" x2="12" y2="8" />
                                    <line class="stroke-current group-hover:text-sky-500" x1="8" y1="12" x2="12" y2="12" />
                                    <line class="stroke-current group-hover:text-sky-500" x1="8" y1="16" x2="12" y2="16" />
                                </svg>
                                <span class="group-hover:text-sky-400">Dashboard</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#" class="bg group flex items-center space-x-4 rounded-full px-4 py-3 text-gray-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path class="stroke-current group-hover:text-sky-600" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle class="stroke-current group-hover:text-sky-600" cx="9" cy="7" r="4" />
                                    <path class="stroke-current group-hover:text-sky-300" d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path class="stroke-current group-hover:text-sky-300" d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                <span class="group-hover:text-sky-400">Profile</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path class="stroke-current group-hover:text-sky-600" d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                    <rect class="stroke-current group-hover:text-sky-400" x="8" y="2" width="8" height="4" rx="1" ry="1" />
                                </svg>
                                <span class="group-hover:text-sky-400">Conference</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600">
                                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline class="stroke-current group-hover:text-sky-400" points="9 11 12 14 20 6" />
                                    <path class="stroke-current group-hover:text-sky-600" d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                </svg>
                                <span class="group-hover:text-sky-400">Participant</span>
                            </a>
                        </li>
                        <li class="min-w-max">
                            <a href="#" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600">
                                <svg class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path class="group-hover:text-sky-300" d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" />
                                    <line class="group-hover:text-sky-300" x1="14.5" y1="5.5" x2="18.5" y2="9.5" />
                                    <polyline class="group-hover:text-sky-600" points="12 8 7 3 3 7 8 12" />
                                    <line class="group-hover:text-sky-600" x1="7" y1="8" x2="5.5" y2="9.5" />
                                    <polyline class="group-hover:text-sky-600" points="16 12 21 17 17 21 12 16" />
                                    <line class="group-hover:text-sky-600" x1="16" y1="17" x2="14.5" y2="18.5" />
                                </svg>
                                <span class="group-hover:text-sky-400">Admin</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="w-max -mb-3">
                    <form method="post" action="{{ route('logout') }}" class="flex">
                        @csrf

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600">
                            <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path class="group-hover:text-sky-600" d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path class="fill-stroke text-gray-300 group-hover:text-sky-300" d="M7 12h14l-3 -3m0 6l4 -3" />
                            </svg>
                            <span class="group-hover:text-sky-400">Logout</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>