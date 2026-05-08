# Project Context: Livestock Ownership Database System

**Last Updated:** May 1, 2026  
**Status:** Enhanced version with Dashboard, Search/Filter, Multiple Livestock Support, Controlled Health Status, and Breeze Authentication

---

## 1. Project Overview

The **Livestock Ownership Database System** is a web-based application designed to manage and track livestock ownership records. The system allows users to:

- Register and manage livestock owners (farmers)
- Track multiple livestock per owner with dynamic form management
- View system-wide analytics and statistics on a dedicated dashboard
- Search owners by name and filter by livestock type
- Manage livestock with standardized health status values
- View aggregated owner and livestock data
- Update owner and livestock information
- Delete records with automatic cascading

**Primary Use Case:** Small-scale livestock management system for tracking multiple animals per owner with analytics and intelligent data browsing.

---

## 2. Tech Stack

| Component | Technology |
|-----------|-----------|
| Backend Framework | Laravel 11+ (PHP) |
| Frontend | Blade Templates + Tailwind CSS v4 |
| Database | MySQL (livestock_db) |
| ORM | Eloquent |
| Build Tool | Vite |
| Package Manager | Composer (PHP), npm (JavaScript) |

---

## 3. Database Design

### Tables

#### **owners**
```
- id (bigint, PK, auto-increment)
- name (string) - Owner's full name
- phone (string) - Contact number
- address (text) - Physical address
- created_at (timestamp)
- updated_at (timestamp)
```

This table now includes an auto-generated unique `owner_code` in the format `OWN001`, `OWN002`, ... used for short references in the UI and for integration with external systems.

#### **livestock**
```
- id (bigint, PK, auto-increment)
- owner_id (bigint, FK → owners.id, ON DELETE CASCADE)
- type (string) - Animal type (Cow, Goat, Buffalo, etc.)
- breed (string, nullable) - Specific breed
- age (integer) - Age in years
- health_status (string) - Health condition (default: "Healthy")
- created_at (timestamp)
- updated_at (timestamp)
```

Added fields:
- `tag_number` (string, unique) — user-supplied livestock tag/identifier required on entry
- `source` (enum: Born, Purchased) — origin of the animal
- `date_added` (date, nullable) — date the record/animal was added to the system

`tag_number` must be unique across the system and is validated at submission time.

### Relationships

```
Owner (One) ↔ (Many) Livestock
├── Owner::livestock() returns hasMany(Livestock)
└── Livestock::owner() returns belongsTo(Owner)
```

New relationship:
```
Livestock (One) ↔ (Many) LivestockHistory
├── Livestock::histories() returns hasMany(LivestockHistory)
└── LivestockHistory::livestock() returns belongsTo(Livestock)
```

**Cascade Delete:** Deleting an owner automatically deletes all related livestock records.

---

## 4. Features Implemented

### ✅ Completed Features

#### Database & Migrations
- [x] Database initialized (livestock_db)
- [x] Owners table created with migration
- [x] Livestock table created with migration
- [x] Foreign key constraints with CASCADE delete
- [x] Timestamps on both tables
 - [x] Owner code (`owner_code`) added (unique)
 - [x] Livestock `tag_number`, `source`, `date_added` added
 - [x] `livestock_histories` table added for animal events (Vaccination, Treatment, etc.)

#### Models & Relationships
- [x] Owner model with `livestock()` hasMany relationship
- [x] Livestock model with `owner()` belongsTo relationship
- [x] Livestock model uses custom table name (`livestock`)
- [x] Mass assignment fillables configured
 - [x] `owner_code` is fillable and auto-generated on owner creation
 - [x] `LivestockHistory` model implemented and linked to `Livestock`

#### Controller (OwnerController)
- [x] `index()` - List all owners with livestock (eager loading, supports search/filter)
- [x] `create()` - Show form to create owner + multiple livestock
- [x] `store()` - Save new owner and all livestock records from array input
- [x] `edit()` - Show form to edit owner and all livestock records
- [x] `update()` - Update owner and recreate all livestock from array input
- [x] `destroy()` - Delete owner (cascade deletes livestock)

#### Controller (DashboardController)
- [x] `index()` - Display system analytics and statistics

