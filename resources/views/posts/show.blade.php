<x-app-layout>
    
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>

        <div class="text-lg text-gray-500 mb-2">
            {!!$post->extract!!}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 gap-6">

            {{-- Contenido Principal --}}

            <div class="lg:col-span-2 md:col-span-2">

                <figure>
                    @if ($post->image)
                    <img class="rounded-lg w-full h-80 object-cover object-center" src="{{Storage::url($post->image->url)}}">
                    @else
                    <img class="rounded-lg w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2023/10/21/11/46/sunset-8331285_1280.jpg"
                    alt="{{ $post->name }}">
                    @endif
                </figure>

                <div class="text-base text-gray-500 mt-4">
                    {!!$post->body!!}
                </div>

            </div>

            {{-- Contenido relacionado --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4"> Más en {{$post->category->name}}</h1>

                <ul>
                    @foreach ($similares as $similar)
                    <li class="mb-4">
                            <a class="flex" href="{{route('posts.show',$similar)}}">
                                @if ($similar->image)
                                    <img width="120px" height="75px"  class="rounded-lg object-cover object-center  " src="{{Storage::url($similar->image->url)}}" alt="">
                                    @else
                                    <img width="120px" style="height:75px"  class="rounded-lg object-cover object-center" src="https://cdn.pixabay.com/photo/2023/10/21/11/46/sunset-8331285_1280.jpg"
                                    alt="{{ $similar->name }}">
                                    @endif
                                <span class="ml-2 text-gray-600 w-full" >{{$similar->name}}</span>
                            </a>
                    </li>
                    @endforeach 
                </ul>

            </aside>


        </div>

    </div>

</x-app-layout>
