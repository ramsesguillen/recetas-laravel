<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Receta;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show( Categoria $categoria )
    {
        $recetas = Receta::where( 'categoria_id', $categoria->id)->paginate(2);

        return view('categorias.show', compact('recetas', 'categoria'));
    }
}
