<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'enrollments');
    }
}
