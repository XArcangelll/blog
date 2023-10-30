@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Lista de Categorías</h1>
@stop

@section('content')

    
@if (session('info'))
<ul class="list-group">
    <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif


@include('layouts.partials.messages')


        <div class="card">

            <div class="card-header">
                <a class="btn btn-success " href="{{route('admin.categories.create')}}">Agregar Categoría</a>
            </div>

            <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th colspan="3"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                         <td width="10px">
                                            <a class="btn btn-secondary btn-sm" href="{{route('admin.categories.show',$category)}}"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.categories.edit',$category)}}">Editar</a>
                                        </td>
                                        <td width="10px">
                                           <form action="{{route('admin.categories.destroy',$category)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                Eliminar
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>

                    </table>
            </div>
        </div>
@stop
