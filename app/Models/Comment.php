<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'modified_at', 'deleted_at'];
    protected $table = 'comments';

    public function score()
    {
        return $this->belongsTo('App\Models\Score');
    }

    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('cat_name', 'asc');
    }

    public function __toString()
    {
        return $this->comment;
    }
}
