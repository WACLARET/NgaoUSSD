<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ussd;
use App\Http\Resources\Ussddata;

class NgaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //This shows all the data in the database 
    public function index()
    {
       $ngao = Ussd::paginate(15);
       //Return collection of articles as a resource
       return Ussddata::collection( $ngao);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $ngao = $request->isMethod('put') ? Ussddata::findOrFail($request->customeridnumber) : new Ussd;

        // $ngao->ngao_id = $request->input('ngao_id');
        $ngao->customeridnumber = $request->input('customeridnumber');
        $ngao->customermobilenumber = $request->input('customermobilenumber');
        $ngao->loanproduct = $request->input('loanproduct');
        $ngao->loanamount = $request->input('loanamount');
        $ngao->loanterm = $request->input('loanterm');
        $ngao->customerfullnames = $request->input('customerfullnames');
        $ngao->loanapplicationdate = $request->input('loanapplicationdate');

        if($ngao->save()){
            return response()->json([
                'responsecode' => '200',
                'response' => 'Success',
                'status' => 'Processing'

            ]);
        }
        if(!$ngao->save()){
            return response()->json([
                'responsecode' => '-1',
                'response' => 'Failed',
                'status' => 'Pending loan application'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Shows specific data in the DB
    public function show($id)
    {
        $ngao = Ussd::findOrFail($id);

        //returns a single data in DB
        return new Ussddata($ngao);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        $ngao = Ussd::findOrFail($id);

        if($ngao->delete()){

        return new Ussddata($ngao);
        }
    }
}
