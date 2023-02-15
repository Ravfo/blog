@extends('adminlte::page')
@section('title', 'Blog')

@section('content_header')
    <h1>Editar Rol de Usuario.</h1>
@stop

@section('content')
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>        
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route'=>['admin.roles.update',$role],'method'=>'PUT']) !!}
                @include('admin.roles.partials.form')
                {!! Form::submit('Editar Rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

