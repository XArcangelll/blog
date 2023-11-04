@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Editar Permisos del Usuario</h1>
@stop

@section('content')

@if (session('info'))
<ul class="list-group">
          <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif

    <div class="card">
            <div class="card-body">
                {!! Form::model($user, ['route'=>['admin.permissions.update',$user],'method'=>'put']) !!}
                <h2 class="h3 ">
                Lista de Permisos del Usuario
                </h2>

                @if ($permissions->count())
                @foreach ($permissions as $permission)
                <div>
                    <label >
                        {!! Form::checkbox('permissions[]', $permission->id, $permission->pivot->status === 1, ['class'=>"mr-1" ]) !!}
                        {{$permission->description}}   
                    </label>
                </div>
            @endforeach


                @else

                <p>No hay Permisos Directos a modificar</p>

                @endif
                
            


                {!! Form::submit('Editar Permisos', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
