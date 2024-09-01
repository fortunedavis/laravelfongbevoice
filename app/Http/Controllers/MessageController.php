<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
        {
            $messages = Message::where('status', 0)->inRandomOrder()->take(1)->get();
            return $messages->toJson();
        }
    
    
    public function create()
        {
          return view('messages.create');
        }

    public function store(Request $request)
        {
        //   $request->validate([
        //     'title' => 'required|max:255',
        //     'body' => 'required',
        //   ]);
          Message::create($request->all());
          return redirect()->route('message.index')
            ->with('success', 'message created successfully.');
        }
    
    public function update(Request $request, $id)
        {
          $post  =  Message::findOrFail($id);
          $post->status = 1; 
          $post->save();
          return response()->json(['success' => 'Post updated successfully'], 200);

        }

    

    public function edit($id)
        {
          $message = Message::find($id);
          return view('messages.edit', compact('message'));
        }

    public function destroy($id)
        {
          $message = Message::find($id);
          $message->delete();
          return redirect()->route('messages.index')
            ->with('success', 'Message deleted successfully');
        }
      
}
