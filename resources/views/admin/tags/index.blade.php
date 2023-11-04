@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Lista de Etiquetas</h1>
@stop

@section('content')

    
@if (session('info'))
<ul class="list-group">
    <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif


@include('layouts.partials.messages')


        <div class="card">
            @can('admin.tags.create')
            <div class="card-header">
                <a class="btn btn-success " href="{{route('admin.tags.create')}}">Agregar Etiquetas</a>
            </div>
@endcan
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
                            @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->name}}</td>
                                         {{-- <td width="10px">
                                            <a class="btn btn-secondary btn-sm" href="{{route('admin.tags.show',$tag)}}"><i class="fa fa-eye"></i></a>
                                        </td> --}}
                                        <td width="10px">
                                            @can('admin.tags.edit')
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.tags.edit',$tag)}}">Editar</a>
                                            @endcan
                                        </td>
                                        <td width="10px">
                                            @can('admin.tags.destroy')
                                           <form action="{{route('admin.tags.destroy',$tag)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                Eliminar
                                            </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>

                    </table>
            </div>
        </div>
@stop
