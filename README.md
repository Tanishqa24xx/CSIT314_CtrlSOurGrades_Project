# Volunteer Management Platform

A multi-user web platform built for CSIT314 (Software Development Methodologies) at the University of Wollongong / SIM. Implements a full **Boundary–Controller–Entity (BCE)** architecture with role-based access control (RBAC), server-side validation, and automated CI/CD via GitHub Actions.

---

## Screenshots

### Login
> Clean credential form. Role is resolved server-side on login — no client-side role exposure.
<p align="center"> 
   <img width="300" alt="login" src="https://github.com/user-attachments/assets/8c4a8288-0410-4dcc-92c4-e6bf50feb96b" />
</p>

### User Profile List (Admin view)
> Search bar filters profiles in real time. Each row exposes View / Update / Suspend actions based on the logged-in role.
<p align="center">
  <img width="300" alt="image" src="https://github.com/user-attachments/assets/36db1345-32f6-4dbe-aad8-c9aeac32a4aa" />
</p>

### Create & Update Forms
> Server-side validation rejects empty fields, duplicate usernames, and weak passwords before any DB write.
<p align="center">
  <img width="300" alt="create-profile" src="https://github.com/user-attachments/assets/6277707c-f78d-461a-aaf7-8ec19820161f" />
  <img width="300" alt="update-profile" src="https://github.com/user-attachments/assets/3a65f82e-8da9-4c44-9904-df39dfb2dc5b" />
  <img width="300" alt="create-request" src="https://github.com/user-attachments/assets/4f67b2fe-8e58-49e3-8bf0-c21ee764d474" />
</p>

---

## Architecture

```
Boundary (UI)  →  Controller  →  Entity  →  MySQL (XAMPP)
                      ↑
               DBConnection.php
```

The project strictly separates concerns across three layers:

| Layer | Folder | Responsibility |
|---|---|---|
| **Boundary** | `src/boundaries/` | Render HTML forms and menus; forward user input to controllers |
| **Controller** | `src/controllers/` | Validate input server-side; orchestrate entity operations |
| **Entity** | `src/entities/` | Data models; all direct DB queries live here |
| **Config** | `src/config/` | Single `DBConnection.php` — one place to manage credentials |

---

## Features

- **RBAC** — Admin and Volunteer roles with separate menus and access paths
- **User profile lifecycle** — Create, search, view, update, and suspend profiles
- **Server-side validation** — All input validated in the controller layer before any DB interaction
- **Suspend workflow** — Confirmation pop-up before suspending an account or profile; no accidental state change
- **CI/CD pipeline** — GitHub Actions runs PHPUnit on every push to `main`; deployment guide printed on success
- **UML documentation** — Use Case, Sequence, Class, and ER diagrams included

---

## Tech Stack

| | |
|---|---|
| Language | PHP 8.2 |
| Database | MySQL via XAMPP |
| Frontend | Vanilla HTML + JavaScript |
| Testing | PHPUnit |
| CI/CD | GitHub Actions |
| Architecture | Boundary–Controller–Entity (BCE) |

---

## Project Structure

```
src/
├── boundaries/
│   ├── Login.php
│   ├── UserAdminMenu.php
│   ├── UserProfileList.php
│   ├── UserProfileCreateForm.php
│   ├── UserProfileUpdateForm.php
│   ├── ViewUserProfile.php
│   ├── SuspendUserAccountConfirmationPopUp.php
│   └── SuspendUserprofileConfirmationPopup.php
├── controllers/
│   ├── LoginController.php
│   ├── CreateUserProfileController.php
│   ├── SearchUserProfilesController.php
│   ├── ViewUserProfileController.php
│   ├── UpdateUserProfileController.php
│   └── SuspendUserProfileController.php
├── entities/
│   ├── UserAccount.php
│   └── UserProfile.php
└── config/
    └── DBConnection.php
```

---

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (PHP 8.2 + MySQL)
- [Composer](https://getcomposer.org/)
- Git

### Setup

```bash
# 1. Clone into your XAMPP htdocs folder
git clone https://github.com/<your-username>/volunteer-management-platform.git C:/xampp/htdocs/volunteer-portal

# 2. Install dependencies
cd C:/xampp/htdocs/volunteer-portal
composer install

# 3. Import the database
#    Open phpMyAdmin → create DB `volunteer_portal` → import docs/db/schema.sql

# 4. Configure DB credentials
#    Edit src/config/DBConnection.php with your local MySQL credentials

# 5. Start Apache and MySQL in XAMPP, then visit:
#    http://localhost/volunteer-portal/src/boundaries/Login.php
```

---

## Running Tests

```bash
./vendor/bin/phpunit tests
```

---

## CI/CD Pipeline

Defined in `.github/workflows/ci-cd.yml`.

| Trigger | Action |
|---|---|
| Push to `main` | Install Composer deps → Run PHPUnit → Print deployment steps |
| Pull request to `main` | Same as above (gate before merge) |

On success, the pipeline prints a step-by-step guide to pull and refresh your local XAMPP instance. No automated remote deployment — intentional for a local dev environment.

---

## UML Diagrams

Full UML documentation is in `docs/uml/`:

- `use_case.png` — Actor interactions for Admin and Volunteer roles
- `sequence_login.png` — Login flow across Boundary → Controller → Entity layers
- `class_diagram.png` — BCE class relationships
- `er_diagram.png` — Database entity-relationship model

---

## Default Credentials (Development Only)

| Role | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |
| Volunteer | `volunteer1` | `vol123` |

> **⚠️ Change all default credentials before any shared or production deployment.**

---

## Module Context

| | |
|---|---|
| Subject | CSIT314 — Software Development Methodologies |
| University | University of Wollongong (Australia) via SIM, Singapore |
| Team | CtrlSourGrades |
| Period | Oct – Nov 2025 |

---

## License

Academic project — not licensed for commercial use.
