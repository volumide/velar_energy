<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loadcategory extends Model
{
    protected $table = 'load-types';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'loatypes'
    ];
}
