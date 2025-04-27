<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'id_number'
        'email',
        'phone',
        'address',
        'city',
        'dob',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function healthPrograms()
    {
        return $this->belongsToMany(HealthProgram::class, 'enrollments');
    }
    public function users()
    {
    return $this->belongsToMany(User::class, 'client_user');
    }

}
