<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{

    public function index()
    {
        $details = Post::with('user:id,name,username,email,bio')
                    ->select('posts.*')
                    ->latest()
                    ->get();

        //! FOR IMAGE
        // $images = Post::latest()->get();

        return view('pages.index',compact('details'));
    }
    public function store(PostCreateRequest $request) {

        $data = $request->validated();
        // dd($data);
        $data ['uuid'] = Str::uuid();
        $data ['user_id'] = Auth::user()->id;

        $post = Post::create($data);



        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return view("pages.postSuccess");
    }
    public function show(string $uuid){

        // $post = DB::table('posts')->where('uuid', $uuid)->first();
         // Assuming 'uuid' is the column in the posts table
        $post = Post::where('uuid', $uuid)->first();

        return view('pages.edit-post', compact('post'));
    }



    public function destroy(string $uuid){
        $post = Post::where('uuid', $uuid)->delete();
        // $post = DB::table('posts')->where('uuid', $uuid)->delete();
        return redirect()->back();

    }
    public function update(Request $request, string $uuid){
        $form_input = $request->all();

        $validated = $request->validate([
            'description' => 'required',
        ]);

        $details = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->select('posts.*', 'users.*')
        ->get();

        $post = DB::table('posts')->where('uuid',$uuid)->update([
            'description'=> $form_input["description"],
        ]);
        return redirect()->route('home');
    }
    public function single_post($uuid){

        $details = DB::table('users')
                ->join('posts','users.id','=','posts.user_id')
                ->select('users.*', 'posts.*')
                ->get();

        // $details = Post::with('user:id,name,username,email,bio')
        //             ->select('posts.*')
        //             ->get();

        $post = DB::table('posts')->where('uuid', $uuid)->first();
        $comments = DB::table('comments')
                    ->join('users','comments.user_id','=','users.id')
                    ->select('comments.*', 'users.name','users.username')
                    ->where('post_id',$post->id)
                    ->get();


        $user = User::where('id',$post->user_id)->first();

        // dd($user);

        return view('pages.single-post',compact('user','details','comments'));
    }



}