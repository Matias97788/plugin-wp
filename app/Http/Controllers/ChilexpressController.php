<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChilexpressController extends Controller
{
    public function ObtenerRegiones()
    {
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache',
            'Ocp-Apim-Subscription-Key' => 'dad6ae9cb40d47d9966bb2cb86e0e6d8',
        ])->get('https://testservices.wschilexpress.com/georeference/api/v1.0/regions');

        if ($response->successful()) {
            // Si la solicitud es exitosa, devolver la respuesta como JSON
            return response()->json($response->json());
        } else {
            // Si hay un error en la solicitud, devolver un mensaje de error con el código de estado
            return response()->json(['error' => 'Failed to fetch regions'], $response->status());
        }
    }
}
