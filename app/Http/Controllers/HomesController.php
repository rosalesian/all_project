<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Career;
use App\Branch;
use \Input as Input;
use Response;
use App\Applicant;

class HomesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::all();
        $careers_list = Career::lists('title', 'id');
        $branch_list = Branch::lists('branch_name' ,'id');
        return view('public.homes.index', compact('careers', 'careers_list', 'branch_list'));
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
        $data = [];
       
        if($request->hasFile('resume')) {

            $file = $request->file('resume');
            $file->move('uploads', $file->getClientOriginalName());

            $data = [
                'career_id' => $request->career_id,
                'branch_id' => $request->branch_id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'status' => 'unread',
                'file_name' => $request->file('resume')->getClientOriginalName(),
                'resume' => base_path() . '/public/uploads/'.$request->file('resume')->getClientOriginalName()
            ];

            $applicant = Applicant::create($data);
        }

        $careers = Career::all();
        $careers_list = Career::lists('title', 'id');
        $branch_list = Branch::lists('branch_name' ,'id');
        return view('public.homes.index', compact('careers', 'careers_list', 'branch_list'));
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
        //
    }
}
