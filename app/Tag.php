<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use App\Blog;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];


    public function blogs()
    {
        return $this->belongsToMany('App\Blog');
    }

}
