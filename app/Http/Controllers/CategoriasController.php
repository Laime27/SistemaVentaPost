<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriasController extends Controller
{

    public function index(){
        return view('Dashboard/Categorias/categorias');
    }

    public function ListarCategorias()
    {
        
        $user = auth()->user(); 

        
        $categorias = Categorias::where('id_usuario', $user->id)->get(); 

        return response()->json(['categorias' => $categorias]);
        
    }




}
