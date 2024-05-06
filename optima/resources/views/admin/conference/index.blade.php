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
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Id
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Start date
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    End date
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Additionals
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200s">
            @foreach($conferences as $conference)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $conference->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex items-center justify-center">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $conference->title }}
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $conference->start_date }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $conference->end_date }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if (!$conference->isActive)
                    <form action="{{ route('conference.setActiveById') }}" method="POST">
                        @csrf
                        <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 hover:bg-green-100 hover:text-green-800">
                            Inactive
                        </button>
                    </form>
                    @else
                    <form action="{{ route('conference.setInactiveById') }}" method="POST">
                        @csrf
                        <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 hover:bg-red-100 hover:text-red-800">
                            Active
                        </button>
                    </form>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                    {{ strlen($conference->description) > 20 ? substr($conference->description, 0, 20) . '...' : $conference->description }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <a href="{{ route('topic', ['id' => $conference->id]) }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-600 hover:text-teal-900">Topics</a>
                    <a href="{{ route('schedule', ['id' => $conference->id]) }}" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-lime-100 ml-2 text-lime-600 hover:text-lime-900">Schedules</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap inline-flex text-center text-sm font-medium leading-5 font-semibold rounded-full">
                    <a href="{{ route('conference.edit', ['id' => $conference->id]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('conference.delete', ['id' => $conference->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="ml-2 text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-between px-6">
        <a href="{{ route('conference.create') }}" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50 ml-1 font-bold">Create Conference</a>
        <a href="{{ route('conference') }}" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50">
            <svg fill="none" viewBox="0 0 22 22" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
            <span class="ml-1 font-bold text-ls">Back</span>
        </a>
    </div>
</body>

</html>
