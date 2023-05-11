@extends('layouts.app')

@section('content')
<div class="bg-black" style=" width:800px; height: 600px;   margin: 0 auto;">
    <div class="d-flex">
        <?php
        // Como es un string se convierte en JSON
        $var = json_decode($comic->thumbnail);
        $url=$var->path.".".$var->extension;
        ?>
        <div id="fondo" class="p-0 m-0 w-50 " style="
        position: relative; background-image: url('{{$url}}'); height:530px;">
             <img src="{{$url}}" alt="{{$comic->title}}" style="   display: block;
             margin: 100px auto;   width:40%;">
            <span  style="  position: absolute;
            top: 20%;
            z-index: -2;
            background: whitesmoke; width:400px;">
                <i class="bi bi-arrow-left-circle text-left"></i>
            </span>


        </div>

        <div class="p-0 m-0 d-flex w-50 " style="height: 530px;">
            {{-- Detalle --}}
            <div class="d-flex flex-column w-100 h-100">
                <div class="p-4 d-flex align-items-center justify-content-center h-50 " >
                    {{-- Title --}}
                    <h2 class="card-title text-white">{{$comic->title}}</h2>
                </div>

                <div data-bs-spy="scroll"  data-bs-smooth-scroll="true" class="px-4 bg-white text-black scrollspy-example-2 h-50" tabindex="0"
                style="
                height: 100%;
                width: 100%;
                overflow-y: scroll;">

                    {{-- Creatros Stories --}}
                    <p class="fs-4 m-0">Creators</p>
                    <div class="card-body">
                        <?php
                        // Como es un string se convierte en JSON
                        $creators = json_decode($comic->creators);
                        // var_dump($creators->items[0]->name);
                        ?>
                        <ol class="list-group-numbered p-1 list-group-item-secondary">
                            @forelse ($creators->items as $data)
                                <li class="list-group-item" >{{$data->name}}</li>
                            @empty
                                <p>No Exists Creators</p>
                            @endforelse
                        </ol>
                    </div>
                    <p class="fs-4 m-0">Stories</p>
                    <div class="card-body">
                        <?php
                        // Como es un string se convierte en JSON
                        $stories = json_decode($comic->stories);
                        // var_dump($creators->items[0]->name);
                        ?>
                        <ol class="list-group-numbered p-1 list-group-item-secondary">
                            @forelse ($stories ->items as $data)
                                <li class="list-group-item">{{$data->name}}</li>
                            @empty
                                <p>No Exists Creators</p>
                            @endforelse
                        </ol>
                    </div>
                </div>

              </div>
        </div>
      </div>
</div>
@endsection


