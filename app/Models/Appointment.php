<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $table = 'appointments';
    protected $fillable = [
        'user_id', 'doctor_id', 'patient_name', 'appointment_date', 'status', 'notes'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
