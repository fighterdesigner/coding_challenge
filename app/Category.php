<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    protected $attributes = [
        'category_id' => 0
    ];
    
}
