<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

    }


    public function downloadFiles(){
        $files = Storage::allFiles("public/uploads");
        foreach($files as $file){
            Storage::download($file);
        }
        return redirect()->route('message.index')
        ->with('success', 'message created successfully.');
    }

    
}
