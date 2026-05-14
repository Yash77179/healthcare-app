<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'consultation_id',
        'record_type',
        'record_date',
        'description',
        'findings',
        'recommendations',
        'file_path',
        'file_name',
        'visibility',
        'created_by',
    ];

    protected $casts = [
        'record_date' => 'date',
        'findings' => 'array',
        'recommendations' => 'array',
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
        return $this->belongsTo(Consultation::class);
    }
}
