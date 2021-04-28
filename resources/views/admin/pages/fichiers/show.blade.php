@extends('layouts.index')

@include('admin.partials.header')

@section('content') 
    <div class="container text-center">
        <form action={{route('ad.store.fichiers')}} method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="name" />
            <input type="submit" value="Envoyer > ">
        </form>


        <div class="row">
        @if ($fichiers->count() > 0)
            @foreach ($fichiers as $file)
                @if (in_array(Str::after($file->name, '.'), $allowed))
                    <div class="col-3 m-1">
                        <img class="img-fluid" src="{{ asset('/storage/img/' . $file->name) }}" alt="abc" /> 
                        <form action={{route('ad.del.fichiers', $file->id) }} method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">DEL</button>
                        </form>
                    </div>
                    @else
                    <div class="col-3 m-1">
                        Fichier non image: <br/> 
                        {{Str::after($file->name, '.') }} extention non reconue.</p>
                        <form action={{route('ad.del.fichiers', $file->id) }} method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">DEL</button>
                        </form>
                    </div>
                @endif
            @endforeach
            </div>
        @else
            Pas de fichiers dans la db...
        @endif        
    </div>

    
@endsection