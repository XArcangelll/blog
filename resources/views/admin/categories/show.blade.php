@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Detalle de Categoría</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="form-group">

                <label for="name">Nombre</label>
                <input type="text" readonly class="form-control" value="{{ $category->name }}">

                <label for="slug">Slug</label>
                <input type="text" readonly class="form-control" value="{{ $category->slug }}">


            </div>

            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-success my-2 ">Editar Categoría</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary my-2 ml-2">Volver</a>

        </div>

    </div>



@stop
