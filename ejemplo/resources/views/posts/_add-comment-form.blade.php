@auth
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="40" height="4 0" class="rounded-full">
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-5">
                <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none focus:ring"
                    rows="5 "
                    placeholder="Quick, thing of something to say!"
                    required></textarea>
                @error('body')
                    <span class="text-xs text-red-500">{{$message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-5 border-t border-gray-200 pt-6">
                <x-submit-button>Publish Comment</x-submit-button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">log in to leave a comment </a>
    </p>
@endauth
