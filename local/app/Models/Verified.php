<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verified extends Model
{
	protected $table = 'user_id';
    protected $fillable = ['uid', 'type', 'front', 'back', 'status'];

}