<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BlueExpress extends Controller
{
    //Obtener codigo de región y nombre
    public function obtenerRegiones()
    {
        $client = new Client();
        $url = 'https://bx-tracking.bluex.cl/bx-geo/state/all';

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'BX-TOKEN' => '1d629416cf222568df3c231ce57c93ec',
                    'BX-USERCODE' => '183462',
                    'BX-CLIENT_ACCOUNT' => '77563939-2-80'
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Mantener los datos de $states
            $states = array_map(function ($state) {
                return [
                    'code' => $state['code'],
                    'name' => $state['name']
                ];
            }, $data['data'][0]['states']);

            // Crear un nuevo arreglo para los districts
            $districts = [];
            foreach ($data['data'][0]['states'] as $state) {
                foreach ($state['ciudades'] as $city) {
                    foreach ($city['districts'] as $district) {
                        $districts[] = [
                            'code' => $district['code'],
                            'name' => $district['name']
                        ];
                    }
                }
            }

            // Depuración para ver ambos arreglos
            /*dd([
                'states' => $states,
                'districts' => $districts
            ]);*/

            return response()->json([
                'states' => $states,
                'districts' => $districts
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error'], 500);
        }
    }
}
