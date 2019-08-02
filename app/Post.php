<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $guarded = array('id');

    public static $rules = array(
        'image' => [
            'file',
            'image',
            'mimes:jpeg,jpg,png,gif',
        ],
        'title' => 'required|max:50',
        'text'  => 'max:500'

    );
}
