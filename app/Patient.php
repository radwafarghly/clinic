<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable=[
        'name','age','gender','phone','card_number',
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation','patient_id');
    }
}
