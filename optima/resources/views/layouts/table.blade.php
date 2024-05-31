<table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                #
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
                <div class="text-sm text-gray-900">{{ $index + 1 }}</div>
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