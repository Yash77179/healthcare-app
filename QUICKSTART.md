# Healthcare Portal - Quick Start Guide

Welcome to the Healthcare Portal - a comprehensive Laravel-based healthcare management system with full CRUD operations for patients, doctors, appointments, consultations, and medical records.

## 📋 Project Overview

The Healthcare Portal is a modern, feature-rich web application built with:
- **Laravel 11** - Modern PHP web framework
- **MySQL/PostgreSQL** - Database backend
- **Blade Templating** - Server-side HTML templating
- **Tailwind CSS** - Responsive UI framework
- **Font Awesome** - Beautiful icons
- **Eloquent ORM** - Database relationships

## ✨ Key Features

### 1. **Patient Management**
- Complete patient profiles with medical history
- Emergency contact information
- Insurance details tracking
- Blood type and allergy records

### 2. **Doctor Profiles**
- Specialization and qualifications
- License tracking
- Office location and availability
- Consultation fees management

### 3. **Appointment Scheduling**
- Schedule appointments with date/time/duration
- Track appointment status (scheduled, confirmed, completed, cancelled, no-show)
- Cancel appointments with reason tracking
- View upcoming appointments

### 4. **Consultation Recording**
- Record consultations with diagnosis
- Track symptoms, treatment plans, medications
- Recommend tests and follow-ups
- Consultation type support (in-person, telehealth, video-call, phone)

### 5. **Medical Records**
- Secure medical record storage
- File upload/download capabilities
- Visibility control (private, shared with doctor, shared with patient, public)
- Findings and recommendations tracking

## 📁 File Structure

```
resources/views/
├── layouts/
│   └── app.blade.php           # Master layout template
├── dashboard.blade.php          # Dashboard with statistics
├── patients/
│   ├── index.blade.php         # List all patients
│   ├── create.blade.php        # Create/Edit patient form
│   ├── edit.blade.php          # Edit wrapper
│   └── show.blade.php          # Patient detail view
├── doctors/
│   ├── index.blade.php         # List all doctors
│   ├── create.blade.php        # Create/Edit doctor form
│   ├── edit.blade.php          # Edit wrapper
│   └── show.blade.php          # Doctor detail view
├── appointments/
│   ├── index.blade.php         # List all appointments
│   ├── create.blade.php        # Create appointment form
│   ├── edit.blade.php          # Edit wrapper
│   └── show.blade.php          # Appointment details
├── consultations/
│   ├── index.blade.php         # List all consultations
│   ├── create.blade.php        # Record consultation form
│   ├── edit.blade.php          # Edit wrapper
│   └── show.blade.php          # Consultation details
└── medical-records/
    ├── index.blade.php         # List all records
    ├── create.blade.php        # Create record form
    ├── edit.blade.php          # Edit wrapper
    └── show.blade.php          # Record details
```

## 🚀 Getting Started

### Prerequisites
- PHP 8.4+
- Composer
- MySQL or PostgreSQL
- Node.js (optional, for frontend assets)

### Installation Steps

1. **Install Composer Dependencies**
   ```bash
   cd healthcare-app
   composer install
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure Database**
   Edit `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=healthcare_portal
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Database (Optional)**
   ```bash
   php artisan db:seed --class=HealthcareSeeder
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Access the app at: `http://localhost:8000`

## 📊 Database Schema

### Patients Table
- user_id (FK)
- date_of_birth
- phone, address, city, state, postal_code, country
- blood_type
- emergency_contact, emergency_contact_phone
- insurance_provider, insurance_policy_number
- medical_history (JSON)
- allergies (JSON)
- current_medications (JSON)

### Doctors Table
- user_id (FK)
- specialization
- license_number (unique)
- phone, office_address, office details
- bio, years_of_experience
- qualifications (JSON array)
- consultation_fee
- availability_start_time, availability_end_time
- available_days (JSON array)

### Appointments Table
- patient_id (FK)
- doctor_id (FK)
- appointment_date, appointment_time
- duration_minutes
- status (enum: scheduled, confirmed, completed, cancelled, no-show)
- reason_for_visit, notes
- cancellation_reason, cancelled_at
- reminder_sent

