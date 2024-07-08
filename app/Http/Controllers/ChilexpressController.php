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
    public function cotizar(Request $request)
    {
        // Validar y recibir los datos de la solicitud
        $data = $request->validate([
            'originCountyCode' => 'required|string',
            'destinationCountyCode' => 'required|string',
            'package.weight' => 'required|numeric',
            'package.height' => 'required|numeric',
            'package.width' => 'required|numeric',
            'package.length' => 'required|numeric',
            'productType' => 'required|integer',
            'contentType' => 'required|integer',
            'declaredWorth' => 'required|numeric',
            'deliveryTime' => 'required|integer',
        ]);

        // Configurar encabezados y realizar la solicitud
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
            'Ocp-Apim-Subscription-Key' => 'c17619e460b847429e8e7d031828c053',
        ])->post('https://testservices.wschilexpress.com/rating/api/v1.0/rates/courier', $data);

        // Obtener el cuerpo de la respuesta
        $responseBody = $response->body();

        // Devolver la respuesta en formato JSON
        return response()->json([
            'status' => $response->status(),
            'body' => json_decode($responseBody, true),
        ]);
    }
}
