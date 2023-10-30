@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Crear Nueva Etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
                {!! Form::open(['route'=>'admin.tags.store']) !!}

                @include('admin.tags.partials.form')

                    {!! Form::submit('Crear Etiqueta', ['class'=> 'btn btn-success']) !!}
                    <a href="{{route('admin.tags.index')}}" class="btn btn-primary my-2 ml-2">Volver</a>

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