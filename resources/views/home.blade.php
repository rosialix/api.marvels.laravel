@extends('layouts.app')

@section('content')
<div class="container py-1 bg-black text-white" >
    <?php
    $array_favorite=json_decode($list_favorito,true);
    ?>
    <div class="row grid" >
        @foreach($comics as $data)
        <div class="card g-3 bg-black grid-comics" style="width: 12rem;">
               <?php
                // Como es un string se convierte en JSON
                $var = json_decode($data->thumbnail);
                $url=$var->path.".".$var->extension;
                ?>
                  <a title="{{$data->title}}" href="/detail/{{$data->id}}" style="height
                    :90%">
                 <img src="{{$url}}" alt="{{$data->title}}" class="card-img" >
                </a>
            <div class="card-body text-white">
                @if (!empty($array_favorite))
                    @php
                    $respuesta=in_array($data->id_comics, $array_favorite);
                    $clave=array_search($data->id_comics, $array_favorite);
                    $id_favorito=$array_favorite[$clave];
                    @endphp

                    @if ($respuesta)
                      <a href="/comics/{{$id_favorito}}" class="btn btn-danger w-100 align-items-center"  data-placement="left">
                      {{ __('Favorito') }}
                    </a>
                    @else
                      <a href="/comics/{{$data->id_comics}}/{{$data->title}}" class="btn btn-danger w-100  align-items-center "  data-placement="left">
                       {{ __('Agregar') }}
                      </a>
                    @endif

                @else
                 <a href="/comics/{{$data->id_comics}}/{{$data->title}}" class="btn btn-danger w-100  align-items-center "  data-placement="left">
                    {{ __('Agregar') }}
                  </a>
                @endif
            </div>
          </div>
        @endforeach
    </div>
</div>
<div class="d-flex  justify-content-center align-items-center franja" style="height: 35px;">
    {!! $comics->links('vendor.pagination.comic') !!}
</div>
@endsection
