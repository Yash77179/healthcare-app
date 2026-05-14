# Integrated Health Care App/Portal

A comprehensive Laravel-based healthcare management system for managing patient records, appointments, consultations, and medical records.

## Features

### 1. **Patient Management**
- Patient registration and profile management
- Complete patient medical history
- Emergency contact information
- Insurance details
- Allergy and medication tracking
- Medical records storage

### 2. **Doctor Management**
- Doctor registration and profile
- Specialization tracking
- License management
- Consultation fees
- Availability scheduling
- Professional qualifications

### 3. **Appointment System**
- Schedule appointments with doctors
- Multiple appointment statuses (scheduled, confirmed, completed, cancelled, no-show)
- Appointment reminders
- Cancellation management
- Appointment duration tracking
- Reason for visit documentation

### 4. **Consultations**
- Record consultation details
- Multiple consultation types (in-person, telehealth, video-call, phone)
- Diagnosis and treatment plans
- Medication prescriptions
- Recommended tests
- Follow-up scheduling
- Consultation notes

### 5. **Medical Records**
- Store patient medical records
- File upload support (PDF, DOC, DOCX, JPG, PNG)
- Record categorization
- Finding and recommendations
- Visibility control (private, shared with doctor, shared with patient, public)
- Record history tracking

## Project Structure

```
healthcare-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PatientController.php
│   │   │   ├── DoctorController.php
│   │   │   ├── AppointmentController.php
│   │   │   ├── ConsultationController.php
│   │   │   └── MedicalRecordController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── Patient.php
│   │   ├── Doctor.php
│   │   ├── Appointment.php
│   │   ├── Consultation.php
│   │   └── MedicalRecord.php
│   └── Providers/
├── database/
│   ├── migrations/
│   │   ├── create_patients_table.php
│   │   ├── create_doctors_table.php
│   │   ├── create_appointments_table.php
│   │   ├── create_consultations_table.php
│   │   └── create_medical_records_table.php
│   └── seeders/
├── routes/
│   ├── web.php
│   └── api.php
├── resources/
│   ├── views/
│   │   ├── patients/
│   │   ├── doctors/
│   │   ├── appointments/
│   │   ├── consultations/
│   │   └── medical-records/
│   └── css/
└── storage/
    └── app/
        └── public/
            └── medical_records/
```

## Database Schema

### Patients Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `date_of_birth` - Patient's date of birth
- `phone` - Contact phone number
- `address`, `city`, `state`, `postal_code`, `country` - Address details
- `blood_type` - Blood type
- `emergency_contact` - Emergency contact name
- `emergency_contact_phone` - Emergency contact phone
- `insurance_provider` - Insurance company name
- `insurance_policy_number` - Policy number
- `medical_history` - JSON array of medical conditions
- `allergies` - JSON array of allergies
- `current_medications` - JSON array of medications

### Doctors Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `specialization` - Medical specialization
- `license_number` - Unique medical license
- `phone` - Office phone
- `office_address`, `office_city`, `office_state`, `office_postal_code`, `office_country` - Office location
- `bio` - Professional bio
- `years_of_experience` - Years in practice
- `qualifications` - JSON array of qualifications
- `consultation_fee` - Fee per consultation
- `availability_start_time` - Daily start time
- `availability_end_time` - Daily end time
- `available_days` - JSON array of available days

### Appointments Table
- `id` - Primary key
- `patient_id` - Foreign key to patients table
- `doctor_id` - Foreign key to doctors table
- `appointment_date` - Date of appointment
- `appointment_time` - Time of appointment
- `duration_minutes` - Duration in minutes
- `status` - Status (scheduled, confirmed, completed, cancelled, no-show)
- `reason_for_visit` - Reason for the appointment
- `notes` - Additional notes
- `cancellation_reason` - Reason if cancelled
- `cancelled_at` - Cancellation timestamp
- `reminder_sent` - Boolean for reminder status

### Consultations Table
- `id` - Primary key
- `appointment_id` - Foreign key to appointments table (nullable)
- `patient_id` - Foreign key to patients table
- `doctor_id` - Foreign key to doctors table
- `consultation_date` - Consultation date
- `consultation_time` - Consultation time
- `diagnosis` - Doctor's diagnosis
- `symptoms` - JSON array of symptoms
- `treatment_plan` - Treatment plan details
- `medications_prescribed` - JSON array of medications
- `tests_recommended` - JSON array of recommended tests
- `follow_up_required` - Boolean for follow-up
- `follow_up_date` - Date for follow-up
- `consultation_type` - Type (in-person, telehealth, video-call, phone)
- `consultation_notes` - Detailed consultation notes

