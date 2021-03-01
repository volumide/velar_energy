<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kva extends Model
{
    protected $table = 'kva-table';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'kva'
    ];
}
