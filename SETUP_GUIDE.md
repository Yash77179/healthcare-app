# Healthcare App - Setup & Configuration Guide

## Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database
- Git

### Step 1: Navigate to Project Directory
```bash
cd c:\Users\yashb\Desktop\laravel_class\healthcare-app
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install JavaScript Dependencies
```bash
npm install
```

### Step 4: Create Environment Configuration
```bash
cp .env.example .env
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

### Step 6: Configure Database
Edit the `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthcare_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database:
```bash
mysql -u root -p
CREATE DATABASE healthcare_app;
EXIT;
```

### Step 7: Run Database Migrations
```bash
php artisan migrate
```

### Step 8: (Optional) Seed Sample Data
```bash
php artisan db:seed --class=HealthcareSeeder
```

### Step 9: Generate Symbolic Link for Storage
```bash
php artisan storage:link
```

### Step 10: Build Frontend Assets
```bash
npm run build
```

## Running the Application

### Development Mode with Hot Reload

Terminal 1 - Start Laravel server:
```bash
php artisan serve
```

Terminal 2 - Start Vite development server:
```bash
npm run dev
```

Then visit: `http://localhost:8000`

### Production Mode
```bash
npm run build
php artisan serve
```

## Environment Configuration

### Key Environment Variables
```env
# Application
APP_NAME=HealthcareApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthcare_app
DB_USERNAME=root
DB_PASSWORD=

# Mail (for appointment reminders)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@healthcareapp.com

# Session
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

# Cache
CACHE_DRIVER=file
```

## Authentication Setup

The application uses Laravel Sanctum for authentication. Make sure to:

1. **Run migrations** (includes users table):
```bash
php artisan migrate
```

2. **Create admin user** (if needed):
```bash
php artisan tinker
>>> User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')])
>>> exit
```

## File Storage Configuration

Medical records and files are stored in `storage/app/public/medical_records/`. 

Make sure the storage link exists:
```bash
php artisan storage:link
```

## Database Tables Reference

### Users Table (Default Laravel)
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'doctor', 'patient'),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Common Commands

### Database Management
```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Refresh database (dangerous!)
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Specific seeder
php artisan db:seed --class=HealthcareSeeder
```

### Artisan Commands
```bash
# Clear all caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear all
php artisan optimize:clear

# Tinker (REPL)
php artisan tinker

# Create model with migration
php artisan make:model ModelName -m

# Create controller with CRUD
php artisan make:controller ControllerName -r
```

### NPM Commands
```bash
# Development with hot reload
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

## Project Structure After Setup

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
│   │   ├── User.php
│   │   ├── Patient.php
│   │   ├── Doctor.php
│   │   ├── Appointment.php
│   │   ├── Consultation.php
│   │   └── MedicalRecord.php
│   └── Providers/
├── bootstrap/
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── users_table.php (default)
│   │   ├── create_patients_table.php
│   │   ├── create_doctors_table.php
│   │   ├── create_appointments_table.php
│   │   ├── create_consultations_table.php
│   │   └── create_medical_records_table.php
│   └── seeders/
│       └── HealthcareSeeder.php
├── public/
│   ├── index.php
│   ├── css/
│   └── js/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       ├── patients/
│       ├── doctors/
│       ├── appointments/
│       ├── consultations/
│       └── medical-records/
├── routes/
│   ├── web.php (configured)
│   ├── api.php
│   └── console.php
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   └── medical_records/ (for file uploads)
│   │   └── logs/
│   └── framework/
├── tests/
│   ├── Feature/
│   └── Unit/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── vite.config.js
└── HEALTHCARE_README.md
```

## Troubleshooting

### Issue: "No such file or directory" for vendor/autoload.php
**Solution**: Run `composer install`

### Issue: Database connection error
**Solution**: 
- Verify database credentials in `.env`
- Ensure MySQL/PostgreSQL service is running
- Check database exists

### Issue: Storage link issue
**Solution**: Run `php artisan storage:link`

### Issue: Permission denied on storage
**Solution**: 
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Issue: Migrations fail
**Solution**:
```bash
php artisan migrate:fresh
php artisan migrate
```

## Testing

### Run Tests
```bash
php artisan test
```

### Run Specific Test
```bash
php artisan test --filter=TestName
```

## Deployment

### For Production:

1. **Clone repository**
```bash
git clone <repo-url>
```

2. **Install dependencies**
```bash
composer install --no-dev
npm install --production
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure production .env**
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=your_host
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

5. **Run migrations**
```bash
php artisan migrate --force
```

6. **Optimize**
```bash
php artisan optimize
php artisan config:cache
php artisan route:cache
```

7. **Setup web server** (Nginx/Apache)

## Security Checklist

- [ ] Change all default credentials
- [ ] Set APP_DEBUG=false in production
- [ ] Enable HTTPS
- [ ] Configure CORS properly
- [ ] Implement rate limiting
- [ ] Add user authentication
- [ ] Validate all user inputs
- [ ] Use prepared statements (Laravel ORM handles this)
- [ ] Implement CSRF protection (Laravel default)
- [ ] Setup backups for medical records
- [ ] Implement audit logging
- [ ] Add encryption for sensitive data

## Support & Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum Documentation](https://laravel.com/docs/sanctum)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Tailwind CSS](https://tailwindcss.com)

## Next Development Steps

1. Create Blade views and forms
2. Implement authentication UI
3. Add role-based access control
4. Create dashboard with statistics
5. Implement appointment reminders
6. Add PDF export functionality
7. Setup email notifications
8. Create API documentation
9. Add comprehensive validation
10. Implement search functionality
