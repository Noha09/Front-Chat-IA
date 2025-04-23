<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraductorController extends Controller
{
    // public function index()
    // {
    //     return view('traductor');
    // }

    public function traducir(Request $request)
    {
        $texto = $request->input('texto');

        // Lógica para comunicar con tu API de Python
        // Por ejemplo, usando HTTP para llamar a tu servicio

        // Simulación temporal
        $traduccion = "Conexión pendiente con API de Python...";

        return response()->json(['traduccion' => $traduccion]);
    }
}
