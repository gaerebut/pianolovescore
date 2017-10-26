<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'scores';
}