<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
        // Add 'name' (and other attributes) to the fillable array
    protected $fillable = ['name', 'contact_number', 'email','status']; 
}
