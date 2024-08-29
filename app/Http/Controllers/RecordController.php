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
        $messageController = new MessageController();
        function getNumberFromFilename($filename) {
            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            preg_match('/\d+/', $nameWithoutExtension, $matches);
            return $matches[0] ?? null;
        }
        $a = [];
        $files = $request->file("files");
        $res = "";     
        if (is_array($files)) {
            foreach ($files as $file) {
                $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mimetype = $file->getClientMimeType();
                $size = $file->getSize();
                $name = $file->getClientOriginalName();
                $message_id = getNumberFromFilename($name);
                $res = $messageController->update($request,$message_id);
                // $record = new Record();
                $filePath = $file->storeAs('public/uploads', $name);
                array_push($a, $name);

                Record::create([
                    "message_id" => $message_id,
                    "user_id" => 1,
                    'name' => $name,
                    'path' => $filePath,
                    'size' => $size,
                    "type"=> $extension,
                ]); 
                // $res = "it is an array";
            }
        }
        
       
        

        

        
    
        // foreach ($data as $item) {
         
        //     $file = $item['audio'];
            
        //     // $path = $file->storeAs('audio', $filename, 'public');   

        //     $record = new Record();
        //     $record->user_id = 1;
        //     $record->message_id = $item['message_id'];
        //     $record->name = $item['audio'];
        //     // $record->file = $file->getClientOriginalExtension();
        //     // $record->type = $request->file('audio')->getClientMimeType();
        //     // $record->size = $request->file('audio')->getClientSize();
        //     // $record->path = $path;
        //     array_push($response, $record);
        // }
        // $record = new Record();
        // $record->user_id = 1;

        // $file = $data['files'];

        // $path = $file->storeAs('audio', $file, 'public'); 

       

            return response()->json($res);

        // Redirect the user back to the audio list page
        // return redirect()->route('audio.index');
    }
}
