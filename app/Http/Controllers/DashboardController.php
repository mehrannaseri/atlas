<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Post\Entities\Language;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();

        return view('dashboard' , compact('languages'));
    }
}
