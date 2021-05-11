<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pacientes extends Model
{
    use SoftDeletes;
    protected $dates = ['data_nasc','deleted_at'];

}
