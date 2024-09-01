<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Record;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class AdminController extends Controller
{
    public function index(){
        $users_number = User::all()->count();

        $records_number = Record::all()->count();

        $best = User::withCount('records')
        ->orderBy('records_count', 'desc')
        ->first();


        $chart_options = [
            'chart_title' => 'Enregistrement par dates',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Record',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'chart_type' => 'line',
        ];
    
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Users by names',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Record',
            'group_by_field' => 'state',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
        ];
    
        $chart2 = new LaravelChart($chart_options);

        
        $data = [
            "chart1"=>$chart1,
            "users_number"=>$users_number,
            "records_number"=>$records_number,
            "best"=>$best,
            "chart2"=>$chart2
        ];

        return view("admin.home",$data);
    }

    public function RecordAndMessage(){
        
        $records = Record::with('message')->get();

        return view("admin.messagesAndRecord",["records"=>$records]);
    }

    public function export()
    {
    $message_ids = Record::all()->pluck("message_id");
    $messages = Message::whereIn('id', $message_ids)->get();

    // dd($messages);

    $csvFileName = 'messages.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
    ];

    $handle = fopen('php://output', 'w');
    fputcsv($handle, ['id', 'content']); 

    foreach ($messages as $message) {
        fputcsv($handle, [$message->indentifiant, $message->message]); // Add more fields as needed
    }

    fclose($handle);

    return Response::make('', 200, $headers);
    }


    public function sentences(){
        
        $messages = Message::all();

        return view("admin.sentences",["messages"=>$messages]);
    }

    public function updatesentence(Request $request){
        
        $message  =  Message::findOrFail($request["id"]);
        $message->message = $request["message"];
        $message->save();
        $messages  = Message::all();

        return view("admin.sentences",["messages"=>$messages]);
    }

    public function messagedit($id){
        $message = Message::find($id);
        return view('admin.messagedit', compact('message'));
        
    }

    public function users(){
        $users = User::withCount("records")->get();
        $users = User::withCount([
            'records', 
            'records as validated_records_count' => function ($query) {
                $query->where('state', 'validated');
            }
        ])->get();

        $roles = Role::all();
        return view("admin.user",["users"=>$users, "roles"=>$roles]);
    }

   
    public function downloadFiles(){
        $zip = new ZipArchive;
        $zipFileName = 'audios.zip';
        $zipFilePath = storage_path($zipFileName);
    
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            $files = Storage::allFiles('public/uploads');
            foreach ($files as $file) {
                $fileName = basename($file);
                $zip->addFile(storage_path('app/' . $file), $fileName);
            }
            
            $zip->close();
        }
    
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }


}
