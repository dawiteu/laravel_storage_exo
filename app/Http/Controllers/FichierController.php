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
        //dd($request->file('name')); 
        $file = new Fichier(); 

        
        if($request->hasFile('name')){
            Storage::put('public/img/', $request->file('name'));
            $file->name = $request->file('name')->hashName(); 
        }else{

            $remoteImage = $request->filename;
            $content = file_get_contents($remoteImage); 

            $end = Str::afterLast($remoteImage, '.'); 

            $uniquename = uniqid().".".$end; 

            Storage::put("public/img/".$uniquename, $content); 

            $file->name = $uniquename; 


            //dd(Storage::allDirectories('/public/img/'));

            //$copy = copy($remoteImage, Storage::allDirectories('public/img.')); 
            //$name = "lenomdelimage";
            //return response()->download($remoteImage, $name);

            //$fichier = readfile($remoteImage); 

            //Storage::put('public/img/', $fichier);
            //$file->name = base64_encode(file_get_contents($remoteImage));

            //dd($file->name);

            //$content = file_get_contents_curl($remoteImage); 

            //dd($content); 

            //Storage::put('public/img/', $content);
            
            //dd($file->name); 
            //dd($content); 
                    //$imagedata = base64_encode(file_get_contents($remoteImage));

            //dd($imagedata); 

            //$setnewname = Hash::make($request->filename); 

            //dd($request->filename);

            //$ch = curl_init($remoteImage);
            //curl_setopt($ch, CURLOPT_POST, 0);
            //curl_setopt($ch,CURLOPT_URL,$request->filename);
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //$result=curl_exec($ch);
            //curl_close($ch);

            //Storage::put('public/img/', $result);
            //$file->name = 'image'; 
            //$save = fopen('/public/img/'. $request->filename, 'w+'); 
            //fwrite($save, $result); 
            //fclose($save); 

            //$imginfo = getimagesize($remoteImage);
            //header("Content-type: {$imginfo['mime']}");
            //;
            //$file->name = $request->filename; 
            //$content = file_get_contents($remoteImage); 
                    //Storage::put('public/img/', readfile($remoteImage));
            //$save = fopen('/public/img/'. $request->filename, 'w+'); 
            //fwrite($save, $result); 
            //fclose($save); 
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
}
