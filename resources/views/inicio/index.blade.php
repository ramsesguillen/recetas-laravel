@extends('layouts.app')

{{-- @section('styles') --}}

@section('hero')
    <div class="hero-categorias">
        <form action="{{ route('buscar.show') }}" class="container h-100">
            <div class="row h-100-align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display 4">Encuentra una receta para tu próxima comida</p>

                    <input
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Receta"
                    >
                </div>
            </div>
        </form>
    </div>
@endsection


@section('content')
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Últimas Recetas</h2>
        <div class="row">
            @forelse ( $nuevas as $nueva )
                <div class="col-md-4">
                    <div class="card">
                        <img src="/storage/{{ $nueva->imagen }}" class="card-img-top" alt="">

                        <div class="card-body">
                            <h3>{{ Str::title(  $nueva->titulo ) }}</h3>
                            <p>{{ Str::words( strip_tags( $nueva->preparacion ), 20, '...') }}</p>
                            <a href="{{ route('recetas.show', $nueva->id ) }}" class="btn btn-success d-block">Ver receta</a>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas más votadas</h2>
        <div class="row">
                @foreach ( $votadas as $receta)
                    @include('ui.receta')
                @endforeach
        </div>
    </div>


    @foreach ( $recetas as $key => $grupo )
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{ str_replace('-', ' ', $key) }}</h2>
            <div class="row">
                @foreach ( $grupo as $recetas )
                    @foreach ( $recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
