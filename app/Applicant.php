<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
    		'career_id',
    		'branch_id',
    		'name',
    		'email',
    		'resume',
    		'message',
    		'status'
    	];
}
