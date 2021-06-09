<a
    href="{{ route('recetas.create') }}"
    class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold"
>
    Crear Receta
</a>
<a
    href="{{ route('perfils.edit', auth()->user()->id ) }}"
    class="btn btn-outline-success mr-2 text-uppercase font-weight-bold"
>
    Editar Perfil
</a>
<a
    href="{{ route('perfils.show', auth()->user()->id ) }}"
    class="btn btn-outline-info mr-2 text-uppercase font-weight-bold"
>
    Ver Perfil
</a>
