<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];
}
