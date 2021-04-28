@extends('layouts.index')

@include('admin.partials.header')

@section('content') 
    <div class="container text-center">
        <form action={{route('ad.store.fichiers')}} method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="name" />
            <input type="submit" value="Envoyer > ">
        </form>

        @if ($fichiers->count() > 0)
        
            @foreach ($fichiers as $file)
                @if (in_array(Str::after($file->name, '.'), $allowed))
                    <img src={{asset('/storage/img/'.$file->name)}} alt=""> 
                @else
                    noon <br/> 
                @endif
            @endforeach
        @else
            Pas de fichiers dans la db...
        @endif        
    </div>

    
@endsection