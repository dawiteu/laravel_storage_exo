<?php

namespace App\Http\Controllers;

use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class FichierController extends Controller
{
    public function index(){
        $fichiers = Fichier::all(); 
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        return view('admin.pages.fichiers.show', compact('fichiers','allowed'));
    }

    public function store(Request $request){ 
        //dd($request->file('name')); 
        Storage::put('public/img/', $request->file('name')); 

        $file = new Fichier(); 

        $file->name = $request->file('name')->hashName(); 
        //$file->type = explode(".", $file->name); 

        $file->save(); 

        return redirect()->route('admin.home');
    }
}
