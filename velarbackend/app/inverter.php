<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inverter extends Model
{
    protected $table = 'inverter';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'hours',
        'kva',
        'inverter_price',
        'volt',
        'battery_quantity',
        'battery_amp',
        'battery_price',
        'store_price_no_solar',
        'panel_price',
        'solar_fee',
        'solar_charge',
        'store_price_with_solar',
        'panelcount',
        'solar_amp'
    ];
}
