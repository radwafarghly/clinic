<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillabe=[
        'name','age','gender','phone','code','card_number'
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation','product_colors','product_id','color_id');
    }
}
