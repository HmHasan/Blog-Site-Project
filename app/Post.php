<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestamps = true;
    // protected $dates = ['date_begin', 'date_end'];

    public function user()
    {
        return $this->BelongsTo('App\User');
    }
}


