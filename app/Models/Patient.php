<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'blood_type',
        'emergency_contact',
        'emergency_contact_phone',
        'insurance_provider',
        'insurance_policy_number',
        'medical_history',
        'allergies',
        'current_medications',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'medical_history' => 'array',
        'allergies' => 'array',
        'current_medications' => 'array',
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

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
