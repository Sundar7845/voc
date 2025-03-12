<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'branch_id',
        'emp_no',
        'remarks',
        'name',
        'designation',
        'department',
        'is_active',
    ];
}
