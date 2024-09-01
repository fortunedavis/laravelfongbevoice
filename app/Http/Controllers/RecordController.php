<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MessageController;

class RecordController extends Controller
{   
   
  

    public function update(Request $request){
        $record = Record::findOrFail($request->input('record_id'));

        $record->state = $request->input("state");
        
        $record->save();

        return response()->json(['success' => 'Validated successfully',
    "other"=>$record], 200);

    }
    
    public function upload(Request $request)
    {   
        $user_id = auth()->check()? auth()->id() : 1;

        $messageController = new MessageController();
        function getNumberFromFilename($filename) {
            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            preg_match('/\d+/', $nameWithoutExtension, $matches);
            return $matches[0] ?? null;
        }
        // $a = [];
        $files = $request->file("files");
        // $res = "";     
        if (is_array($files)) {
            foreach ($files as $file) {
                $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mimetype = $file->getClientMimeType();
                $size = $file->getSize();
                $name = $file->getClientOriginalName();
                $message_id = getNumberFromFilename($name);
                $messageController->update($request,$message_id);
                // $record = new Record();
                $filePath = $file->storeAs('public/uploads', $name);
                // array_push($a, $name);

                Record::create([
                    "message_id" => $message_id,
                    "user_id" => $user_id,
                    'name' => $name,
                    'path' => $filePath,
                    'size' => $size,
                    "type"=> $extension,
                ]); 
            }
        }
        
        return response()->json(["success"=>"message bien enregistrés"]);
    }
}
