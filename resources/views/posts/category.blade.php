<x-app-layout>

    <div class="mx-auto max-w-5xl px-2 sm:px-6 lg:px-8 py-8">

        <h1
            class=" mb-2 uppercase text-center text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Categoría:


            {{ $category->name }}

        </h1>

        @foreach ($posts as $post)
          <x-card-post :post="$post" />
        @endforeach

        <div class="mt-4">
            {{$posts->links()}}
        </div>


    </div>

</x-app-layout>
