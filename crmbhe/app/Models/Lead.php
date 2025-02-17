<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
 // Explicitly define the table name
    protected $table = 'leads';
        // Add 'name' (and other attributes) to the fillable array
    protected $fillable = ['name', 'contact_number', 'email','status', 'assigned_to']; 
}
