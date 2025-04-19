<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'children';

    protected $fillable = [
        'user_id', 'name', 'birth_date', 'weight', 'height', 'head_circumference', 'notes', 'mother_id', 'mother_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'mother_id');
    }

    public function mother()
    {
        return $this->morphTo();
    }

    public function reminders()
    {
        return $this->morphMany(Reminder::class, 'target');
    }
    public function records()
{
    return $this->hasMany(ChildRecord::class);
}




}
