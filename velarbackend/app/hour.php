<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hour extends Model
{
    protected $table = 'hours-autonomy';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'hours'
    ];
}
