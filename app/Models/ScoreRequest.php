<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoreRequest extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'modified_at', 'deleted_at'];
    protected $table = 'scores_requests';

    public function __toString()
    {
        return $this->title;
    }
}