### Consultations Table
- appointment_id (FK, nullable)
- patient_id (FK)
- doctor_id (FK)
- consultation_date, consultation_time
- diagnosis
- symptoms (JSON array)
- treatment_plan
- medications_prescribed (JSON array)
- tests_recommended (JSON array)
- follow_up_required, follow_up_date
- consultation_type (enum: in-person, telehealth, video-call, phone)
- consultation_notes

### Medical Records Table
- patient_id (FK)
- doctor_id (FK, nullable)
- consultation_id (FK, nullable)
- record_type
- record_date
- description
- findings (JSON array)
- recommendations (JSON array)
- file_path, file_name
- visibility (enum: private, shared_with_doctor, shared_with_patient, public)
- created_by (FK, nullable)

## 🔐 Authentication

The application uses **Laravel Sanctum** for authentication. All routes except the home page require authentication.

To add authentication:
1. Use Laravel Breeze or Jetstream
2. Configure the auth middleware
3. Set up user registration

## 🎨 Styling

All views use **Tailwind CSS** utility classes loaded via CDN:
```html
<script src="https://cdn.tailwindcss.com"></script>
```

Icons are provided by **Font Awesome 6.4.0**:
```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

## 📝 API Routes

### Patients
- `GET /patients` - List all patients
- `GET /patients/{id}` - View patient details
- `POST /patients` - Create new patient
- `PUT /patients/{id}` - Update patient
- `DELETE /patients/{id}` - Delete patient

### Doctors
- `GET /doctors` - List all doctors
- `GET /doctors/{id}` - View doctor details
- `POST /doctors` - Create new doctor
- `PUT /doctors/{id}` - Update doctor
- `DELETE /doctors/{id}` - Delete doctor
- `GET /doctors/search` - Search doctors by specialization

### Appointments
- `GET /appointments` - List all appointments
- `POST /appointments` - Schedule appointment
- `PUT /appointments/{id}` - Update appointment
- `DELETE /appointments/{id}` - Cancel appointment
- `POST /appointments/{id}/confirm` - Confirm appointment
- `POST /appointments/{id}/cancel` - Cancel with reason

### Consultations
- `GET /consultations` - List all consultations
- `POST /consultations` - Record new consultation
- `PUT /consultations/{id}` - Update consultation
- `DELETE /consultations/{id}` - Delete consultation

### Medical Records
- `GET /medical-records` - List all records
- `POST /medical-records` - Create new record
- `PUT /medical-records/{id}` - Update record
- `DELETE /medical-records/{id}` - Delete record
- `GET /medical-records/{id}/download` - Download record file

## 🛠️ Available Artisan Commands

```bash
# Database
php artisan migrate                    # Run migrations
php artisan migrate:rollback          # Rollback migrations
php artisan db:seed                   # Seed the database
php artisan db:seed --class=HealthcareSeeder  # Seed with test data

# Development
php artisan serve                     # Start development server
php artisan tinker                    # Interactive PHP shell

# Cache & Optimization
php artisan cache:clear              # Clear application cache
php artisan config:cache             # Cache configuration files
php artisan view:cache               # Cache views
```

## 📚 Additional Documentation

For detailed information, refer to:
- `HEALTHCARE_README.md` - Project overview and features
- `SETUP_GUIDE.md` - Detailed setup instructions
- `API_DOCUMENTATION.md` - Complete API reference

## 🐛 Troubleshooting

### Database Connection Error
- Ensure database exists
- Check `.env` credentials
- Run `php artisan migrate`

### View Not Found
- Clear view cache: `php artisan view:clear`
- Check file paths match routes

### Permission Issues
- Ensure `storage/` and `bootstrap/cache/` are writable
- Run: `chmod -R 775 storage bootstrap/cache`

### File Upload Issues
- Check `storage/app/medical_records/` directory exists
- Ensure `FILESYSTEM_DISK=local` in `.env`
- Verify write permissions on storage directory

## 📞 Support

For issues or questions:
1. Check the documentation files
2. Review the API documentation
3. Check Laravel documentation: https://laravel.com/docs

## 📄 License

This project is open-source and available under the MIT license.

---

**Happy healthcare management! 🏥**
