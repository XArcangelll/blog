<div>

    <div class="card">

        <div class="card-header">
                <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre o correo de un Usuario">
        </div>
        @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td width="100px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit',$user)}}">Editar Rol</a>
                                </td>
                                <td width="150px">
                                    <a class="btn btn-success btn-sm" href="{{route('admin.permissions.edit',$user)}}">Editar Permisos</a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="ml-auto card-footer">
            {{$users->links()}}
        </div>
        @else
        <div class="card-body">
            <strong>No hay ningún registro...</strong>
        </div>


    @endif

    </div>

</div>
