@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Detalle de Etiqueta</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="form-group">

                <label for="name">Nombre</label>
                <input type="text" readonly class="form-control" value="{{ $tag->name }}">

                <label for="slug">Slug</label>
                <input type="text" readonly class="form-control" value="{{ $tag->slug }}">

                <label for="color">Color</label>
                <input type="text" readonly class="form-control" value="{{ $colors[$tag->color] }}">


            </div>

            <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-success my-2 ">Editar Etiqueta</a>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-primary my-2 ml-2">Volver</a>

        </div>

    </div>



@stop
