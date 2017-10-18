<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invest extends Model
{
	protected $table = 'invest';
    protected $fillable = ['uid', 'borrowId', 'status'];

}