@extends('layouts.app')


@section('botones')
 @include('ui.nav')
@endsection



@section('content')
    <h2 class="text-center mb-5">Administra tus Recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ( $recetas as $receta )
                    <tr>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->categoria->nombre }}</td>
                        <td>
                            {{-- <form action="{{ route('recetas.destroy', $receta->id ) }}" method="post">
                                @method('DELETE')
                                    <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar">
                                @csrf
                            </form> --}}
                            <eliminar-receta
                                receta-id={{ $receta->id  }}
                            ></eliminar-receta>
                            <a href="{{ route('recetas.edit', $receta->id ) }}" class="btn btn-dark d-block mb-2">Editar</a>
                            <a href="{{ route('recetas.show', $receta->id ) }}" class="btn btn-success d-block">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr><td>No hay data</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            <ul class="list-group">
                @forelse ( $user->meGusta as $receta )
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{ $receta->titulo }}</p>
                        <a href="{{ route('recetas.show', $receta->id ) }}" class="btn btn-outline-success d-block text-uppercase">Ver</a>
                    </li>
                @empty
                    <p>Aún no tienes recetas guardadas</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

