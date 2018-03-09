<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
	protected $table = 'hash_confirm';
    protected $fillable = ['uid', 'type','hask','dataId', 'status', 'tygia'];

}