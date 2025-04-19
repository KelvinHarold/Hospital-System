<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{

    protected $table= 'pregnant';
    protected $fillable = [
        'user_id', 'full_name', 'age', 'pregnancy_week', 'expected_delivery_date', 'health_conditions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reminders()
    {
        return $this->morphMany(Reminder::class, 'target');
    }
}
