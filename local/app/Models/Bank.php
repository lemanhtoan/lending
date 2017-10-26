<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	protected $table = 'user_bank';
    protected $fillable = ['uid', 'bank_name', 'bank_number', 'bank_username', 'exp_month', 'exp_year', 'status'];

}