@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('botones')
    <a
        href="{{ route('recetas.index') }}"
        class="btn btn-outline-primary mr-2"
    >
        Volver
    </a>
@endsection

@section('content')

    <h1>Editar mi Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p 3">
            <form action="{{ route('perfils.update', $perfil->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        placeholder="name receta"
                        type="text"
                        value="{{ old('name', $perfil->user->name) }}"
                    >
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">Sitio web</label>
                    <input
                        name="url"
                        class="form-control @error('url') is-invalid @enderror"
                        id="url"
                        placeholder="url receta"
                        type="text"
                        value="{{ old('url', $perfil->user->url) }}"
                    >
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input
                        type="hidden"
                        name="biografia"
                        id="biografia"
                        value="{{ old('biografia', $perfil->biografia) }}"
                    >
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia"></trix-editor>
                    @error('biografia')
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
                    @if( $perfil->imagen )
                        <div class="mt-4">
                            <p>Imagen actual: </p>
                            <img src="/storage/{{ $perfil->imagen }}" style="width: 300px" alt="">
                        </div>
                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    @endif
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
