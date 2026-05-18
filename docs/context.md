# Project Context: Livestock Ownership Database System

**Last Updated:** May 18, 2026  
**Status:** Advanced version with Role-based Dashboards, Google OAuth, Livestock Health & History Management, Government Schemes Module, and Breeze Authentication.

---

## 1. Project Overview

The **Livestock Ownership Database System** is a web-based application designed to manage and track livestock ownership records and related government benefits. The system allows users to:

- Register and manage livestock owners (farmers) via manual entry or Google OAuth.
- Track multiple livestock per owner with dynamic form management and standardized health statuses.
- Track livestock health events (vaccination, treatment, illness) in a dedicated history log.
- Browse and manage relevant Government Schemes (State & Central).
- View role-specific dashboards (Admin vs Owner/Farmer).
- Search and filter livestock, owners, and government schemes.

**Primary Use Case:** Small-scale livestock management system for tracking multiple animals per owner with role-based access, health tracking, and government scheme discovery.

---

## 2. Tech Stack

| Component | Technology |
|-----------|-----------|
| Backend Framework | Laravel 11+ (PHP) |
| Frontend | Blade Templates + Tailwind CSS v4 + Alpine.js |
| Database | MySQL (livestock_db) |
| ORM | Eloquent |
| Build Tool | Vite |
| Package Manager | Composer (PHP), npm (JavaScript) |
| Authentication | Laravel Breeze + Laravel Socialite (Google OAuth) |

---

## 3. Database Design

### Entities (Tables)

#### **users**
- Basic Laravel auth table (id, name, email, password, etc.)
- **role**: enum ('admin', 'owner')
- **google_id**: string (nullable) for OAuth

#### **owners**
- `id` (bigint, PK)
- `user_id` (bigint, FK → users.id, ON DELETE CASCADE)
- `owner_code` (string, unique, format: OWN001)
- `name` (string)
- `phone` (string, nullable)
- `address` (text, nullable)

#### **livestock**
- `id` (bigint, PK)
- `owner_id` (bigint, FK → owners.id, ON DELETE CASCADE)
- `tag_number` (string, unique)
- `type` (string) - Animal type (Cow, Goat, Buffalo, etc.)
- `breed` (string, nullable)
- `age` (integer)
- `source` (enum: Born, Purchased)
- `date_added` (date, nullable)
- `health_status` (string) - Controlled: Healthy, Sick, Under Treatment, Hospitalized, Injured

#### **livestock_histories**
- `id` (bigint, PK)
- `livestock_id` (bigint, FK → livestock.id, ON DELETE CASCADE)
- `event_date` (date)
- `event_type` (string) - Vaccination, Treatment, Checkup, Illness, Deworming, Surgery
- `description` (text, nullable)

#### **schemes**
- `id` (bigint, PK)
- `title` (string)
- `category` (string) - Controlled dropdown (Dairy, Poultry, Subsidy, etc.)
- `animal_type` (string, nullable)
- `scheme_type` (enum: State, Central)
- `state_name` (string, nullable) - Required if scheme_type is State
- `eligibility` (text)
- `benefits` (text)
- `deadline` (date, nullable)
- `apply_link` (string, nullable)
- `description` (text)

---

## 4. Authentication & Access Control

### Role System
The system has two roles managed via the `role` column in the `users` table:
1. **Admin** (`role: admin`): Full access to the system. Can manage all owners, all livestock, all health histories, and perform CRUD operations on Government Schemes.
2. **Owner** (`role: owner`): Limited access. Can view their own dashboard, manage their own livestock and histories, complete their profile, and browse Government Schemes.

### Credentials
- **Admin Email**: `beast@admin.com`
- **Admin Password**: `Admin123`

### Google OAuth & Onboarding
- Uses Laravel Socialite.
- First-time Google login creates a user (role: `owner`) and an `owner` profile simultaneously.
- If the newly created profile is missing a phone number or address, they are forced to complete their profile via the `EnsureProfileIsComplete` middleware before accessing their dashboard.

