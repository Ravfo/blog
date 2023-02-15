@extends('adminlte::page')
@section('title', 'Blog')

@section('content_header')
    <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-secondary float-right">Crear Rol</a>
    <h1>Lista de Roles de Usuario.</h1>
@stop

@section('content')
    @if (session('eliminar'))
    <div class="alert alert-danger">
        {{session('eliminar')}}
    </div>
    @endif
    @if (session('mensaje'))
    <div class="alert alert-success">
        {{session('mensaje')}}
    </div>
    @endif
    
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td width="10px"><a href="{{route('admin.roles.edit',$role)}}" class="btn btn-sm btn-primary">Editar</a></td>
                        <td width="10px">
                            <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop