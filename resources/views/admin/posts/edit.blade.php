@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Editar Post</h1>
@stop


@section('content')


@if (session('info'))
<ul class="list-group">
          <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif


    <div class="card">
        <div class="card-body">

            {!! Form::model($post,['route' => ["admin.posts.update",$post],'files'=>true, "method"=>"put"]) !!}

            {{-- {!! Form::hidden('user_id', auth()->user()->id) !!} --}}


            {!! Form::hidden("imagen_actual",  isset($post->image) ? $post->image->url : "",["id"=>"imagen_actual"] ) !!}

                @include('admin.posts.partials.form')

            {!! Form::submit('Actualizar Post', ['class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
        }

        .image-wrapper img {
            object-fit: cover;
            width: 75%;
            height: auto;
        }
    </style>
@stop


@section('js')

    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });

            @isset($post->image)
            document.getElementById("eliminar-img").disabled = false;
            @else
            document.getElementById("eliminar-img").disabled = document.getElementById("file").value !== "" ?
                false : true;
             @endisset 

          

        });

        ClassicEditor
            .create(document.querySelector('#extract'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });

        //cambiar imagen

        document.getElementById("eliminar-img").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("picture").setAttribute("src",
                "https://cdn.pixabay.com/photo/2023/10/21/11/46/sunset-8331285_1280.jpg");
            document.getElementById("file").value = "";
            this.disabled = true;

            document.getElementById("imagen_actual").value = "";

        });

        document.getElementById("file").addEventListener("change", cambiarImagen);


        function cambiarImagen(event) {
            var file = event.target.files[0];

            if (file) {
                var extension = file.name.split('.').pop().toLowerCase();
                var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','jfif']; // Lista de extensiones permitidas

                if (allowedExtensions.indexOf(extension) === -1) {

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Debe seleccionar una imagen válida',
                    });
                    // this.value = ''; // Limpia el input file
                    // document.getElementById("eliminar-img").disabled = true;
                } else {
                    document.getElementById("eliminar-img").disabled = false;

                    var reader = new FileReader();

                    reader.onload = (event) => {
                        document.getElementById("picture").setAttribute("src", event.target.result);
                    };

                    reader.readAsDataURL(file);
                }
            } else {
                this.value = ''; // Limpia el input file si no se selecciona un archivo
                document.getElementById("eliminar-img").disabled = true;
            }



        }
    </script>

@endsection