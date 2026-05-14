<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'patient_id',
        'doctor_id',
        'consultation_date',
        'consultation_time',
        'diagnosis',
        'symptoms',
        'treatment_plan',
        'medications_prescribed',
        'tests_recommended',
        'follow_up_required',
        'follow_up_date',
        'notes',
        'consultation_type',
        'consultation_notes',
    ];

    protected $casts = [
        'consultation_date' => 'date',
        'consultation_time' => 'time',
        'follow_up_date' => 'date',
        'follow_up_required' => 'boolean',
        'symptoms' => 'array',
        'medications_prescribed' => 'array',
        'tests_recommended' => 'array',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
