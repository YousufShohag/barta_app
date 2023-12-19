<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserCreateRequest;
use App\Http\Controllers\Frontend\PostController;

class UserController extends Controller
{
    protected $postController;

    public function __construct(PostController $postController)
    {
        $this->postController = $postController;
    }
    /**
     * Display a listing of the resource.
     */
    public function registration()
    {
        return view("auth.register");
    }

    public function register_store(UserCreateRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return view("pages.thanks");
    }

    public function login()
    {
        return view("auth.login");
    }
//! FOR POST
    public function loginsuccess(Request $request)
    {
        $credentials = $request->validate([
            "email"=> ['required', 'email'],
            "password"=> ['required'],
        ]);


    if (Auth::attempt($credentials)) {
       $details = $this->postController->index();
        return redirect()->route('home');
    }else{
        return view("pages.404");
    }

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
        $user = User::find(Auth::id());

        $user->name = $form_input["name"];
        $user->username = $form_input["username"];
        $user->email = $form_input["email"];
        $user->password = $form_input["password"];
        $user->bio = $form_input["bio"];

        $user->save();
        return back();

    }

    public function search(Request $request)
{

    $query = $request->input('query');

    $users = User::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get();

    return view('pages.search-results', compact('users', 'query'));
}


}