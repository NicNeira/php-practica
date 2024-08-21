<?php

namespace App\View\Components;

use Illuminate\View\Component;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Indicadores extends Component
{
    public $indicadores;

    public function __construct()
    {
        $apiUrl = 'https://mindicador.cl/api';

        // Crear una instancia de Guzzle
        $client = new Client();

        try {
            // Hacer la solicitud GET a la API
            $response = $client->get($apiUrl);
            
            // Obtener el cuerpo de la respuesta como JSON
            $json = $response->getBody()->getContents();

            // Decodificar el JSON a un objeto PHP
            $this->indicadores = json_decode($json);
        } catch (RequestException $e) {
            // Manejar cualquier excepción de la solicitud HTTP
            $this->indicadores = null;
        }
    }

    public function render()
    {
        return view('components.indicadores');
    }
}
