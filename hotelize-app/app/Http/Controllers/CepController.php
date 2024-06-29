<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CepController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getCepInfo($cep)
    {
        try {
            $response = $this->client->get("https://viacep.com.br/ws/{$cep}/json/");
            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);
                return response()->json($data);
            }
            return response()->json(['error' => 'Erro ao obter informações do CEP'], 404);
        } catch (RequestException $e) {
            return response()->json(['error' => 'Erro ao conectar com o serviço'], 500);
        }
    }
}
