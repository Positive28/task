<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitizenCompany extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'citizen_id',
        'company_id',
        'start_date',
        'end_date'
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
