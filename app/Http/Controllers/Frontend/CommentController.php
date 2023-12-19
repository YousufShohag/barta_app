<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $uuid)
    {
    //     $details = Post::with('user:id,name,username,email,bio')
    //                 ->select('posts.*')
    //                 ->get();
    //                 // dd($details);
    //     // $post = DB::table('posts')->where('uuid', $uuid)->first();

    //     $post = Post::where('uuid', $uuid)->first();

    // //   dd($post);

    //     // $comments = Comment::with('user:id,name,username,email,bio')
    //     //             ->select('comments.*')
    //     //             ->where('post_id',$post->id)
    //     //             ->get();
    //     $comments = DB::table('comments')
    //                 ->join('users','comments.user_id','=','users.id')
    //                 ->select('comments.*', 'users.name','users.username')
    //                 ->where('post_id',$post->id)
    //                 ->get();
    //                 // dd($comments);

    //     // $user = User::where('id',$post->user_id)->first();

    //     // dd($user);
    //     return view('pages.single-comment',compact('details','comments'));
    $details = DB::table('posts')
    ->join('users','posts.user_id','=','users.id')
    ->where('posts.uuid', $uuid)
    ->select('posts.*', 'users.name','users.username')
    ->latest()
    ->get();

        $post = DB::table('posts')->where('uuid', $uuid)->first();

        $comments = DB::table('comments')
                ->join('users','comments.user_id','=','users.id')
                ->select('comments.*', 'users.name','users.username')
                ->where('post_id',$post->id)
                ->get();

                // $images = Post::latest()->get();

    return view('pages.single-comment',compact('details','comments'));
    }


    public function store(Request $request, $id )
    {
        $form_input = $request->all();
        $validated = $request->validate([
            'comment' => 'required',
        ]);
       $data =  Comment::create([
            "uuid"=> Str::uuid(),
            "comments"=> $form_input["comment"],
            "user_id"=>Auth::user()->id,
            "post_id"=>$id,
        ]);
        return redirect()->back()->with("success");
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $uuid)
    {
        $comments = Comment::where('uuid', $uuid)->first();
        return view('pages.edit-comment',compact('comments'));
    }

    public function update(Request $request, string $uuid)
    {
        $form_input = $request->all();

        $validated = $request->validate([
            'comments' => 'required',
        ]);
        $comments = DB::table('comments')->where('uuid',$uuid)->update([
            'comments'=> $form_input["comments"],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
            // $comments = DB::table('comments')->where('uuid', $uuid)->delete();
            $comments = Comment::where('uuid', $uuid)->delete();
            return redirect()->back();

    }
}
