<?php

namespace App\Modules\Invoice\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'invoices';
        //
    }

}
