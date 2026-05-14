<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'license_number',
        'phone',
        'office_address',
        'office_city',
        'office_state',
        'office_postal_code',
        'office_country',
        'bio',
        'years_of_experience',
        'qualifications',
        'consultation_fee',
        'availability_start_time',
        'availability_end_time',
        'available_days',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'available_days' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
