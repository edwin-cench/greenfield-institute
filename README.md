# Greenfield Institute - Course Registration Portal

A modern, full-stack web application designed to manage student registrations, course catalogs, academic transcripts, and financial ledgers for Greenfield Institute. 

## 🚀 Key Features

### Student Portal
* **Dashboard:** Browse the active course catalog and view real-time capacity limits.
* **Enrollment:** Register for or drop courses with single-click actions. Prevents duplicate registrations and enforces strict class size limits.
* **Academics:** View enrolled courses, assigned lecturers, and official grade transcripts.
* **Financials:** Track tuition charges, view payment history, and monitor outstanding balances.

### Admin Control Panel
* **Course Management:** Add new courses, assign lecturers, define class capacities, and delete outdated curriculum.
* **Student Management:** View a master list of all registered students and their unique, auto-generated Registration Numbers (e.g., `GF-2026-1234`).
* **Grading & Billing:** Post official grades directly to student transcripts and update their financial ledgers (charge/payment).
* **Access Control:** Securely elevate standard students to Admin status.

## 🛠 Architecture & Tech Stack
* **Framework:** Laravel (PHP)
* **Frontend:** Blade Templating Engine + Tailwind CSS for a fully responsive, modern UI.
* **Database:** Relational database managed via Laravel Eloquent ORM and automated Migrations.
* **Security:** Built-in CSRF protection, secure bcrypt password hashing, and strict role-based routing (Middleware).

## ⚙️ Installation & Setup Instructions

Since this is a Laravel application, setup is fast and automated.

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/edwin-cench/greenfield-institute](https://github.com/edwin-cench/greenfield-institute)
   cd Greenfield
Install dependencies:

Bash
composer install
Configure the Environment:
Copy the .env.example file to .env and set up your database connection.

Bash
cp .env.example .env
php artisan key:generate
Build the Database:
Run the migrations to automatically build all tables (users, courses, enrollments, financials, results).

Bash
php artisan migrate:fresh
Start the local server:

Bash
php artisan serve
Generate Test Data (Crucial Step):
Open your browser and visit http://localhost:8000/setup. This hidden route will seed your database with the default admin, a test student, and a sample course catalog so you can test the application immediately.

🔐 Default Login Credentials
Once the /setup route has been triggered, you can log in at http://localhost:8000/login using:

System Admin:

Email: admin@greenfield.com

Password: admin123

Test Student:

Email: student@greenfield.com

Password: password123

Developed by Edwin Muriithi Mwangi and his team as a robust three-tier educational management system.
