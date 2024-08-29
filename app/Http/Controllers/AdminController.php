<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Record;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("admin.home");
    }

    public function RecordAndMessage(){
        
        $messages = Message::with('record')->get();

        return view("admin.messagesAndRecord",["messages"=>$messages]);
    }

    public function users(){
        
        // $messages = Message::with('record')->get();
        $users = User::all();
        return view("admin.user",["users"=>$users]);
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
