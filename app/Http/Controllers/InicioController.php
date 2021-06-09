<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{

    public function index()
    {
        // MOstrar la receta por cantidad de votos
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
        // return $votadas;
        // $nuevas = Receta::orderBy('created_at', 'ASC')->get();
        $nuevas = Receta::latest()->take(5)->get();

        $categorias = Categoria::all();

        $recetas = [];

        foreach ( $categorias as $categoria ) {
            $recetas[ Str::slug( $categoria->nombre )][] = Receta::where('categoria_id', $categoria->id )->take(3)->get();
        }


        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
