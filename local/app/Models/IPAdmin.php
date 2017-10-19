<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPAdmin extends Model
{
	protected $table = 'admin_ip';
    protected $fillable = ['ip', 'status'];

}