<?php

namespace App\Http\Controllers;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page['title'] = 'Donation | Home';

        return view('frontend.home')->with(compact('page'));
    }
}
