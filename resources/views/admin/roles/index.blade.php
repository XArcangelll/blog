@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')


    @if (session('info'))
        <ul class="list-group">
            <li class="list-group-item list-group-item-success mb-3"> {{ session('info') }}</li>
        </ul>
    @endif

    <div class="card">

        {{-- @can('admin.roles.create') --}}
        <div class="card-header">
            <a class="btn btn-success " href="{{ route('admin.roles.create') }}">Agregar Rol</a>
        </div>
        {{-- @endcan --}}


        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>

                            <td width="10px">
                                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">

                               @if ($role->id == 1)
                                    <button class="btn btn-sm btn-secondary" disabled>Eliminar</button>
                                @else 
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                 @endif 

                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
