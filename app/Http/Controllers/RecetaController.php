<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $recetas = Auth::user()->recetas;
        $user = Auth::user();
        $recetas = Receta::where('user_id',  $user->id )->paginate(10);
        return view('recetas.index', compact('recetas', 'user') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get()->pluck('nombre', 'id');
        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|min:5',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
        ],
        [
            'titulo.required' => 'Te faltó agregar el titulo',
            'titulo.min' => 'El titulo es muy corto',
            'categoria.required' => 'Selecciona una categoria'
        ]);

        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');
        $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1000, 550);
        $img->save();

        // $receta = new Receta();
        // $receta->categoria_id = $validated['categoria'];
        // $receta->titulo = $validated['titulo'];
        // $receta->ingredientes = $validated['ingredientes'];
        // $receta->preparacion = $validated['preparacion'];
        // $receta->imagen = $ruta_imagen;
        // $receta->user_id = Auth::user()->id;
        // $receta->save();

        auth()->user()->recetas()->create([
            'titulo'       => $validated['titulo'],
            'ingredientes' => $validated['ingredientes'],
            'preparacion'  => $validated['preparacion'],
            'categoria_id' => $validated['categoria'],
            'imagen'       => $ruta_imagen
        ]);

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        // Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = ( Auth::user() ) ? Auth::user()->meGusta->contains( $receta->id ) : false;
        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta', 'like', 'likes') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta );
        $categorias = Categoria::get()->pluck('nombre', 'id');
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // Revisa policy
        $this->authorize('update', $receta);

        $validated = $request->validate([
            'titulo' => 'required|min:5',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ],
        [
            'titulo.required' => 'Te faltó agregar el titulo',
            'titulo.min' => 'El titulo es muy corto',
            'categoria.required' => 'Selecciona una categoria'
        ]);

        $receta->titulo = $validated['titulo'];
        $receta->ingredientes = $validated['ingredientes'];
        $receta->preparacion = $validated['preparacion'];
        $receta->categoria_id = $validated['categoria'];

        if ( $request->imagen ) {
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');
            $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1000, 550);
            $img->save();
            $receta->imagen = $ruta_imagen;
        }
        // $receta->imagen = $ruta_imagen;
        $receta->save();

        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);
        $receta->delete();
        return redirect()->route('recetas.index');
    }

    public function search( Request $request )
    {
        $buesqueda = $request->buscar;
        $recetas = Receta::where('titulo', 'like', '%' . $buesqueda . '%')->paginate();
        $recetas->appends(['buscar' => $buesqueda ]);

        return view('busqueda.show', compact('recetas', 'buesqueda'));
    }
}
