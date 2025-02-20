<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
 // Explicitly define the table name
    protected $table = 'assignments';
    protected $fillable = ['lead_id', 'counselor_id', 'assigned_by']; 
}
