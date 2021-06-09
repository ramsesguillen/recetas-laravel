<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $receta->imagen }}" class="card-img-top" alt="">
        <div class="card-body">
            <div class="card-title">
                <h3 class="card-title">{{ $receta->titulo }}</h3>

                <div class="meta-receta d-flex justify-content-between">
                    <p class="text-primary fecha font-weight-bold">
                        <fecha-receta fecha="{{ $receta->created_at }}"></fecha-receta>
                    </p>

                    <p>{{ count( $receta->likes ) }} Les gustó</p>
                </div>

                <p class="card-text">
                    {{ Str::words( strip_tags( $receta->preparacion ), 20, '...') }}
                </p>
                <a href="{{ route('recetas.show', $receta->id ) }}" class="btn btn-success d-block">Ver receta</a>
            </div>
        </div>
    </div>
</div>
