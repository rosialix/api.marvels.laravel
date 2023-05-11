<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // // return view('home');
        // $client = new Client([
        //     // Base URI is used with relative requests
        //     'base_uri' => 'https://gateway.marvel.com',
        //     // You can set any number of default request options.
        //     'timeout'  => 15.0,
        // ]);
        // // Enviar una solicitud a https://foo.com/api/test
        // $response = $client->request('GET', 'v1/public/comics?ts=1&apikey=9575534a327575e3f9401f394316ba65&hash=cac95b9d0a37635eebe33d40644585a1');

        // // dd($response);
        //  $data_json= json_decode($response->getBody()->getContents());
        //  $comics=$data_json->data->results;

            $comics = Post::all();
            return view('home', compact('comics'));


        // return view('home',compact('comics'));

    }




}
