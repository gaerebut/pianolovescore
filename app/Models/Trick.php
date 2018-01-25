<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use App\Scopes\IsOnlineScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trick extends Model
{
    use Searchable;
    use SoftDeletes;

    protected $dates = ['created_at', 'modified_at', 'deleted_at'];
    protected $table = 'tricks';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new IsOnlineScope);
    }

    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['title', 'introduction', 'description']);
    }

    public function __toString()
    {
        return $this->title;
    }
}