<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use Illuminate\Support\Facades\Auth;


class CategoriasController extends Controller
{

    public function index()
    {
        return view('Dashboard/Categorias/categorias');
    }

    public function ListarCategorias()
    {
        $user = Auth::user();


        $categorias = Categorias::where('id_usuario', $user->id)
            ->orderBy('id', 'desc')
            ->get();


        return response()->json(['categorias' => $categorias]);
    }

    public function store(Request $request)
    {

        request()->validate([
            'nombre' => 'required',
        ]);

        $user = Auth::user();

        $categorias = Categorias::create([
            'nombre' => $request->nombre,
            'id_usuario' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'categorias' => $categorias
        ]);

    }

    
}
