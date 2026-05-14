<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\MedicalRecord;

class HealthcareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create patients
        $patientUsers = User::factory(5)->create(['role' => 'patient']);
        foreach ($patientUsers as $user) {
            Patient::create([
                'user_id' => $user->id,
                'date_of_birth' => now()->subYears(rand(18, 80))->toDateString(),
                'phone' => '555-' . rand(1000, 9999),
                'address' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => fake()->state(),
                'postal_code' => fake()->postcode(),
                'country' => fake()->country(),
                'blood_type' => fake()->randomElement(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']),
                'emergency_contact' => fake()->name(),
                'emergency_contact_phone' => '555-' . rand(1000, 9999),
                'insurance_provider' => fake()->randomElement(['BlueCross', 'Aetna', 'United Healthcare']),
                'insurance_policy_number' => 'POL' . rand(100000, 999999),
                'medical_history' => ['Hypertension', 'Diabetes'],
                'allergies' => ['Penicillin', 'Sulfa drugs'],
                'current_medications' => ['Lisinopril', 'Metformin'],
            ]);
        }

        // Create doctors
        $doctorUsers = User::factory(3)->create(['role' => 'doctor']);
        foreach ($doctorUsers as $user) {
            Doctor::create([
                'user_id' => $user->id,
                'specialization' => fake()->randomElement(['Cardiology', 'Neurology', 'Orthopedics', 'Pediatrics']),
                'license_number' => 'LIC' . rand(100000, 999999),
                'phone' => '555-' . rand(1000, 9999),
                'office_address' => fake()->streetAddress(),
                'office_city' => fake()->city(),
                'office_state' => fake()->state(),
                'office_postal_code' => fake()->postcode(),
                'office_country' => fake()->country(),
                'bio' => fake()->sentence(20),
                'years_of_experience' => rand(2, 30),
                'qualifications' => ['MD', 'Board Certified'],
                'consultation_fee' => rand(50, 200),
                'availability_start_time' => '08:00',
                'availability_end_time' => '17:00',
                'available_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            ]);
        }

        // Create appointments
        $patients = Patient::all();
        $doctors = Doctor::all();
        foreach (range(1, 10) as $i) {
            Appointment::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'appointment_date' => now()->addDays(rand(1, 30))->toDateString(),
                'appointment_time' => fake()->time('H:i'),
                'duration_minutes' => 30,
                'status' => fake()->randomElement(['scheduled', 'confirmed']),
                'reason_for_visit' => fake()->sentence(),
                'notes' => fake()->sentence(),
            ]);
        }

        // Create consultations
        $appointments = Appointment::all();
        foreach ($appointments->take(5) as $appointment) {
            Consultation::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'consultation_date' => now()->subDays(rand(1, 30))->toDateString(),
                'consultation_time' => fake()->time('H:i'),
                'diagnosis' => fake()->sentence(),
                'symptoms' => ['Fever', 'Cough', 'Fatigue'],
                'treatment_plan' => fake()->sentence(10),
                'medications_prescribed' => ['Aspirin', 'Ibuprofen'],
                'tests_recommended' => ['Blood test', 'X-ray'],
                'follow_up_required' => fake()->boolean(),
                'follow_up_date' => fake()->boolean() ? now()->addDays(rand(1, 30))->toDateString() : null,
                'consultation_type' => fake()->randomElement(['in-person', 'telehealth', 'video-call', 'phone']),
                'consultation_notes' => fake()->sentence(20),
            ]);
        }

        // Create medical records
        $consultations = Consultation::all();
        foreach ($consultations as $consultation) {
            MedicalRecord::create([
                'patient_id' => $consultation->patient_id,
                'doctor_id' => $consultation->doctor_id,
                'consultation_id' => $consultation->id,
                'record_type' => fake()->randomElement(['Lab Result', 'X-Ray', 'Prescription', 'Diagnosis']),
                'record_date' => now()->subDays(rand(1, 30))->toDateString(),
                'description' => fake()->sentence(15),
                'findings' => ['Normal', 'Slightly elevated'],
                'recommendations' => ['Continue current treatment', 'Follow up in 2 weeks'],
                'visibility' => fake()->randomElement(['private', 'shared_with_doctor', 'shared_with_patient']),
                'created_by' => $consultation->doctor_id,
            ]);
        }
    }
}
