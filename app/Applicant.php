<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;

class Applicant extends Model
{
    protected $fillable = [
    		'career_id',
    		'branch_id',
    		'name',
    		'email',
    		'resume',
    		'message',
    		'status',
    		'file_name'
    	];
    public static $email;
    public static $info;
    public static $reminder;

    static function sendMail($email, $info, $reminder)
    {
    	self::$email = $email;
    	self::$info = $info;
    	self::$reminder = $reminder;

    	/*$data = [
    		'email' => self::$email,
    		'info' => self::$info,
    		'reminder' => self::$reminder,
    	];

    	return $data;*/
	   //sent email
        Mail::send('public.emails.compose', ['info' => self::$info], function ($message) {
            //$message->from('hello@app.com', 'Your Application');

            //$message->to('iurosales.pgkhc@gmail.com', 'Some Guy')->from('otheremail@some.com')->subject('Your Reminder!');
            $message->to(self::$email, 'Some Guy')->from('otheremail@some.com')->subject(self::$reminder);
        });
    }
}