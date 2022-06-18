<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'passport',
        'birth_date'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function citizen_companies()
    {
        return $this->hasMany(CitizenCompany::class);
    }

}
