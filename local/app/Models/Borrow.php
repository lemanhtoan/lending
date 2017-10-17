<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
	protected $table = 'borrow';
    protected $fillable = ['uid', 'soluongthechap', 'kieuthechap', 'thoigianthechap', 'phantramlai', 'sotientoida', 'dutinhlai', 'sotiencanvay', 'ngaygiaingan', 'ngaydaohan', 'status'];

}