#### Routes (RESTful)
- [x] GET `/` → Redirects to `/dashboard`
- [x] GET `/dashboard` → dashboard.index
- [x] GET `/owners` → owners.index (supports `?search=` and `?type=` query params)
- [x] GET `/owners/create` → owners.create
- [x] POST `/owners` → owners.store
- [x] GET `/owners/{id}/edit` → owners.edit
- [x] PUT `/owners/{id}` → owners.update
- [x] DELETE `/owners/{id}` → owners.destroy

#### Validation System*][...])
- [x] Owner: name (required), phone (required), address (required)
- [x] Livestock array: min 1 entry required
- [x] Livestock items: type (required), breed (nullable), age (required, integer ≥ 0), health_status (required, controlled values)
- [x] Health status restricted to: Healthy, Sick, Under Treatment, Hospitalized, Injured
- [x] Error display on forms with field highlighting (per-livestock validation)age (required, integer ≥ 0), health_status (nullable, default: "Healthy")
- [x] Error display on forms with field highlighting

#### Views (Blade + Tailwind CSS)

**Shared Layout** (`layouts/app.blade.php`)
- [x] Header with navigation
- [x] Main content area
- [x] Session success message display
- [x] Responsive design (mobile-first)

**Index View** (`owners/index.blade.php`)
- [x] List all owners in card format
- [x] Display owner details (name, phone, address)
- [x] Show livestock count for each owner
- [x] Display each owner's livestock in a grid
- [x] Livestock details: type, breed, age, health status
- [x] Edit button (routes to owners.edit)
- [x] Delete button (with JavaScript confirmation)
- [x] Empty state when no owners exist
- [x] Add New Owner button
section)
- [x] Text inputs for owner name, phone, address
- [x] Textarea for owner address
- [x] Dynamic livestock entries with add/remove buttons
- [x] Livestock fields: type, breed, age (number, min:0), health_status (controlled dropdown)
- [x] Health status dropdown with predefined options
- [x] Auto-numbered livestock sections
- [x] JavaScript-based dynamic form management
- [x] Livestock type, breed, age, health status fields
- [x] Number input for age (min:0)
- [x] Form validation error display
- [x] Submit and cancel buttons

