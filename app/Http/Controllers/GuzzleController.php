<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;
use GuzzleHttp\Client;
use App\Models\Favorito;

class GuzzleController extends Controller
{
    public function index()
    {
        //Carga la BD con la API
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
                ['id_comics' => $data->id],
                [
                    'id_comics' => $data->id,
                    'title' => $data->title,
                    'thumbnail' => json_encode($data->thumbnail),
                    'creators' => json_encode($data->creators),
                    'stories' => json_encode($data->stories),
                ],
            );
        }

        $comics = Comic::paginate(10);
        $list_favorito= Favorito::where('user_id',auth()->user()->id)->get()->pluck('comic_id');
        return view('home', compact('comics','list_favorito'));

    }

    public function show($id){
        $comic = Comic::findOrFail($id);
        return view('detail', compact('comic'));
    }

    public function store(){
        $comics = Comic::paginate(10);
        $list_favorito= Favorito::where('user_id',auth()->user()->id)->get()->pluck('comic_id');
        return view('home', compact('comics','list_favorito'));
    }

    public function guardar($comic_id,$comic_title)
    {
        $Favorito = new Favorito;
        $Favorito->comic_id = $comic_id;
        $Favorito->comic_title = $comic_title;
        $Favorito->user_id = auth()->user()->id;
        $Favorito->save();
        $list_favorito= Favorito::where('user_id',auth()->user()->id)->get()->pluck('comic_id');
        $comics = Comic::paginate(10);
        return view('home', compact('comics','list_favorito'));
    }

    public function eliminar($id)
    {
        $list_favorito= Favorito::where('comic_id',$id)
        ->orWhere('user_id',auth()->user()->id)
        ->delete();
        $list_favorito= Favorito::where('user_id',auth()->user()->id)->get()->pluck('comic_id');
        $comics = Comic::paginate(10);
        return view('home', compact('comics','list_favorito'));
    }

}