### Medical Records Table
- `id` - Primary key
- `patient_id` - Foreign key to patients table
- `doctor_id` - Foreign key to doctors table (nullable)
- `consultation_id` - Foreign key to consultations table (nullable)
- `record_type` - Type of record
- `record_date` - Date of record
- `description` - Record description
- `findings` - JSON array of findings
- `recommendations` - JSON array of recommendations
- `file_path` - Path to uploaded file
- `file_name` - Name of uploaded file
- `visibility` - Visibility level
- `created_by` - Foreign key to users table

## Installation

1. **Clone or navigate to the project**
   ```bash
   cd healthcare-app
   ```

2. **Install composer dependencies**
   ```bash
   composer install
   ```

3. **Install npm dependencies**
   ```bash
   npm install
   ```

4. **Create .env file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Configure database**
   - Update `.env` with database credentials
   - Create a new database

7. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

## Usage

### Running the application

```bash
php artisan serve
```

Then visit `http://localhost:8000` in your browser.

### For development with hot reload

```bash
npm run dev
```

In another terminal:

```bash
php artisan serve
```

## API Routes

All routes are protected by authentication middleware.

### Patients
- `GET /patients` - List all patients
- `POST /patients` - Create new patient
- `GET /patients/{id}` - View patient details
- `PUT /patients/{id}` - Update patient
- `DELETE /patients/{id}` - Delete patient
- `GET /patients/{id}/medical-records` - View patient's medical records
- `GET /patients/{id}/appointments` - View patient's appointments
- `GET /patients/{id}/consultations` - View patient's consultations

### Doctors
- `GET /doctors` - List all doctors
- `POST /doctors` - Create new doctor
- `GET /doctors/{id}` - View doctor details
- `PUT /doctors/{id}` - Update doctor
- `DELETE /doctors/{id}` - Delete doctor
- `GET /doctors/{id}/appointments` - View doctor's appointments
- `GET /doctors/{id}/consultations` - View doctor's consultations
- `GET /doctors/search?specialization=...` - Search doctors by specialization

### Appointments
- `GET /appointments` - List all appointments
- `POST /appointments` - Create new appointment
- `GET /appointments/{id}` - View appointment details
- `PUT /appointments/{id}` - Update appointment
- `DELETE /appointments/{id}` - Delete appointment
- `POST /appointments/{id}/confirm` - Confirm appointment
- `POST /appointments/{id}/cancel` - Cancel appointment

### Consultations
- `GET /consultations` - List all consultations
- `POST /consultations` - Create new consultation
- `GET /consultations/{id}` - View consultation details
- `PUT /consultations/{id}` - Update consultation
- `DELETE /consultations/{id}` - Delete consultation
- `GET /patients/{id}/consultations/history` - Get patient consultation history
- `GET /doctors/{id}/consultations/history` - Get doctor consultation history

### Medical Records
- `GET /medical-records` - List all medical records
- `POST /medical-records` - Create new medical record
- `GET /medical-records/{id}` - View medical record details
- `PUT /medical-records/{id}` - Update medical record
- `DELETE /medical-records/{id}` - Delete medical record
- `GET /medical-records/{id}/download` - Download medical record file
- `GET /patients/{id}/medical-records` - Get patient's medical records

## Models & Relationships

### Patient
- One-to-Many: Appointments
- One-to-Many: Consultations
- One-to-Many: Medical Records
- One-to-One: User

### Doctor
- One-to-Many: Appointments
- One-to-Many: Consultations
- One-to-One: User

### Appointment
- Many-to-One: Patient
- Many-to-One: Doctor
- One-to-Many: Consultations

### Consultation
- Many-to-One: Patient
- Many-to-One: Doctor
- Many-to-One: Appointment
- One-to-Many: Medical Records

### MedicalRecord
- Many-to-One: Patient
- Many-to-One: Doctor
- Many-to-One: Consultation

## Next Steps

1. **Create Blade views** for all CRUD operations
2. **Set up authentication** with roles (Admin, Doctor, Patient)
3. **Implement PDF export** for medical records
4. **Add appointment reminders** via email/SMS
5. **Create dashboard** for statistics and analytics
6. **Implement payment system** for consultation fees
7. **Add notifications** for appointments and consultations
8. **Create API documentation** using Swagger/OpenAPI
9. **Implement file encryption** for sensitive medical records
10. **Add audit logging** for HIPAA compliance

## Security Considerations

- Implement role-based access control (RBAC)
- Encrypt sensitive medical data
- Use HTTPS for all communications
- Implement audit logging for HIPAA compliance
- Validate and sanitize all user inputs
- Use database transactions for data integrity
- Implement rate limiting for API endpoints
- Store medical records securely with backups

## Technologies Used

- **Framework**: Laravel 11
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Build Tool**: Vite
- **Package Manager**: Composer & NPM
- **Authentication**: Laravel Sanctum

## License

This project is licensed under the MIT License.

## Support

For issues and questions, please create an issue in the repository or contact the development team.
