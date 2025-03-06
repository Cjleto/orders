<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

        // if (Auth::user()?->hasRole('admin')) {
        //     return redirect()->route('admin.home');
        // }


        return view('home');
    }

    public function index_admin()
    {
        return view('home_admin');
    }
}
