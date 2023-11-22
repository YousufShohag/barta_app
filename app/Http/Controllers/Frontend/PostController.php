<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post_register(Request $request) {

        $form_input = $request->all();

        $validated = $request->validate([
            'description' => 'required',
        ]);

        Post::create([
            "uuid"=> Str::uuid(),
            "description"=> $form_input["description"],
            "user_id"=>Auth::user()->id,
        ]);
        return view("pages.postSuccess");
    }
    public function showPost($uuid){
        $post = DB::table('posts')->where('uuid', $uuid)->first();
        return view('pages.edit-post',compact('post'));
    }

    public function deletePost($uuid){
        $post = DB::table('posts')->where('uuid', $uuid)->delete();
        return redirect()->back();

    }
    public function updatePost(Request $request, $uuid){
        $form_input = $request->all();

        $validated = $request->validate([
            'description' => 'required',
        ]);

        $details = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->select('posts.*', 'users.*')
        // ->select('posts.*', 'users.name', 'users.username')
        ->get();

        $post = DB::table('posts')->where('uuid',$uuid)->update([
            'description'=> $form_input["description"],
        ]);
        // return redirect()->back();
        return redirect()->route('home');
        // return view('pages.index',compact('details'));
    }
    public function single_post($id){
        $details = DB::table('users')
        ->join('posts','users.id','=','posts.user_id')
        ->select('users.*', 'posts.*')
        ->get();

        $user = DB::table('users')->where('id', $id)->first();
        return view('pages.single-post',compact('user','details'));
    }



}
