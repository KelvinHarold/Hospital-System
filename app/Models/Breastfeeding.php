<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breastfeeding extends Model
{
    protected $table = 'breastfeeding';
    protected $fillable = [
        'user_id', 'full_name', 'age', 'breastfeeding_stage', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children()
    {
        return $this->morphMany(Child::class, 'mother');
    }

    public function reminders()
    {
        return $this->morphMany(Reminder::class, 'target');
    }
}

