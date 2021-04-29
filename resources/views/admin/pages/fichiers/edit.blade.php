@extends('layouts.index')

@include('admin.partials.header')

@section('content') 
    <div class="container text-center">
        <form action={{route('ad.update.fichiers', $file->id)}} method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="row">
            <div class="col-4">
                <label for="newfilename">
                    Choissisez un nouveau fichier pour modifier:
                </label> 
            </div>
            <div class="col-8">
                <input type="file" name="newfilename" class='w-100' />
            </div>
            <div class="col-4">
                <label for="newfiletext">
                    Où entrez un nouveau lien:
                    <button class="btn btn-secondary" onclick="javascript:document.querySelector('input[name=newfiletext]').value='';return false;">videz</button>
                </label>
            </div>
            <div class="col-8">
                <input type="text" name="newfiletext" class='w-100' value="{{$file->name}}">
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-success">Actualisez</button>
            </div>
        </div>
        </form>
    </div>
@endsection 