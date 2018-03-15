<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $fillable=[
        'type','paid','change','date_attendance',
        'date_reservation','patient_id'
    ];

    public function patients()
    {
        return $this->hasMany('App\Patient','patient_id');
    }
}
