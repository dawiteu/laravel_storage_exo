@extends('layouts.header')

@section('contentnav')
    
    <li class="nav-item active">
        <a class="nav-link" href={{route('home')}}>Accueil <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href={{route('admin.home')}}>Admin >></a>
    </li>

@endsection