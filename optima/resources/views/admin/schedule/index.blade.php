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
                    Start time
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    End time
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Event
                </th>
                <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200s">
            @foreach($schedules as $schedule)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $schedule->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $schedule->start_time }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="text-sm text-gray-900">{{ $schedule->end_time }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                    {{ $schedule->event }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium leading-5 font-semibold">
                    <div class="flex justify-center">
                        <a href="{{ route('schedule.edit', ['id' => $schedule->id]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('schedule.delete', ['id' => $schedule->id]) }}" method="POST" class="ml-2">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4 flex justify-between px-6">
        <a href="{{ route('schedule.create', ['conference_id' => $conference_id]) }}" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50 ml-1 font-bold">Create Schedule</a>
        <a href="{{ route('conference.admin') }}" class="inline-flex items-center border border-indigo-300 px-3 py-1.5 rounded-md text-indigo-500 hover:bg-indigo-50">
            <svg fill="none" viewBox="0 0 22 22" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                </path>
            </svg>
            <span class="ml-1 font-bold text-ls">Back</span>
        </a>
    </div>
</body>

</html>
