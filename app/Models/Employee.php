<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    //update
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'designation', 'salary', 'status', 'image', 'company_id'];




    public static $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'phone' => 'required|string|max:20',
        'designation' => 'required|string|max:255',
        'status' => 'required',
        'salary' => 'required', 'numeric',
        'company_id' => 'required',

        // 'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',

    ];
}
