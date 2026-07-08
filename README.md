# Student Task & Grade Tracker

A role-based academic management system built with Laravel 12. Designed as a portfolio project to demonstrate real-world Laravel patterns including middleware-gated routing, Eloquent relationships, form validation, file uploads, and a consistent design system.

---

## Features

### Admin
- Create and manage subjects, assign teachers
- Directly enroll students or approve/reject enrollment requests
- View all registered students and teachers
- Remove students from subjects

### Teacher
- View assigned subjects and enrolled students
- Create, edit, and delete tasks with deadlines
- Review student submissions (text and file)
- Enter scores and written feedback per student in a gradebook UI
- Blocked from grading students with no submission

### Student
- Request enrollment in available subjects
- Submit work (text + optional file attachment) before the deadline
- View grades and teacher feedback per task with pass/fail indicators
- See enrollment status (pending, approved, rejected)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2 |
| Frontend | Blade + Alpine.js (Laravel Breeze) |
| Styling | Tailwind CSS with custom design tokens |
| Typography | Inter + Fraunces via Bunny Fonts |
| Database | MySQL (via XAMPP) |
| Build Tool | Vite |
| Auth | Laravel Breeze |

---

## Design System

The UI uses a named token system defined in `tailwind.config.js`:

| Token | Hex | Usage |
|---|---|---|
| `ink` | `#1E2A45` | Primary text, buttons |
| `paper` | `#F7F6F2` | Page and card backgrounds |
| `gold` | `#C08A2E` | Accents, hover states |
| `slate` | `#5B6472` | Secondary text, borders |
| `approved` | `#2F7D5E` | Pass badges, success states |
| `marked` | `#B3441E` | Fail badges, error states, destructive actions |

---

## Local Setup

### Requirements
- PHP 8.2+
- Composer
- Node.js + npm
- MySQL (XAMPP recommended on Windows)

### Installation

```bash
git clone https://github.com/Vinco2025/student-task-grade-tracker.git
cd student-task-grade-tracker

composer install
npm install
```

Copy the environment file and generate an app key:

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:

```env
DB_DATABASE=student_tracker_db
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations and seed demo data:

```bash
php artisan migrate:fresh --seed
```

Build frontend assets:

```bash
npm run build
```

Start the development server:

```bash
php artisan serve
```

---

## Demo Accounts

All accounts use the password `password`.

| Role | Email |
|---|---|
| Admin | admin@demo.com |
| Teacher (Math & English) | reyes@demo.com |
| Teacher (Science) | santos@demo.com |
| Student (fully active) | ana@demo.com |
| Student (pending enrollment) | ben@demo.com |
| Student (rejected enrollment) | cara@demo.com |

---

## Project Structure Highlights

app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── SubjectController.php
│   │   ├── TaskController.php
│   │   ├── GradeController.php
│   │   ├── SubmissionController.php
│   │   ├── EnrollmentController.php
│   │   └── UserController.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── User.php
│   ├── Subject.php
│   ├── Task.php
│   ├── Grade.php
│   ├── Submission.php
│   └── Enrollment.php
resources/views/
├── dashboard/
│   ├── admin.blade.php
│   ├── teacher.blade.php
│   └── student.blade.php
├── subjects/
├── tasks/
├── grades/
├── submissions/
└── users/
---

## Key Patterns Demonstrated

- **Role-based middleware** — `CheckRole` middleware with variadic multi-role syntax (`role:teacher,admin`)
- **Shallow nested resources** — tasks nested under subjects for creation, flat for editing
- **Upsert logic** — `updateOrCreate` used for grades, submissions, and enrollment re-requests to prevent duplicate rows
- **Eager loading** — dashboard queries use `with()` chains to avoid N+1 problems
- **Enrollment state machine** — pending → approved/rejected flow with admin controls
- **Deadline enforcement** — submissions locked past due date at controller and UI level
- **Guard rails** — teachers blocked from grading students with no submission, both in controller and visually disabled in the gradebook

---

## Screenshots

*Coming soon*

---

## Author

Built by Vinco as a portfolio project to demonstrate Laravel framework-level skills.