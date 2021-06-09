@extends('layouts.app')


@section('botones')
    {{-- <a
        href="{{ route('recetas.create') }}"
        class="btn btn-primary mr-2"
    >
        Crear Receta
    </a> --}}
@endsection



@section('content')

    <article class="contenido-receta bg-white p-5 shadow">
        <h2 class="text-center mb-5">{{ $receta->titulo  }}</h2>

        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" class="w-100" alt="">
        </div>

        <div class="receta-meta">
            <p class="mt-5">
                <span class="font-weight-bold text-primary">Escrito en: </span>
                {{ $receta->categoria->nombre }}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Creado en: </span>
                <fecha-receta fecha="{{ $receta->created_at }}"></fecha-receta>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor: </span>
                <a class="text-dark" href="{{ route('perfils.show', $receta->user->id) }}">{{ $receta->user->name }}</a>
            </p>
            <p>
                <span class="font-weight-bold text-primary">Ingredientes: </span>
                {!! $receta->ingredientes !!}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Preparación: </span>
                {!! $receta->preparacion !!}
            </p>

            <like-button
                receta-id="{{ $receta->id }}"
                like= {{ $like }}
                likes="{{ $likes }}"
            >
            </like-button>
        </div>
    </article>

@endsection
