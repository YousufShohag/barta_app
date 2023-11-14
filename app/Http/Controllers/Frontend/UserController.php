<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registration()
    {
        return view("auth.register");
    }

    public function register_store(Request $request)
    {
         $form_input = $request->all();

        // DB::table('users')->insert([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => [
                'required',
                'min:6'
            ],
        ]);

        User::create([
            "name"=> $form_input["name"],
            "username"=> $form_input["username"],
            "email"=> $form_input["email"],
            "password"=> $form_input["password"],
        ]);

        return view("pages.thanks");
    }



    public function login()
    {
        return view("auth.login");
    }

    public function loginsuccess(Request $request)
    {
        $credentials = $request->validate([
            "email"=> ['required', 'email'],
            "password"=> ['required'],
        ]);


    if (Auth::attempt($credentials)) {

        // $allPosts = Post::all();
        $details = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            // ->select('posts.*', 'users.*')
            ->select('posts.*', 'users.*')
            ->get();

        return view('pages.index',compact('details'));
    }else{
        return view("pages.404");
    }

    }

    public function home(){
        // $allPosts = Post::all();
        $details = DB::table('posts')
                        ->join('users','posts.user_id','=','users.id')
                        ->select('posts.*', 'users.*')
                        // ->select('posts.*', 'users.name', 'users.username')
                        ->get();



        // $now = Carbon::now();
        // return($now);

        return view('pages.index',compact('details'));
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("login");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function update_profile(Request $request)
    {
        $form_input = $request->all();
        //dd($form_input);
        $user = User::find(Auth::id());

        $user->name = $form_input["name"];
        $user->username = $form_input["username"];
        $user->email = $form_input["email"];
        $user->password = $form_input["password"];
        $user->bio = $form_input["bio"];

        $user->save();
        return back();

    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
