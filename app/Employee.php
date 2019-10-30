<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    	'name','email','phone','address','salary','joining_date','nid','photo',
    ];
}
