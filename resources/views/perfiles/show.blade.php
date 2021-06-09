@extends('layouts.app')


@section('botones')
    <a
        href="{{ route('recetas.index') }}"
        class="btn btn-outline-primary mr-2"
    >
        Volver
    </a>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if( $perfil->imagen )
                    <img src="/storage/{{ $perfil->imagen }}" class="w-100 rounded-circle" alt="">
                @endif

            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary">{{ $perfil->user->name }}</h2>
                <a href="{{ $perfil->user->url }}">Visitar sitio web</a>
                <div class="biografia">
                    {!! $perfil->biografia !!}
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recetas creadas por: {{ $perfil->user->name }}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @forelse ( $recetas as $receta )
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="/storage/{{ $receta->imagen }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h3>{{ $receta->titulo  }}</h3>

                            <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-primary d-block">Ver receta</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center w-100">No hay recetan aún...</p>
            @endforelse
        </div>
        {{ $recetas->links() }}
    </div>

@endsection
