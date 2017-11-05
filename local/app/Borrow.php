<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['uid', 'soluongthechap', 'kieuthechap', 'thoigianthechap', 'phantramlai', 'sotientoida', 'dutinhlai', 'sotiencanvay', 'ngaygiaingan', 'ngaydaohan', 'status'];

}