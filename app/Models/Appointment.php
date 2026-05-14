<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'duration_minutes',
        'status',
        'reason_for_visit',
        'notes',
        'cancellation_reason',
        'cancelled_at',
        'reminder_sent',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'time',
        'cancelled_at' => 'datetime',
        'reminder_sent' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