---

## 5. UI/UX and Navigation Structure

### Navbar
The application uses a unified, dynamic navbar (`layouts/app.blade.php`) that adapts to user roles for both desktop and mobile devices.

**Admin Navbar:**
- Dashboard (System Analytics)
- Owners (Manage Farmers)
- Livestock (Manage All Animals)
- Schemes (Manage Government Schemes)
- Profile & Log Out

**Owner Navbar:**
- My Dashboard (Personal Overview)
- My Livestock (Manage Own Animals)
- Schemes (Browse Schemes)
- Profile & Log Out

### Dashboards
- **Admin Dashboard (`/dashboard`)**: Displays total owners, total livestock, health status summary, livestock type distribution, and featured schemes. Identified by "Administrator Panel".
- **Owner Dashboard (`/my-dashboard`)**: Displays personal records, recent health activities, animals needing attention, and featured schemes. Identified by "Farmer Dashboard".

---

## 6. Features Implemented

### ✅ Phase 1: Foundation & Owners Module
- Custom login/register/OAuth flows.
- Profile completion and edit flows.
- Owner creation, listing, updating, and deletion (with CASCADE delete to users and livestock).

### ✅ Phase 2: Livestock Management Module
- Dedicated Livestock listing (`/livestock`) with advanced search/filters (tag, type, health status, owner).
- Eager loading to prevent N+1 queries.
- Pagination for large datasets.
- Add/Edit single livestock with comprehensive attributes.
- Cascade deletion when an owner is removed.

### ✅ Phase 3: Livestock History Tracking
- Ability to add, edit, and delete health events (Vaccination, Treatment, Checkup, Illness, Deworming, Surgery) for specific livestock.
- Real-time display of history in the Owner dashboard and Livestock details page.

### ✅ Phase 4: Government Schemes Module
- Full CRUD management of government schemes for Admins.
- Display and search/filter of schemes for Owners.
- Dynamic `state_name` field (only required/visible for State-level schemes).
- Controlled category dropdowns.
- Detailed scheme views with deadlines, eligibility criteria, and external application links.
- Integration of "Featured Schemes" on both Admin and Owner dashboards.

### ✅ Phase 5: Production Deployment & Bug Fixes
- **Google OAuth Deployment**: Added `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, and `GOOGLE_REDIRECT_URI` to `render.yaml`. Handled randomized passwords for Google users to prevent database errors on user creation.
- **Render HTTPS Proxy Fixes**: Configured `APP_URL` and `ASSET_URL` to enforce HTTPS on Vite assets, solving "Mixed Content" and missing CSS issues. Added `mime.types` to Nginx config to serve CSS properly.
- **Blade Template Fixes**: Resolved layout structure issues in `resources/views/profile/complete.blade.php` by properly structuring `@extends` and `@section('content')`.
- **Production Status**: Successfully deployed to Render using a multi-stage Docker build with a Neon PostgreSQL database. Fully functional for real-world usage.

---

## 7. Next Steps (Pending Tasks)

### Phase 5: Reporting & Export (Low Priority)
- [ ] Export Owner/Livestock data to CSV/Excel.
- [ ] Generate PDF reports for Livestock Health History.

### Phase 6: System Settings (Low Priority)
- [ ] Admin panel for managing dropdown values (Animal Types, Scheme Categories).
- [ ] Notification system for expiring scheme deadlines or overdue vaccinations.

---

## 8. Developer Notes

- **Middleware**: Use `role:admin` to lock routes for admins. Use `role:admin,owner` for shared access.
- **Form Data**: Always validate inputs strictly, especially dropdowns which have fixed values (e.g., `health_status`, `category`).
- **Styles**: Stick to Tailwind CSS v4. Ensure all new UI components are fully responsive and use existing design tokens (e.g., `bg-sky-600`, `rounded-xl`, `border-slate-300`).
- **Icons**: Emoji icons are heavily used in mobile navigation and dashboards for a friendly, farmer-oriented aesthetic.
