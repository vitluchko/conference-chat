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
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Id
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Conference
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Subject
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Link
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200s">
            @foreach($userParticipants as $index => $userParticipant)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $index + 1 + ($userParticipants->currentPage() - 1) * $userParticipants->perPage() }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <a href="mailto:{{ $userParticipant->user->email }}" class="md:text-base text-indigo-600 tracking-wide pt-2 hover:underline">{{ $userParticipant->user->email }}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $userParticipant->conference->title }}</div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">
                        {{ date('Y-m-d', strtotime($userParticipant->conference->start_date)) }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $userParticipant->subject }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">
                        <a href="{{ $userParticipant->link }}" class="text-indigo-600 hover:text-indigo-900 hover:underline" target="_blank">Link</a>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if (!$userParticipant->conference->isActive)
                    <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Inactive
                    </div>
                    @else
                    <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Active
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-between px-6">
        <form action="{{ route('participant.export.excel') }}" method="GET" class="mb-4 space-x-4">
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="isActive" value="0">
                <span class="ml-2">Active</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="isActive" value="1">
                <span class="ml-2">Inactive</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio" name="isActive" value="2" checked>
                <span class="ml-2">All</span>
            </label>
            <button type="submit" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50 ml-1 font-bold">
                Export to Excel
            </button>
        </form>
        <a href="{{ route('conference') }}" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50" style="height: 37px;">
            <svg fill="none" viewBox="0 0 22 22" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
            <span class="ml-1 font-bold text-ls">Back</span>
        </a>
    </div>

    <div class="px-6 mt-4 pb-4 flex justify-center items-center space-x-2 mb-8">
    <span class="text-sm text-gray-500">Page {{ $userParticipants->currentPage() }} of {{ $userParticipants->lastPage() }}</span>
    <nav class="block">
        <ul class="flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($userParticipants->onFirstPage())
            <li>
                <span class="relative inline-flex items-center px-2 py-1 text-xs font-semibold text-gray-500 cursor-not-allowed bg-white border border-gray-300 rounded-md">Previous</span>
            </li>
            @else
            <li>
                <a href="{{ $userParticipants->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-semibold text-indigo-500 bg-white border border-indigo-500 rounded-md hover:bg-indigo-500 hover:text-white">Previous</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($userParticipants->getUrlRange(1, $userParticipants->lastPage()) as $page => $url)
            <li>
                <a href="{{ $url }}" class="relative inline-flex items-center px-3 py-1 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-200">{{ $page }}</a>
            </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($userParticipants->hasMorePages())
            <li>
                <a href="{{ $userParticipants->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-1 text-xs font-semibold text-indigo-500 bg-white border border-indigo-500 rounded-md hover:bg-indigo-500 hover:text-white">Next</a>
            </li>
            @else
            <li>
                <span class="relative inline-flex items-center px-2 py-1 text-xs font-semibold text-gray-500 cursor-not-allowed bg-white border border-gray-300 rounded-md">Next</span>
            </li>
            @endif
        </ul>
    </nav>
</div>

</body>

</html>
