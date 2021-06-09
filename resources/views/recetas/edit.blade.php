@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('botones')
    <a
        href="{{ route('recetas.index') }}"
        class="btn btn-primary mr-2"
    >
        Volver
    </a>
@endsection


@section('content')
    <h2 class="text-center mb-5">Editar Receta </h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('recetas.update', $receta->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror"
                        id="titulo"
                        placeholder="Titulo receta"
                        type="text"
                        value="{{ old('titulo', $receta->titulo) }}"
                    >
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categoria">Example select</label>
                    <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria">
                        <option value="">-- Seleccione --</option>
                        @foreach ( $categorias as $id => $categoria )
                            <option
                                value="{{ $id }}"
                                {{ old('categoria', $receta->categoria_id) == $id ? 'selected' : '' }}
                            >
                                {{ $categoria }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparacion">Preparación</label>
                    <input
                        type="hidden"
                        name="preparacion"
                        id="preparacion"
                        value="{{ old('preparacion', $receta->preparacion) }}"
                    >
                    <trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredientes">Inggredientes</label>
                    <input
                        type="hidden"
                        name="ingredientes"
                        id="ingredientes"
                        value="{{ old('ingredientes', $receta->ingredientes) }}"
                    >
                    <trix-editor class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes"></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="imagen">Elige la imagen</label>
                    <input
                        type="file"
                        id="imagen"
                        name="imagen"
                        class="form-control @error('imagen') is-invalid @enderror"
                    >
                    <div class="mt-4">
                        <p>Imagen actual: </p>
                        <img src="/storage/{{ $receta->imagen }}" style="width: 300px" alt="">
                    </div>
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
