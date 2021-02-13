<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    
    protected $attributes = [
        "categorie" => "all"
    ];
}