**Edit View** (`owners/edit.blade.phall existing records
- [x] Handles empty livestock gracefully (shows one empty entry)
- [x] Dynamic livestock entries with add/remove buttons
- [x] Same layout and styling as create page
- [x] JavaScript-based dynamic form management
- [x] Update and cancel buttons

**Dashboard View** (`dashboard/index.blade.php`)
- [x] System-wide statistics (total owners, total livestock)
- [x] Livestock distribution by type (with progress bars and percentages)
- [x] Health status summary (with color-coded indicators)
- [x] Multi-livestock update logic: deletes all and recreates from input
- [x] Cascade delete on database level
- [x] Division by zero protection in dashboard percentages
- [x] Optimized Eloquent queries for dashboard aggregations
- [x] Division by zero protection

**Search & Filter** (on `owners/index.blade.php`)
- [x] Search input for owner name (case-insensitive)
- [x] Dropdown filter for livestock type
- [x] Search and Clear buttons
- [x] Filtered results displayed in main content
- [x] Smart empty states (no results vs no data)
- [x] Filter values preserved after search for first record
- [x] Handles null livestock gracefully with optional()
- [x] Same layout and styling as create page
- [x] Update and cancel buttons

#### Data Integrity & Performance
- [x] DB::transaction() for atomic operations (create/update)
- [x] Eager loading with `with('livestock')` to prevent N+1 queries
- [x] Safer update logic: targets only first livestock record
- [x] Cascade delete on database level

#### UI/UX
- [x] Tailwind CSS v4 for styling
- [x] Consistent color scheme (sky blue primary, red for delete, slate for neutral)
- [x] Rounded buttons and cards (rounded-full, rounded-2xl, rounded-3xl)
- [x] Focus states with rin and dashboard
- [x] Success message alerts (emerald green)
- [x] Error message styling (red)
- [x] Hover states on all interactive elements
- [x] Dynamic form element styling (add/remove buttons)
- [x] Color-coded health status indicators
- [x] Progress bars for type distribution
- [x] Error message styling (red)
- [x] Hover states on all interactive elements

---

## 5. Architecture

### MVC Structure

```
app/
├── Http/Controllers/
│   ├── OwnerController.php      # Owner CRUD operations
│   └── DashboardController.php  # System analytics and statistics
├── Models/
│   ├── Owner.php                # Owner model with hasMany relationship
│   └── Livestock.php            # Livestock model with belongsTo relationship
routes/
└── web.php                       # Routes (8 owner endpoints + 1 dashboard endpoint)
resources/views/
├── layouts/
│   └── app.blade.php            # Shared layout with navigation
├── dashboard/
│   └── index.blade.php          # Dashboard with statistics
└── owners/
    ├── index.blade.php          # List all owners + livestock + search/filter
    ├── create.blade.php         # Create owner + multiple livestock (dynamic)
    └── edit.blade.php           # Edit owner + multiple livestock (dynamic)
database/migrations/
├── 2026_04_30_084148_create_owners_table.php
└── 2026_04_30_084435_create_livestock_table.php
```

### Key Design Patterns

1. **Eloquent ORM:** All database operations use Eloquent, no raw SQL
2. **Relationship-based Operations:** Uses Eloquent relationship methods (e.g., `$owner->livestock()`)
3. **Transaction Handling:** All multi-record operations wrapped in `DB::transaction()`
4. **Eager Loading:** Controllers use `with('livestock')` to optimize queries
5. **Form Arrays:** Nested form data using Laravel's array notation: `owner[name]`, `livestock[*][type]`
6. **Validation Rules Helper:** Private method `validationRules()` centralizes validation logic
7. **Blade Template Inheritance:** All views extend `layouts/app` for consistency
8. **Dynamic Form Management:** JavaScript handles add/remove livestock entries with automatic re-indexing
9. **Search & Filter Pattern:** Query parameters (`?search=`, `?type=`) for flexible data discovery

---

## 6. Important Implementation Notes

### Critical Details

1. **Multiple Livestock Handling:**
   - Store: Loops through `$validated['livestock']` array and creates each entry
   - Update: Deletes ALL existing livestock, then creates new ones from array
   - Simplifies logic by treating update as delete + recreate operation
   - Uses transaction to ensure atomicity

3. **Form Data Structure (Multiple):**
   ```php
   'owner[name]' → stored in owner array
   'owner[phone]' → stored in owner array
   'owner[address]' → stored in owner array
   'livestock[0][type]' → stored in livestock[0] array
   'livestock[0][breed]' → stored in livestock[0] array
   'livestock[0][age]' → stored in livestock[0] array
   'livestock[0][health_status]' → stored in livestock[0] array
   'livestock[1][type]', 'livestock[1][breed]', etc.
   ```

4. **Health Status Standardization:**
   - Values restricted to: Healthy, Sick, Under Treatment, Hospitalized, Injured
   - Validated with: `in:Healthy,Sick,Under Treatment,Hospitalized,Injured`
   - No free-text input allowed
   - Ensures data consistency across system

5. **Eager Loading Pattern:**
   ```php
   $owners = Owner::with('livestock')->latest()->get();
   // Prevents N+1 queries, loads livestock in single query
   ```

6. **Validation Rules (Array):**
   ```php
   'livestock' => ['required', 'array', 'min:1'],
   'livestock.*.type' => ['required', 'string', 'max:255'],
   'livestock.*.health_status' => ['required', 'string', 'in:Healthy,Sick,...'],
   // Validates each livestock entry in array
   ```

7. **Transaction Safety:**
   ```php
   DB::transaction(function () use (...) {
       // Multiple operations guaranteed atomic
   });
   ```

8. **Dynamic Form JavaScript:**
   - Add/remove livestock entries without page reload
   - Auto-reindex form field names (livestock[0], livestock[1], etc.)
   - Maintain form state during add/remove operations
   - No Authentication/Authorization:**
   - No user login/logout
   - No role-based access control (admin vs owner roles)
   - All data is public (if server is exposed)

2. **Limited Livestock Management:**
   - Cannot directly add livestock without owner
   - Cannot view livestock list separately (livestock only visible via owner)
   - Cannot edit/delete individual livestock entries

3. **Limited Data Entry:**
   - No bulk import/export
   - No CSV export
   - Limited data validation beyond basic types

4. **No Advanced Reporting:**
   - Dashboard shows basic aggregations only
   - No age distribution reports
   - No time-series health status tracking

5. **No Activity Logging:**
   - No audit trail
   - No change history
   - No user action logging

6. **No Pagination:**
   - All owners loaded on single page
   - May have performance issues with 1000+ owners
   - No pagination on dashboards

4. **No Authentication/Authorization:**
   - No user login/logout
   - No role-based access control (admin vs owner roles)
   - All data is public (if server is exposed)

5. **No Livestock Management:**
   - Cannot directly add livestock without owner
   - Cannot view livestock list separately
   - No livestock search/filter

6. **Limited Data Entry:**
   - No bulk import/export
   - No CSV export
   - No data validation beyond basic types

7. **No Reporting:**
   - No health status reports
   - No age distribution reports
   - No livestock type statistics

8. **No Activity Logging:**
   - No audit trail
   - No change history
   - No user action logging

---

## 8. Next Steps (Roadmap)

### Phase 1: Dashboard & Analytics (High Priority)
- [ ] Create DashboardController
- [ ] Add GET `/dashboard` route
- [ ] Display total owners count
- [ ] Display total livestock count
- [ ] Show livestock type distribution
- [ ] Show health status summary

### Phase 2: Search & Filter (Medium Priority)
- [ ] Add search input to owners/index
- [ ] Implement owner name search
- [ ✅ Phase 1: Dashboard & Analytics (COMPLETED)
- [x] Create DashboardController
- [x] Add GET `/dashboard` route
- [x] Display total owners count
- [x] Display total livestock count
- [x] Show livestock type distribution
- [x] Show health status summary

### ✅ Phase 2: Search & Filter (COMPLETED)
- [x] Add search input to owners/index
- [x] Implement owner name search
- [x] Filter by livestock type
- [x] Implement pagination on large datasets

### ✅ Phase 2B: Multiple Livestock Support (COMPLETED)
- [x] Dynamic livestock form (add/remove entries)
- [x] Array-based validation (livestock.*)
- [x] Controlled health status dropdown
- [x] Edit form supports all livestock
- [x] Update logic recreates livestock

---

## 9. Authentication & Access Control

- Breeze Blade authentication is installed for login, registration, password reset, and logout flows.
- Users now have a `role` column with `admin` and `owner` values.
- `User::isAdmin()` and `User::isOwner()` provide a simple role API.
- Owners are linked to users through `owners.user_id` and `Owner::user()` / `User::owner()`.
- Admin users can manage all owners and livestock.
- Owner users can only view their own owner record and dashboard data.
- Admin dashboard lives at `/dashboard`; owner dashboard lives at `/my-dashboard`.
- Route protection uses `auth` plus a custom `role` middleware.
- Login redirects are role-aware after authentication.
- Admin-created owners automatically get a linked user account with the owner role.
- History entries are accessible through the livestock history form and remain scoped by role.
- [ ] Link Owner to User (one-to-one)
- [ ] Implement role-based middleware (admin, owner)
- [ ] Restrict owner routes to admin only
- [ ] Restrict livestock to own records

### Phase 5: Data Export & Reporting (Low Priority)
- [ ] CSV export functionality
- [ ] PDF report generation
- [ ] Health status reports
- [ ] Livestock statistics

### Phase 6: Enhanced Validation (Low Priority)
- [ ] Add custom validation rules
- [ ] Phone number format validation
- [ ] Email validation (if user linked)
- [ ] Age range validation

---

## 9. How to Run the Project

### Prerequisites
- PHP 8.2+
- MySQL/MariaDB running
- Composer installed
- Node.js & npm installed

### Setup Steps

1. **Clone/Navigate to project:**
   ```bash
   cd c:\Users\hp\Desktop\livestock\livestock
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install npm dependencies:**
   ```bash
   npm install
   ```

4. **Setup environment file:**
   ```bash
   cp .env.example .env
   # Edit .env and set database credentials
   # DB_DATABASE=livestock_db
   # DB_USERNAME=root
   # DB_PASSWORD=your_password
   ```

5. **Generate app key:**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations:**
   ```bash
   php artisan migrate
   ```

7. **Start development server:**
   ```bash
   php artisan serve
   ```

8. **Build frontend assets (in separate terminal):**
   ```bash
   npm run dev
   ```

9. **Visit application:**
   ```
   http://localhost:8000
   ```

### Database Setup
- Create MySQL database: `livestock_db`
- Migrations will create `owners` and `livestock` tables
- No seeders needed for manual data entry

---

## 10. Developer Notes

### Code Style & Conventions

1. **Follow Laravel Standards:**
   - Controllers: CamelCase class names, plural resource names
   - Models: Singular class names, lowercase table names
   - Routes: Lowercase, RESTful conventions
   - Views: kebab-case file names, organized by resource

2. **Use Eloquent, Not Raw SQL:**
   ```php
   // ✅ Good
   $owner = Owner::with('livestock')->find($id);
   
   // ❌ Avoid
   $owner = DB::select("SELECT * FROM owners WHERE id = ?", [$id]);
   ```

3. **Maintain Blade Template Consistency:**
   - Use `@extends('layouts.app')` for layout inheritance
   - Use `@section('title')` and `@section('content')`
   - Keep form styling consistent (rounded buttons, Tailwind classes)
   - Use `@error()` directives for validation messages

4. **Validation Best Practices:**
   - Centralize validation rules (use private method if shared)
   - Use nested array notation for related data
   - Always validate with clear error messages
   - Use `old()` helper to repopulate forms

5. **Transaction Handling:**
   - Wrap multi-step operations in `DB::transaction()`
   - Ensures atomicity (all-or-nothing)
   - Prevents partial data corruption

6. **Performance Optimization:**
   - Always use eager loading: `with('relationship')`
   - Avoid N+1 queries
   - Use `first()`, `latest()`, `paginate()` appropriately
   - Cache frequently accessed data if needed

7. **Git Commit Messages:**
   ```
   ✅ Add feature: Brief description
   🐛 Fix: Brief description
   ♻️ Refactor: Brief description
   📚 Docs: Brief description
   ```

8. **Testing (Future Implementation):**
   - Write feature tests for controller actions
   - Test validation rules
   - Test relationship loading
   - Use Laravel's testing utilities

### Important Files to Modify

When implementing new features, modify these files in order:
1. **Migrations** - If adding new fields/tables
2. **Models** - If adding relationships
3. **Controllers** - Add new methods
4. **Routes** - Add new routes
5. **Views** - Create/update Blade templates
6. **Validation** - Update validation rules if needed

### Files to Never Break

- `app/Models/Owner.php` - Core relationship
- `app/Models/Livestock.php` - Core relationship
- Database migrations - Once run, don't modify
- `routes/web.php` - Route consistency
- `layouts/app.blade.php` - UI consistency

---

## 11. Quick Reference

### Common Commands

```bash
# View all routes
php artisan route:list

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
php artisan migrate
php artisan migrate:rollback

# Make new controller
php artisan make:controller ControllerName

# Make new model
php artisan make:model ModelName

# Make migration
php artisan make:migration create_table_name

# Compile Blade views
php artisan view:cache
```

### Database Commands

```bash
# Start MySQL
mysql -u root -p

# Connect to database
USE livestock_db;

# View tables
SHOW TABLES;

# Describe table
DESCRIBE owners;
DESCRIBE livestock;
```

---

## 12. Session History

### April 30, 2026 - Initial Implementation
- [x] Created database migrations (owners, livestock)
- [x] Created Owner and Livestock models with relationships
- [x] Implemented OwnerController with CRUD operations
- [x] Created Blade views (index, cr

### May 1, 2026 - Dashboard, Search/Filter, Multiple Livestock
- [x] Created DashboardController with aggregation queries
- [x] Implemented dashboard view with statistics and charts
- [x] Added search functionality (owner name)
- [x] Added filter functionality (livestock type)
- [x] Implemented dynamic livestock form (add/remove entries)
- [x] Changed health status to controlled dropdown with 5 fixed values
- [x] Updated validation to use array notation (livestock.*)
- [x] Changed update logic to delete and recreate livestock
- [x] Fixed dashboard division by zero issues
- [x] OptimizMultiple Livestock Array Handling (RESOLVED)
- **Problem:** Form needed to support 1 to N livestock entries
- **Solution:** Implemented dynamic JavaScript form with array naming (livestock[*][])
- **Status:** ✅ Completed with add/remove buttons and auto-reindexing

### Issue 2: Health Status Free-Text Problem (RESOLVED)
- **Problem:** Free-text health status allowed inconsistent data
- **Solution:** Replaced with controlled dropdown (5 fixed values)
- **Status:** ✅ Validated with `in:` rule, consistent data ensured

### Issue 3: Division by Zero in Dashboard (RESOLVED)
- **Problem:** Percentage calculation crashed with empty database
- **Solution:** Added ternary operator checks before division
- **Status:** ✅ Fixed in dashboard.blade.php template

### Issue 4: Query Optimization (RESOLVED)
- **Problem:** Separate select() and selectRaw() calls were inefficient
- **Solution:** Merged into single selectRaw('type, COUNT(*) as count')
- **Status:** ✅ Improved query efficiency in DashboardController

### Issue 5: Edit Form with Multiple Livestock (RESOLVED)
- **Problem:** Old edit form only handled single livestock
- **Solution:** Changed to loop through all livestock with @forelse fallback
- **Status:** ✅ Edit form now supports all livestock entries

### May 1, 2026 (Evening) - Authentication & Role-Based System Fixes
- [x] Removed `unique()` constraint from `user_id` in migration (allows multiple owners, though not used yet)
- [x] Added access control to OwnerController:
  - `edit()` - Owners can only edit their own record
  - `update()` - Owners can only update their own record
  - `destroy()` - Owners can only delete their own record (+ linked user)
- [x] Fixed password generation: Changed from static `'password123'` to `Str::random(10)`
- [x] Improved owner deletion: Deletes linked user account before owner record
- [x] Created owner-specific dashboard view (`dashboard/owner.blade.php`):
  - Shows owner info (name, owner_code, contact)
  - Displays total livestock count
  - Lists all animals with color-coded health status badges
  - Green for Healthy, Red for Sick, Yellow for Under Treatment, etc.
- [x] Enforced role-based navigation:
  - Admin sees: Dashboard, Owners, Add Owner, Logout
  - Owner sees: My Dashboard, Logout (no access to owner management)
- [x] Verified login redirection logic (already in place)

### May 1, 2026 (Later) - Self Signup + Google OAuth
- [x] Owner self-signup now creates both `User` and linked `Owner` records
- [x] Registration generates `owner_code` automatically using the shared `OWN###` format
- [x] Added Google OAuth login via Laravel Socialite
- [x] Google login creates a new owner account when the email does not exist
- [x] Existing users are logged in and redirected by role
- [x] Admin-created owner credentials are flashed to the owners index page after creation
- [x] Root route now shows welcome for guests and redirects authenticated users by role
- [x] Owners index now hides admin-only actions from owner users

### Authentication Details

**Breeze Authentication:**
- Laravel Breeze Blade stacks installed
- Login, registration, password reset, and logout flows implemented
- CSRF protection on all forms

**Role System:**
- Users have a `role` column: `admin` or `owner`
- `User::isAdmin()` - Check if admin
- `User::isOwner()` - Check if owner
- Custom `role` middleware restricts routes by role

**Owner-User Relationship:**
- One-to-One relationship: Owner ↔ User
- When admin creates owner: automatically generates user account with:
  - Email: `own{code}@livestock.local`
  - Password: Random 10-character string
  - Role: `owner`
- When owner is deleted: linked user is deleted first (prevent orphans)

**Access Control:**
- Admin can: create, read, update, delete ALL owners
- Owner can: read/update ONLY their own owner record
- Owner cannot: access owner management pages (create, list, delete)
- 403 Forbidden returned if owner tries to edit/update/delete another owner's record

**OAuth / Signup:**
- Self-signup creates the auth user and matching owner profile in one transaction
- Google OAuth uses Socialite and stateless callbacks
- New Google users are created with role `owner` and a linked owner record
- Admin-created owners receive a generated email/password pair shown after save

**Routes:**
- `GET /dashboard` - Admin dashboard (statistics, type distribution, health summary)
- `GET /my-dashboard` - Owner dashboard (personal owner info, livestock list)
- `GET /auth/google` - Google login redirect
- `GET /auth/google/callback` - Google OAuth callback
- `GET /owners` - Owner list (admin only, but returns owner's own record if owner)
- `GET /owners/create` - Create owner form (admin only)
- `POST /owners` - Store owner (admin only)
- `GET /owners/{id}/edit` - Edit owner (admin only OR owner if own record)
- `PUT /owners/{id}` - Update owner (admin only OR owner if own record)
- `DELETE /owners/{id}` - Delete owner (admin only OR owner if own record)

**Navigation Bar Logic:**
- Shows "Dashboard" link (points to correct dashboard based on role)
- Admin sees: Owners, Add Owner
- Owner does NOT see owner management buttons
- All users see: Logout

**Security Improvements:**
- No orphan users when owner deleted
- No hardcoded passwords (random generation)
- Role-based middleware on all sensitive routes
- Access control checks in controller methods
- 403 Forbidden for unauthorized owner access attempts
- Google OAuth login is stateless and role-aware

---

**End of Context Document**

This file serves as the single source of truth for the project state. Update it whenever significant changes are made.
