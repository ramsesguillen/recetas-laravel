<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $this->authorize('view', $perfil );
        $recetas = Receta::where('user_id', Auth::user()->id )->paginate(10);
        return view('perfiles.show', compact('perfil', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfiles.edit', compact('perfil') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update', $perfil );
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required',
            'biografia' => 'required',
        ]);

        if ( $request->imagen ) {
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');
            $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(600, 600);
            $img->save();
        }

        auth()->user()->url  = $validated['url'];
        auth()->user()->name = $validated['name'];
        auth()->user()->save();

        auth()->user()->perfil()->update(
            array_merge(
                ['biografia' => $validated['biografia']],
                ['imagen' => $ruta_imagen ?? $perfil->imagen]
            ));

        return redirect()->route('recetas.index');
    }
}
