@extends('layouts.index')

@include('admin.partials.header')

@section('content') 
    <div class="container text-center">
            <form action={{route('ad.store.fichiers')}} method="POST" enctype="multipart/form-data">
                @csrf
        <div class="row">
            <div class="col-12 text-center"><h3>Ajouter une images: </h3></div>

                <div class="col-4">
                    <label for="link">Lien vers l'image:</label>
                </div>

                <div class="col-8">
                    <input type="text" name="filename" class="w-100" /> 
                </div>
                <div class="col-4">
                    <label for="file">Ou upload le fichier: </label>
                </div>
                <div class="col-6">
                    <input type="file" name="name"  class="w-100"/>
                </div>
                <div class="col-12 text-center">
                    <input type="submit" value="Envoyer > ">
                </div>
            </form>

        </div>


        <div class="row">
        @if ($fichiers->count() > 0)
            @foreach ($fichiers as $file)

                @if (Str::contains(base64_decode($file->name), '://'))
                    <div class="col-3 m-1">
                        <img class="img-fluid" src="{{asset($file->name)}}" alt="abc" /> 
                        <a href="#"><button class="btn btn-warning">edit</button></a>
                        <form action={{route('ad.del.fichiers', $file->id) }} method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">DEL</button>
                        </form>
                    </div>
                @else  
                    @if (in_array(Str::after($file->name, '.'), $allowed))
                        <div class="col-3 m-1">
                            <img class="img-fluid" src="{{ asset('/storage/img/' . $file->name) }}" alt="abc" /> 
                            <a href="#"><button class="btn btn-warning">edit</button></a>
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

                @endif

            @endforeach
            </div>
        @else
            Pas de fichiers dans la db...
        @endif        
    </div>

    
@endsection