<?php

namespace App\Modules\Invoice\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Modules\Invoice\Model\Invoice;

class AdminInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page['title'] = 'Invoice';
        return view("Invoice::index",compact('page'));

        //
    }
    /**
     * Get datatable format json file.
     *
     *
     */

    public function getinvoicesJson(Request $request)
    {
        $invoice = new Invoice;
        $where = $this->_get_search_param($request);

        // For pagination
        $filterTotal = $invoice->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->join('users', 'invoice.practice_id', 'users.id')
            ->select('users.name', 'invoice.id', 'invoice.slug', 'invoice.issue_date', 'invoice.due_date', 'invoice.total', 'invoice.status')
            ->orderBy('invoice.id', 'DESC')->get();

        // Display limited list
        $rows = $invoice->where( function($query) use ($where) {
            if($where !== null) {
                foreach($where as $val) {
                    $query->orWhere($val[0],$val[1],$val[2]);
                }
            }
        })->join('users', 'invoice.practice_id', 'users.id')
            ->select('users.name', 'invoice.id', 'invoice.slug', 'invoice.issue_date', 'invoice.due_date', 'invoice.total', 'invoice.status')
            ->limit($request->length)->offset($request->start)->orderBy('invoice.id', 'DESC')->get();

        //To count the total values present
        $total = $invoice->get();


        echo json_encode(['draw'=>$request['draw'],'recordsTotal'=>count($total),'recordsFiltered'=>count($filterTotal),'data'=>$rows]);


    }

    /**
     *Search Params
     *
     * @return \Illuminate\Http\Response
     */


    public function _get_search_param($params)
    {
        $where = null;
        foreach ($params['columns'] as $value) {
            if($value['searchable'] == 'true'){

                if($params['search']['value'] != '')
                {
                    $where[] = [ $value['name'], 'like' , "%".$params['search']['value']."%" ];
                }

                if($value['search']['value'] != '')
                {
                }
            }
        }

        return $where;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page['title'] = 'Invoice | Create';
        return view("Invoice::add",compact('page'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $success = Invoice::Create($data);
        return redirect()->route('admin.invoices');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::where('id',$id)->with('practice', 'timesheet.booking.staff')->first();
        $page['title'] = 'Invoice | Update';
        return view("Invoice::edit",compact('page','invoice'));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');
        $success = Invoice::where('id', $request->id)->update($data);
        return redirect()->route('admin.invoices');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = Invoice::where('id', $id)->delete();
        return redirect()->route('admin.invoices');

        //
    }
}
