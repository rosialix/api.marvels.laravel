<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ComicController extends Controller
{
    public function store()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://gateway.marvel.com',
            // You can set any number of default request options.
            'timeout'  => 15.0,
        ]);
        // Enviar una solicitud a https://foo.com/api/test
        $response = $client->request('GET', 'v1/public/comics?ts=1&apikey=9575534a327575e3f9401f394316ba65&hash=cac95b9d0a37635eebe33d40644585a1');

        // dd($response);
        $data_json= json_decode($response->getBody()->getContents());
        $comics=$data_json->data->results;

        foreach($comics as $data){

            Comic::updateOrCreate(
                ['id' => $data->id],
                [
                    'id_comics' => $data->id,
                    'title' => $data->title,
                    'thumbnail' => json_encode($data->thumbnail),
                    'creators' => json_encode($data->creators),
                    'stories' => json_encode($data->stories),
                ],
            );



        }
    }

}
