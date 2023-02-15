@extends('adminlte::page')
@section('title', 'Blog')

@section('content_header')
    <h1>Asignar un Rol.</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre</p>
            <p class="form-control">{{$user->name}}</p>
            <h2 class="h5">Listado de Roles</h2>
            {!! Form::model($user, ['route'=>['admin.users.update',$user], 'method'=>'put']) !!}
                @foreach ($roles as $rol)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $rol->id, null, ['class'=>'mr-1']) !!}
                            {{$rol->name}}
                        </label>
                    </div>
                    
                @endforeach
                {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop