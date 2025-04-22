<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Organisation extends Model
{
    protected $table = 'organisations';

    protected $fillable = [
        'user_id',
        'role',
        'report_type',
        'description',
        'file_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
