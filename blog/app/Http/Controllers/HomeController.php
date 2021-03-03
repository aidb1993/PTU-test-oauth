<?php

namespace App\Http\Controllers;

use App\QBOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $qboAuth = QBOAuth::where('user_id',$id)->first();

        return view('home', compact('qboAuth'));
    }
}
