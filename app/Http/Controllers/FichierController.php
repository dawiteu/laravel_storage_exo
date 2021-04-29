<?php

namespace App\Http\Controllers;

use App\Models\Fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FichierController extends Controller
{
    public function index(){
        $fichiers = Fichier::all(); 
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        return view('admin.pages.fichiers.show', compact('fichiers','allowed'));
    }

    public function store(Request $request){ 
        $file = new Fichier(); 

        if($request->hasFile('name')){
            Storage::put('public/img/', $request->file('name'));
            $file->name = $request->file('name')->hashName(); 
        }else if($request->filename != null){

            $remoteImage = $request->filename;
            $content = file_get_contents($remoteImage); 

            $end = Str::afterLast($remoteImage, '.'); 

            $uniquename = uniqid().".".$end; 

            Storage::put("public/img/".$uniquename, $content); 

            $file->name = $uniquename; 
        }else{
            exit('erreur.. inputs vides');
        }  
         
        $file->save(); 

        return redirect()->route('ad.show.fichiers');
    }

    public function destroy(Fichier $id){
        //dd($id->name);
        Storage::delete("public/img/".$id->name);
        $id->delete();
        return redirect()->route('ad.show.fichiers');
    }

    public function edit(Fichier $id){
    $file = $id;
    return view('admin.pages.fichiers.edit', compact('file')); 
    }

    public function update(Fichier $id, Request $request){
        $file = $id; 
        
        if($request->hasFile('newfilename')){
            Storage::delete('public/img/'.$file->name);
            Storage::put('public/img/', $request->file('newfilename'));
            $file->name = $request->file('newfilename')->hashName(); 
        }else if($request->newfiletext != null){
            $remoteImage = $request->newfiletext;
            $content = file_get_contents($remoteImage); 
            $end = Str::afterLast($remoteImage, '.'); 
            $uniquename = uniqid().".".$end; 
            Storage::put("public/img/".$uniquename, $content); 
            $file->name = $uniquename; 
        }else{
            exit('erreur.. champs vides'); 
        }
        $file->save(); 
        return redirect()->route('ad.show.fichiers');
    }
}
