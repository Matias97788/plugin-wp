<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class StarkenController extends Controller
{
    public function obtenerTarifasStarken()
    {
        $response = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Token 4kqpWbigmJZiMsCjW7xYihi86acqXcWy',
            'Content-Type' => 'application/json',
        ])->get('https://baserow-production-377e.up.railway.app/api/database/rows/table/540/');

        if ($response->failed()) {
            return response()->json([
                'error' => 'Error de cURL: ' . $response->body(),
            ], $response->status());
        }

        return response()->json([
            'status' => $response->status(),
            'body' => $response->json(),
        ]);
    }
    public function obtenerValorEnvio(Request $request)
    {
        $ciudad = $request->input('ciudad');
        $comuna = $request->input('comuna');

        if (!$ciudad || !$comuna) {
            return response()->json([
                'error' => 'Debe proporcionar los parámetros de ciudad y comuna.',
            ], 400);
        }

        $url = 'https://baserow-production-377e.up.railway.app/api/database/rows/table/540/';
        $query = http_build_query([
            'user_field_names' => 'true',
            'filter__field_5128__contains' => $ciudad,
            'filter__field_5129__contains' => $comuna,
        ]);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Token 4kqpWbigmJZiMsCjW7xYihi86acqXcWy',
        ])->get($url . '?' . $query);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Error de cURL: ' . $response->body(),
            ], $response->status());
        }

        $data = $response->json();

        return response()->json([
            'status' => 200,
            'body' => $data,
        ]);
    }
}
