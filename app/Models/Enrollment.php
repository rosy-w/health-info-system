<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'health_program_id',
        'start_date',
        'end_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function healthProgram()
    {
        return $this->belongsTo(HealthProgram::class);
    }
}
