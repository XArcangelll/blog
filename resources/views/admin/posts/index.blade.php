@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')

    <a class="float-right btn btn-success" href="{{route('admin.posts.create')}}">Crear Post</a>

    <h1>Lista de Posts</h1>
@stop

@section('content')

    
@if (session('info'))
<ul class="list-group">
          <li class="list-group-item list-group-item-success mb-3"> {{session('info')}}</li>
</ul>
@endif


   @livewire('admin.posts-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
