<div>
    <div class="card">
        <div class="card-header">
            <input wire:model ="search" class="form-control" placeholder="Ingrese el Nombre o Correo de un Usuario.">
        </div>
        @if($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>EMAIL</th>
                            <TH></TH>
                        </tr>
                    </thead>
                    <TBODY>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td width="10px">
                                    <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </TBODY>
                </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registos que coincidan con el criterio de búsqueda.</strong>
            </div>
        @endif
    </div>
</div>
