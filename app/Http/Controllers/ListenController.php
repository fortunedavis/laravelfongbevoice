<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Record;

use Illuminate\Http\Request;

class ListenController extends Controller
{
    public function index(){
        $record = Record::where("state","neutral")->inRandomOrder()->take(1)->first(['id', 'path',"message_id"]);
        $message_id = $record->message_id;
        $message = Message::find($message_id);

        if ($message) {

            $storagePath = str_replace('public/', 'storage/', $record->path);

            $data = [
                "message"=>$message->message,
                "path"=>$storagePath,
                "record_id"=>$record->id
            ];
            return response()->json($data);
        } 
    }
}
