<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = 'estimate';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'usage'
    ];
}
