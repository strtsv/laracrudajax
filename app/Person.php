<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';
    protected $fillable = [
    	'first_name',
    	'last_name',
    	'address',
    	'city',
    	'postal_code',
    	'email'
    ];
}
