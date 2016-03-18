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
use Mail;

class HomesController extends Controller
{
    private $_email;
    private $_name;
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

            $this->_email = $request->email;
            $this->_name = $request->name;

            $data = [
                'career_id' => $request->career_id,
                'branch_id' => $request->branch_id,
                'name' => $this->_name,
                'email' => $this->_email,
                'message' => $request->message,
                'status' => 'unread',
                'file_name' => $request->file('resume')->getClientOriginalName(),
                'resume' => base_path() . '/public/uploads/'.$request->file('resume')->getClientOriginalName()
            ];

            $applicant = Applicant::create($data);

            //sent email
            Mail::send('public.emails.reminder', ['name' => $this->_name], function ($message) {
                //$message->from('hello@app.com', 'Your Application');

                //$message->to('iurosales.pgkhc@gmail.com', 'Some Guy')->from('otheremail@some.com')->subject('Your Reminder!');
                $message->to($this->_email, 'Some Guy')->from('otheremail@some.com')->subject('Your Reminder!');
            });

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
