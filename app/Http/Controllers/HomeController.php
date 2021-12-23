<?php

namespace App\Http\Controllers;

use App\Modules\Booking\Model\Booking;
use App\Modules\Contact\Model\Contact;
use App\Modules\Review\Model\Review;
use App\Modules\Villa\Model\Villa;
use Illuminate\Http\Request;

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
        // return view('home');
        $page['title'] = 'Admin | Dashboard';
        return view('admin.home',['page'=>$page]);
    }
}
