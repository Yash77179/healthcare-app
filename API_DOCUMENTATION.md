# Healthcare App - API Documentation

## Overview

The Healthcare App provides a comprehensive REST API for managing patient records, appointments, consultations, and medical records. All endpoints require authentication using Laravel Sanctum tokens.

## Authentication

### Getting Auth Token
```bash
POST /login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}
```

### Using Auth Token
Add the token to the Authorization header:
```
Authorization: Bearer {token}
```

## Base URL
```
http://localhost:8000/api
```

## Patient Endpoints

### List All Patients
```
GET /patients
```
**Parameters**: 
- `page` (optional): Pagination page number (default: 1)
- `per_page` (optional): Items per page (default: 15)

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "date_of_birth": "1990-05-15",
            "phone": "555-1234",
            "address": "123 Main St",
            "city": "Springfield",
            "state": "IL",
            "postal_code": "62701",
            "country": "USA",
            "blood_type": "O+",
            "emergency_contact": "Jane Doe",
            "emergency_contact_phone": "555-5678",
            "insurance_provider": "BlueCross",
            "insurance_policy_number": "POL123456",
            "medical_history": ["Hypertension", "Diabetes"],
            "allergies": ["Penicillin"],
            "current_medications": ["Lisinopril"],
            "created_at": "2026-05-04T10:00:00Z",
            "updated_at": "2026-05-04T10:00:00Z"
        }
    ],
    "pagination": {
        "total": 50,
        "per_page": 15,
        "current_page": 1,
        "last_page": 4
    }
}
```

### Create Patient
```
POST /patients
Content-Type: application/json

{
    "date_of_birth": "1990-05-15",
    "phone": "555-1234",
    "address": "123 Main St",
    "city": "Springfield",
    "state": "IL",
    "postal_code": "62701",
    "country": "USA",
    "blood_type": "O+",
    "emergency_contact": "Jane Doe",
    "emergency_contact_phone": "555-5678",
    "insurance_provider": "BlueCross",
    "insurance_policy_number": "POL123456",
    "medical_history": "Hypertension, Diabetes",
    "allergies": "Penicillin",
    "current_medications": "Lisinopril"
}
```

### Get Patient Details
```
GET /patients/{id}
```

### Update Patient
```
PUT /patients/{id}
Content-Type: application/json

{
    "phone": "555-9999",
    "address": "456 Oak Ave",
    // ... other fields
}
```

### Delete Patient
```
DELETE /patients/{id}
```

### Get Patient's Medical Records
```
GET /patients/{id}/medical-records
```

### Get Patient's Appointments
```
GET /patients/{id}/appointments
```

### Get Patient's Consultations
```
GET /patients/{id}/consultations
```

---

## Doctor Endpoints

### List All Doctors
```
GET /doctors
```

**Response**:
```json
{
    "data": [
        {
            "id": 1,
            "user_id": 3,
            "specialization": "Cardiology",
            "license_number": "LIC123456",
            "phone": "555-4321",
            "office_address": "789 Medical Plaza",
            "office_city": "Springfield",
            "office_state": "IL",
            "office_postal_code": "62701",
            "office_country": "USA",
            "bio": "Experienced cardiologist with 15 years of practice",
            "years_of_experience": 15,
            "qualifications": ["MD", "Board Certified"],
            "consultation_fee": 150,
            "availability_start_time": "08:00",
            "availability_end_time": "17:00",
            "available_days": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "created_at": "2026-05-04T10:00:00Z",
            "updated_at": "2026-05-04T10:00:00Z"
        }
    ],
    "pagination": {
        "total": 10,
        "per_page": 15,
        "current_page": 1,
        "last_page": 1
    }
}
```

### Create Doctor
```
POST /doctors
Content-Type: application/json

{
    "specialization": "Cardiology",
    "license_number": "LIC123456",
    "phone": "555-4321",
    "office_address": "789 Medical Plaza",
    "office_city": "Springfield",
    "office_state": "IL",
    "office_postal_code": "62701",
    "office_country": "USA",
    "bio": "Experienced cardiologist",
    "years_of_experience": 15,
    "qualifications": "MD, Board Certified",
    "consultation_fee": 150,
    "availability_start_time": "08:00",
    "availability_end_time": "17:00",
    "available_days": "Monday,Tuesday,Wednesday,Thursday,Friday"
}
```

### Get Doctor Details
```
GET /doctors/{id}
```

### Update Doctor
```
PUT /doctors/{id}
Content-Type: application/json

