# Task Breakdown: Livestock Ownership Database System

## 1. Overview

This document defines the exact step-by-step implementation plan for building the system.

Each step should be executed sequentially.
Do NOT skip steps.

---

## 2. Phase 1: Project Setup

### Step 1.1: Initialize Laravel Project

* Ensure Laravel project is installed and running
* Configure `.env` file:

  * Set database name
  * Set DB username and password

### Step 1.2: Setup Database Connection

* Create MySQL database (e.g., livestock_db)
* Run initial migration:

```bash
php artisan migrate
```

---

## 3. Phase 2: Database Implementation

### Step 2.1: Create Migrations

Generate migrations for:

* owners table
* livestock table

Command:

```bash
php artisan make:migration create_owners_table
php artisan make:migration create_livestock_table
```

---

### Step 2.2: Define Schema

* Implement fields as defined in `database-schema.md`

* Add foreign keys:

  * owners.user_id → users.id
  * livestock.owner_id → owners.id

* Add cascade delete rules

---

### Step 2.3: Run Migrations

```bash
php artisan migrate
```

---

## 4. Phase 3: Model Creation

### Step 3.1: Create Models

```bash
php artisan make:model Owner
php artisan make:model Livestock
```

---

### Step 3.2: Define Relationships

Implement relationships as per `relationships.md`:

* User → hasOne Owner
* Owner → belongsTo User
* Owner → hasMany Livestock
* Livestock → belongsTo Owner

---

## 5. Phase 4: Authentication Setup

### Step 4.1: Install Laravel Auth

Use Laravel Breeze:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

---

### Step 4.2: Add Role Field

* Modify users table to include:

  * role (admin / owner)

* Set default role = owner

---

### Step 4.3: Create Admin User (Manual or Seeder)

---

## 6. Phase 5: Middleware Setup

### Step 5.1: Create Role Middleware

Commands:

```bash
php artisan make:middleware IsAdmin
php artisan make:middleware IsOwner
```

### Step 5.2: Implement Logic

* IsAdmin → allow only admin users
* IsOwner → allow only owner users

### Step 5.3: Register Middleware in Kernel

---

## 7. Phase 6: Controller Implementation

### Step 6.1: Create Controllers

```bash
php artisan make:controller OwnerController --resource
php artisan make:controller LivestockController --resource
php artisan make:controller DashboardController
```

---

### Step 6.2: Implement OwnerController

* index → list owners
* create → show form
* store → save owner
* edit → show edit form
* update → update owner
* destroy → delete owner

---

### Step 6.3: Implement LivestockController

* index → role-based filtering
* create → form (admin vs owner logic)
* store → assign owner_id correctly
* update → enforce ownership rules
* destroy → enforce ownership rules

---

### Step 6.4: Implement DashboardController

* Show:

  * total owners
  * total livestock
  * role-based filtering

---

## 8. Phase 7: Routes Setup

* Define routes as per `routes-spec.md`
* Apply middleware:

  * auth
  * isAdmin

---

## 9. Phase 8: View Implementation (Blade)

### Step 8.1: Layout

* Create main layout file

### Step 8.2: Pages

* dashboard.blade.php
* owners/

  * index.blade.php
  * create.blade.php
  * edit.blade.php
* livestock/

  * index.blade.php
  * create.blade.php
  * edit.blade.php

---

### Step 8.3: Conditional UI

* Show/hide elements based on role

---

## 10. Phase 9: Validation & Error Handling

* Add validation in controllers
* Display errors in Blade views

---

## 11. Phase 10: Testing

Test all flows:

* Auth (login/register)
* Owner CRUD
* Livestock CRUD
* Role restrictions
* Dashboard data

---

## 12. Phase 11: Final Cleanup

* Remove debug code
* Ensure proper redirects
* Check UI consistency

---

## 13. Execution Rules

* Follow steps in order
* Do not implement advanced features before MVP is complete
* Always refer to:

  * database-schema.md
  * relationships.md
  * routes-spec.md
  * rules.md

---

## 14. Output Expectation

At the end of execution:

* Fully working Laravel application
* Proper CRUD functionality
* Role-based access control
* Clean UI with Blade + Tailwind
