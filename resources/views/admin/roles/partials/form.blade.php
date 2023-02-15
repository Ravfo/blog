<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Escribe el nombre del Rol de Usuario.']) !!}
    @error('name')
        <strong class="text text-danger">{{$message}}</strong>                        
    @enderror

</div>
<h2 class="h3">Lista de Permisos</h2>
@foreach ($permisos as $permiso)
    <div>
        <label for="">
            {!! Form::checkbox('permissions[]', $permiso->id, null, ['class'=>'mr-1']) !!}
            {{$permiso->description}}
        </label>
    </div>
    
@endforeach