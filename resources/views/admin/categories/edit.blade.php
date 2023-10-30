@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Editar Categoría</h1>
@stop

@section('content')


    @if (session('info'))
    <ul class="list-group">
              <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
    </ul>
    @endif

<div class="card">
    <div class="card-body">
            {!! Form::model($category,['route'=>['admin.categories.update',$category],'method'=>'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Ingrese el Nombre de la Categoría']) !!}

                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class'=>'form-control','placeholder'=>'Ingrese el Slug de la Categoría','readonly']) !!}

                    @error('slug')
                    <span class="text-danger">{{$message}}</span>
                @enderror


                </div>

                {!! Form::submit('Actualizar Categoría', ['class'=> 'btn btn-success']) !!}
                <a href="{{route('admin.categories.index')}}" class="btn btn-primary my-2 ml-2">Volver</a>

            {!! Form::close() !!}
    </div>

</div>
@stop

@section('js')

  <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

  <script>
    $(document).ready( function() {
  $("#name").stringToSlug({
    setEvents: 'keyup keydown blur',
    getPut: '#slug',
    space: '-'
  });
});
  </script>

@endsection