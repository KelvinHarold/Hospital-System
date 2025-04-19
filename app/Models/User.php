<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function chatsSent()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function chatsReceived()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function pregnantRecord()
    {
        return $this->hasOne(Pregnant::class);
    }

    public function breastfeedingRecord()
    {
        return $this->hasOne(Breastfeeding::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class, 'mother_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