{
    "consultation_fee": 200,
    // ... other fields
}
```

### Delete Doctor
```
DELETE /doctors/{id}
```

### Get Doctor's Appointments
```
GET /doctors/{id}/appointments
```

### Get Doctor's Consultations
```
GET /doctors/{id}/consultations
```

### Search Doctors by Specialization
```
GET /doctors/search?specialization=Cardiology
```

---

## Appointment Endpoints

### List All Appointments
```
GET /appointments
```

### Create Appointment
```
POST /appointments
Content-Type: application/json

{
    "patient_id": 1,
    "doctor_id": 1,
    "appointment_date": "2026-06-15",
    "appointment_time": "10:00",
    "duration_minutes": 30,
    "reason_for_visit": "Routine checkup",
    "notes": "Patient has been experiencing headaches"
}
```

### Get Appointment Details
```
GET /appointments/{id}
```

### Update Appointment
```
PUT /appointments/{id}
Content-Type: application/json

{
    "appointment_time": "14:00",
    "status": "confirmed",
    "notes": "Rescheduled to 2 PM"
}
```

### Delete Appointment
```
DELETE /appointments/{id}
```

### Confirm Appointment
```
POST /appointments/{id}/confirm
```

### Cancel Appointment
```
POST /appointments/{id}/cancel
Content-Type: application/json

{
    "cancellation_reason": "Patient requested to reschedule"
}
```

### Get Upcoming Appointments for Patient
```
GET /appointments/upcoming?patient_id={id}
```

### Get Upcoming Appointments for Doctor
```
GET /appointments/upcoming?doctor_id={id}
```

---

## Consultation Endpoints

### List All Consultations
```
GET /consultations
```

### Create Consultation
```
POST /consultations
Content-Type: application/json

{
    "appointment_id": 1,
    "patient_id": 1,
    "doctor_id": 1,
    "consultation_date": "2026-06-15",
    "consultation_time": "10:00",
    "diagnosis": "Hypertension Stage 1",
    "symptoms": "High blood pressure, headaches",
    "treatment_plan": "Start antihypertensive medication",
    "medications_prescribed": "Lisinopril 10mg daily",
    "tests_recommended": "Blood test, ECG",
    "follow_up_required": true,
    "follow_up_date": "2026-07-15",
    "consultation_type": "in-person",
    "consultation_notes": "Patient educated about lifestyle changes"
}
```

### Get Consultation Details
```
GET /consultations/{id}
```

### Update Consultation
```
PUT /consultations/{id}
Content-Type: application/json

{
    "diagnosis": "Hypertension Stage 2",
    "treatment_plan": "Increase medication dosage"
}
```

### Delete Consultation
```
DELETE /consultations/{id}
```

### Get Patient Consultation History
```
GET /consultations/history/patient/{patient_id}
```

### Get Doctor Consultation History
```
GET /consultations/history/doctor/{doctor_id}
```

---

## Medical Record Endpoints

### List All Medical Records
```
GET /medical-records
```

### Create Medical Record
```
POST /medical-records
Content-Type: multipart/form-data

{
    "patient_id": 1,
    "doctor_id": 1,
    "consultation_id": 1,
    "record_type": "Lab Result",
    "record_date": "2026-06-15",
    "description": "Blood test results",
    "findings": "Slightly elevated cholesterol",
    "recommendations": "Reduce fatty foods intake",
    "file": <binary file>,
    "visibility": "shared_with_patient"
}
```

### Get Medical Record Details
```
GET /medical-records/{id}
```

### Update Medical Record
```
PUT /medical-records/{id}
Content-Type: multipart/form-data

