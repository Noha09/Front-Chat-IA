<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class TraductorController extends Controller
{
    // public function index()
    // {
    //     return view('traductor');
    // }

    public function testConection(Request $request)
    {
        $url = env('URL_API');

        // Inicializar cliente HTTP con verificación SSL desactivada
        $client = new Client([
            'verify' => false // Solo para desarrollo
        ]);

        try {
            $response = $client->get($url . '/api/saludo');
            $data = json_decode($response->getBody(), true);
            dd($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al comunicarse con el servicio: ' . $e->getMessage()
            ], 500);
        }
    }

    public function traducir(Request $request)
    {
        $texto = $request->input('texto');
        $url = env('URL_API');

        try {
            // Desactivar verificación SSL
            $client = new Client([
                'verify' => false // Solo para desarrollo, se mantiene desactivada la verificación SSL para evitar problemas de conexión
            ]);

            $response = $client->post($url . '/api/gemma', [
                'json' => ['texto' => $texto]
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json([
                'prompt' => $data['prompt'] ?? '',
                'traduccion' => $data['respuesta'] ?? 'Sin respuesta' // Note: hay que verificar si la respuesta es correcta y con el formato esperado
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'traduccion' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
