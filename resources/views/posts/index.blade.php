<x-app-layout>
    <div class="container py-8">

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 grid-cols-1 ">

            @foreach ($posts as $post)
                <article class="w-full rounded-lg h-80 bg-cover bg-center @if ($loop->first) md:col-span-2 @endif"
                    style="background-image: url(@if($post->image) {{ Storage::url($post->image->url)}} @else https://cdn.pixabay.com/photo/2023/10/21/11/46/sunset-8331285_1280.jpg @endif)" alt="{{ $post->name }})">

                    <div class="w-full h-full px-8 flex flex-col justify-center">

                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.tag', $tag) }}"
                                    class="inline-block px-3 h-6 rounded-full mb-3 text-white bg-{{ $tag->color }}-600">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                        <h1 style="text-shadow: black 2px 0 10px;" class="text-4xl  text-white  font-bold mt-2 py-4 drop-shadow-lg leading-9">
                            <a href="{{ route('posts.show', $post)  }}" >{{ $post->name }}</a>
                        </h1>
                    </div>

                </article>
            @endforeach

        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
</x-app-layout>
