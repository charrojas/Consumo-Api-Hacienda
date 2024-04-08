<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ControllerAdmin extends Controller
{
    public function index()
    {
        $tipoCambio = $this->obtenerTipoCambio();
        $datos = null;
        $nombre = null;

        return view('admin', compact('tipoCambio', 'datos', 'nombre'));
    }

    public function obtenerTipoCambio()
    {
        $client = new Client();
        $response = $client->get('https://api.hacienda.go.cr/indicadores/tc/dolar');
        $data = json_decode($response->getBody(), true);

        return $data;
    }

    public function obtenerDatos(Request $request)
    {
        $autorizacion = $request->input('autorizacion');
        $url = "https://api.hacienda.go.cr/fe/ex?autorizacion={$autorizacion}";

        $response = Http::get($url);

        $datos = $response->json();

        return response()->json($datos);
    }



    public function buscarPorNombre(Request $request)
    {
        $nombre = $request->input('nombre');
        $url = "https://api.hacienda.go.cr/fe/cabys?q=" . urlencode($nombre);

        $response = Http::get($url);

        $data = $response->json();

        $resultados = [];

        if ($data['total'] > 0) {
            foreach ($data['cabys'] as $producto) {
                if (stripos($producto['descripcion'], $nombre) !== false) {
                    $resultados[] = $producto;
                }
            }
        }

        return response()->json($resultados);
    }
}
