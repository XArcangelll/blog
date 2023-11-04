<div class="card">

    @livewireScripts()

    

    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un post">
    </div>

    @if ($posts->count())
        <div class="card-body">

            <div class="table-responsive">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>ID</th>
                
                        <th>Name</th>
                        <th>Estado</th>
                        @if (auth()->user()->roles->pluck('id')->contains(1))
                        <th>Usuario</th>
                        @endif
                       
                        <th></th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td width="25px" >{{ $post->id }}</td>
                            <td width="40%" >{{ $post->name }}</td>
                            <td>{{ $post->status == 1 ? "Borrador" : "Publicado" }}</td>
                            @if (auth()->user()->roles->pluck('id')->contains(1))
                            <td>{{ $post->user->name }}</td>
                            @endif

                   
            
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.edit', $post) }}">Editar</a>
                            </td>

                            <td width="10px">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
            </div>
        </div>

        <div class="ml-auto card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún registro...</strong>
        </div>


    @endif




</div>
