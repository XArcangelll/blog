@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')


@if (session('info'))
<ul class="list-group">
          <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif


    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route'=>['admin.roles.update',$role],'method'=>'put']) !!}

            @include('admin.roles.partials.form')

            {!! Form::submit('Editar rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>
@stop
