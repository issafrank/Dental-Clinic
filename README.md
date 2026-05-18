# Dental Clinic Management System

Vanilla PHP + Tailwind CSS.

## Stack
- PHP 8+ (no framework)
- MySQL / MariaDB (Laragon)
- Tailwind CSS (via CLI)
- Vanilla JS

## Folder Layout

```
capstone2/
├── public/                  # Web root (point Apache/Laragon here)
│   ├── index.php            # Front controller / router entry
│   ├── .htaccess            # Pretty URLs, route everything to index.php
│   ├── assets/
│   │   ├── css/
│   │   │   ├── input.css    # Tailwind source (with @tailwind directives)
│   │   │   └── app.css      # Compiled Tailwind output
│   │   ├── js/
│   │   │   └── app.js
│   │   ├── img/
│   │   └── uploads/         # User-uploaded files (x-rays, profile pics)
│   └── favicon.ico
│
├── app/
│   ├── Core/                # Framework-ish helpers
│   │   ├── Router.php
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   ├── Database.php
│   │   ├── Request.php
│   │   ├── Response.php
│   │   ├── Session.php
│   │   ├── Auth.php
│   │   ├── Validator.php
│   │   ├── View.php
│   │   └── Csrf.php
│   │
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── PatientController.php
│   │   ├── AppointmentController.php
│   │   ├── DentistController.php
│   │   ├── StaffController.php
│   │   ├── TreatmentController.php
│   │   ├── DentalChartController.php
│   │   ├── BillingController.php
│   │   ├── PaymentController.php
│   │   ├── InventoryController.php
│   │   ├── ServiceController.php
│   │   ├── ReportController.php
│   │   ├── SettingsController.php
│   │   └── ProfileController.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Patient.php
│   │   ├── Dentist.php
│   │   ├── Staff.php
│   │   ├── Appointment.php
│   │   ├── Treatment.php
│   │   ├── DentalChart.php
│   │   ├── Service.php
│   │   ├── Invoice.php
│   │   ├── Payment.php
│   │   ├── InventoryItem.php
│   │   ├── AuditLog.php
│   │   └── Setting.php
│   │
│   ├── Middleware/
│   │   ├── AuthMiddleware.php
│   │   ├── RoleMiddleware.php
│   │   └── CsrfMiddleware.php
│   │
│   ├── Views/
│   │   ├── layouts/
│   │   │   ├── app.php          # Authenticated layout (sidebar + topbar)
│   │   │   ├── auth.php         # Login/register layout
│   │   │   └── guest.php        # Public landing layout
│   │   ├── partials/
│   │   │   ├── sidebar.php
│   │   │   ├── topbar.php
│   │   │   ├── footer.php
│   │   │   ├── flash.php
│   │   │   └── pagination.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   ├── register.php
│   │   │   └── forgot.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── patients/
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── show.php
│   │   ├── appointments/
│   │   │   ├── index.php        # Calendar + list
│   │   │   ├── create.php
│   │   │   ├── edit.php
│   │   │   └── show.php
│   │   ├── dentists/
│   │   ├── staff/
│   │   ├── treatments/
│   │   ├── dental_chart/
│   │   │   └── show.php         # Tooth chart UI
│   │   ├── billing/
│   │   ├── payments/
│   │   ├── inventory/
│   │   ├── services/
│   │   ├── reports/
│   │   ├── settings/
│   │   ├── profile/
│   │   └── errors/
│   │       ├── 403.php
│   │       ├── 404.php
│   │       └── 500.php
│   │
│   └── Helpers/
│       ├── functions.php        # url(), asset(), e(), old(), dd()
│       └── dates.php
│
├── config/
│   ├── app.php                  # App name, url, timezone, env
│   ├── database.php             # DB credentials
│   ├── auth.php                 # Roles, guards
│   └── routes.php               # All route definitions
│
├── database/
│   ├── migrations/
│   │   ├── 001_create_users_table.sql
│   │   ├── 002_create_patients_table.sql
│   │   ├── 003_create_dentists_table.sql
│   │   ├── 004_create_appointments_table.sql
│   │   ├── 005_create_services_table.sql
│   │   ├── 006_create_treatments_table.sql
│   │   ├── 007_create_dental_charts_table.sql
│   │   ├── 008_create_invoices_table.sql
│   │   ├── 009_create_payments_table.sql
│   │   ├── 010_create_inventory_items_table.sql
│   │   └── 011_create_audit_logs_table.sql
│   ├── seeders/
│   │   ├── users_seeder.sql
│   │   └── services_seeder.sql
│   └── schema.sql               # Full schema dump
│
├── storage/
│   ├── logs/
│   │   └── app.log
│   ├── cache/
│   └── sessions/
│
├── tests/
│   └── .gitkeep
│
├── vendor/                      # (optional) composer deps if added later
│
├── .env.example
├── .gitignore
├── composer.json                # Optional, for PSR-4 autoload
├── package.json                 # Tailwind build scripts
├── tailwind.config.js
├── postcss.config.js
└── README.md
```

## Setup

1. Place project at `c:\laragon\www\capstone2`. Point Laragon document root to `public/` (or use `http://capstone2.test/public`).
2. Copy `.env.example` to `.env` and update DB credentials.
3. Create database `dental_clinic` and import `database/schema.sql`.
4. Install Tailwind:
   ```bash
   npm install
   npm run dev      # watch mode
   npm run build    # production build
   ```
5. Visit the site in the browser.

## Default Roles
- `admin` — full access
- `dentist` — appointments, patients, dental chart, treatments
- `staff` — appointments, billing, patients
- `patient` — own appointments, own records
