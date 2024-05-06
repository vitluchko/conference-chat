@php
    $description = $post->description;
    $limit = 200;
    if (strlen($description) > $limit) {
        $description = substr($description, 0, $limit);
        $lastSpace = strcspn(strrev($description), ' .,;?!');
        $description = substr($description, 0, $limit - $lastSpace) . '...';
    }
@endphp

<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
    <div class="md:flex">
        <div class="md:flex-shrink-0">
            <img class="h-48 w-full object-cover md:h-full md:w-48" src="{{ asset('images/' . $post->image_path) }}" alt="Post image">
        </div>
        <div class="p-8">
            <div class="flex items-center justify-between">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $post->category }}</div>
                <div class="text-sm text-gray-500">{{ date('jS M Y', strtotime($post->updated_at)) }}</div>
            </div>
            <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $post->title }}</a>
            <p class="text-justify mt-2 text-gray-500">{{ $description }}</p>
            <div class="mt-4 flex items-center">
                <a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                    <span>Read more</span>
                    <svg class="h-5 w-5 ml-1 hover:text-indigo-900" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <rect class="stroke-current" x="8" y="8" width="12" height="12" rx="2" />
                        <path class="stroke-current" d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>