<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class load extends Model
{
    protected $table = 'items';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'type',
        'watts'
    ];
}
