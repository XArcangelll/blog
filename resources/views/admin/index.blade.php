@extends('adminlte::page')

@section('title', 'XArcangelll')

@section('content_header')
    <h1>Dieguito</h1>
@stop

@section('content')
    <p>Bienvenido al panel</p>

@stop

@section('css')
    <link rel="stylesheet" href=" {{asset(css/admin_custom.css)}} ">
@stop


{{-- @section('js')
    <script> console.log('Hi!'); </script>
@stop --}}