{
    "description": "Updated blood test results",
    "visibility": "shared_with_doctor"
}
```

### Delete Medical Record
```
DELETE /medical-records/{id}
```

### Get Patient's Medical Records
```
GET /medical-records/patient/{patient_id}
```

### Download Medical Record File
```
GET /medical-records/{id}/download
```

---

## Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Request successful |
| 201 | Created - Resource created successfully |
| 204 | No Content - Request successful, no content to return |
| 400 | Bad Request - Invalid request parameters |
| 401 | Unauthorized - Missing or invalid authentication |
| 403 | Forbidden - User doesn't have permission |
| 404 | Not Found - Resource not found |
| 422 | Unprocessable Entity - Validation error |
| 500 | Internal Server Error - Server error |

---

## Error Response Format

```json
{
    "message": "Error message",
    "errors": {
        "field_name": ["Error description"]
    }
}
```

## Validation Rules

### Patient Fields
- `date_of_birth`: required, date format
- `phone`: required, string, max 20 characters
- `address`: required, string
- `city`: required, string
- `state`: required, string
- `postal_code`: required, string
- `country`: required, string
- `blood_type`: optional, string
- `emergency_contact`: required, string
- `emergency_contact_phone`: required, string
- `insurance_provider`: optional, string
- `insurance_policy_number`: optional, string

### Doctor Fields
- `specialization`: required, string
- `license_number`: required, unique string
- `phone`: required, string, max 20 characters
- `office_address`: required, string
- `office_city`: required, string
- `office_state`: required, string
- `office_postal_code`: required, string
- `office_country`: required, string
- `consultation_fee`: optional, numeric, min 0

### Appointment Fields
- `patient_id`: required, exists in patients table
- `doctor_id`: required, exists in doctors table
- `appointment_date`: required, date, after today
- `appointment_time`: required, time format (HH:MM)
- `duration_minutes`: required, integer, 15-480
- `reason_for_visit`: required, string

### Consultation Fields
- `patient_id`: required, exists in patients table
- `doctor_id`: required, exists in doctors table
- `consultation_date`: required, date
- `consultation_time`: required, time format
- `consultation_type`: required, one of: in-person, telehealth, video-call, phone

### Medical Record Fields
- `patient_id`: required, exists in patients table
- `record_type`: required, string
- `record_date`: required, date
- `file`: optional, file, mimes: pdf,doc,docx,jpg,jpeg,png, max 10MB

---

## Rate Limiting

API requests are rate limited to:
- 60 requests per minute for authenticated users
- 10 requests per minute for unauthenticated users

When rate limit is exceeded, a 429 (Too Many Requests) status code is returned.

---

## Pagination

List endpoints return paginated results:
```json
{
    "data": [...],
    "links": {
        "first": "http://localhost:8000/api/patients?page=1",
        "last": "http://localhost:8000/api/patients?page=4",
        "prev": "http://localhost:8000/api/patients?page=1",
        "next": "http://localhost:8000/api/patients?page=3"
    },
    "meta": {
        "current_page": 2,
        "from": 16,
        "last_page": 4,
        "path": "http://localhost:8000/api/patients",
        "per_page": 15,
        "to": 30,
        "total": 50
    }
}
```

---

## Common Examples

### Schedule an Appointment
```bash
curl -X POST http://localhost:8000/api/appointments \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "patient_id": 1,
    "doctor_id": 1,
    "appointment_date": "2026-06-20",
    "appointment_time": "14:00",
    "duration_minutes": 30,
    "reason_for_visit": "Follow-up consultation"
  }'
```

### Create Consultation from Appointment
```bash
curl -X POST http://localhost:8000/api/consultations \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "appointment_id": 1,
    "patient_id": 1,
    "doctor_id": 1,
    "consultation_date": "2026-06-20",
    "consultation_time": "14:00",
    "diagnosis": "Improved condition",
    "consultation_type": "in-person",
    "notes": "Patient responding well to treatment"
  }'
```

### Upload Medical Record
```bash
curl -X POST http://localhost:8000/api/medical-records \
  -H "Authorization: Bearer {token}" \
  -F "patient_id=1" \
  -F "doctor_id=1" \
  -F "record_type=Lab Result" \
  -F "record_date=2026-06-20" \
  -F "file=@/path/to/lab_results.pdf" \
  -F "visibility=shared_with_patient"
```

---

## Support

For API issues or questions, contact the development team or check the main [HEALTHCARE_README.md](HEALTHCARE_README.md).
