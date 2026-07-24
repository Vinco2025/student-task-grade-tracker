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

**Controllers** — one per resource, all in `app/Http/Controllers/`
- `DashboardController` — role-aware dashboard routing
- `SubjectController` — full CRUD, admin-gated
- `TaskController` — nested under subjects for creation, flat for editing
- `GradeController` — bulk gradebook entry with feedback
- `SubmissionController` — file upload + deadline enforcement
- `EnrollmentController` — request/approve/reject flow
- `UserController` — admin views for student and teacher lists

**Middleware** — `app/Http/Middleware/CheckRole.php`
Variadic role syntax: `role:teacher,admin` — applied per route group

**Models** — `User`, `Subject`, `Task`, `Grade`, `Submission`, `Enrollment`
All relationships defined with Eloquent `belongsTo` / `hasMany`

**Views** — `resources/views/`
Blade templates organized by resource (`dashboard/`, `subjects/`, `tasks/`, `grades/`, `submissions/`, `users/`)
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

<img width="1365" height="604" alt="landingpage" src="https://github.com/user-attachments/assets/127f9d5f-6b4f-48bb-ada0-22edc1eb74aa" />
<img width="1009" height="580" alt="teacherdashboard" src="https://github.com/user-attachments/assets/854151dc-39d1-48e6-a889-753efaa5e3f5" />
<img width="1350" height="576" alt="admindashboard" src="https://github.com/user-attachments/assets/b96e4106-41ce-457d-807f-76f7e0615d0d" />
<img width="1347" height="597" alt="studentdashboard" src="https://github.com/user-attachments/assets/284c43bc-8bbc-4de9-bbee-e805bc8edecd" />
<img width="1286" height="559" alt="profile" src="https://github.com/user-attachments/assets/3c14ad71-d84e-4092-8c40-d5116d616853" />
<img width="1366" height="397" alt="allsubjects" src="https://github.com/user-attachments/assets/8214c464-9341-4ee4-9763-5a66adeb7647" />
<img width="1366" height="466" alt="allteacher" src="https://github.com/user-attachments/assets/10cc05db-9328-4883-9399-526cdb5bc795" />
<img width="999" height="575" alt="allstudent" src="https://github.com/user-attachments/assets/414674cc-cc92-4df4-a69b-5b61d7de6630" />
<img width="1005" height="543" alt="submitsubject" src="https://github.com/user-attachments/assets/d56dd81c-2df4-4674-827f-de847f7fd08f" />
<img width="1084" height="479" alt="subject" src="https://github.com/user-attachments/assets/4ba19fc7-6864-4d1e-a198-f7f51b880016" />
<img width="1087" height="417" alt="editsubject" src="https://github.com/user-attachments/assets/de227a70-90bd-4ca1-afa0-8d17fbab3dec" />
<img width="1188" height="438" alt="createsubject" src="https://github.com/user-attachments/assets/b0771462-bcba-4daa-916e-d5271b7c46e1" />






---

## Author

Built by Vinco as a portfolio project to demonstrate Laravel framework-level skills.
