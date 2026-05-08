# UI Flow Specification: Livestock Ownership Database System

## 1. Overview

This document defines the navigation flow, page structure, and user interactions for the application.

The UI will be built using Blade templates and Tailwind CSS.

---

## 2. Global Layout

All authenticated pages should follow a consistent layout:

Components:

* Navbar (top)
* Sidebar (optional)
* Main content area

Navbar must include:

* App name (Livestock System)
* Logged-in user name
* Logout button

---

## 3. Public Pages (Unauthenticated)

### 3.1 Login Page

Route:

* GET /login

Elements:

* Email input
* Password input
* Login button
* Link to Register

Flow:

* On success → redirect to /dashboard
* On failure → show error message

---

### 3.2 Register Page

Route:

* GET /register

Elements:

* Name
* Email
* Password
* Confirm Password
* Register button

Flow:

* Default role = owner
* On success → redirect to /dashboard

---

## 4. Authenticated Flow

After login → user lands on:

### 4.1 Dashboard

Route:

* GET /dashboard

---

### Admin View:

Displays:

* Total owners
* Total livestock
* Navigation links:

  * Manage Owners
  * Manage Livestock

---

### Owner View:

Displays:

* Total livestock (owned by user)
* Navigation link:

  * Manage My Livestock

---

## 5. Owner Management Pages (Admin Only)

### 5.1 Owners List Page

Route:

* GET /owners

Elements:

* Table listing all owners

  * Name
  * Phone
  * Address
* Buttons:

  * Add Owner
  * Edit
  * Delete

---

### 5.2 Add Owner Page

Route:

* GET /owners/create

Form Fields:

* Select User (dropdown of users without owner profile)
* Phone
* Address

Actions:

* Submit → POST /owners
* Redirect to owners list

---

### 5.3 Edit Owner Page

Route:

* GET /owners/{id}/edit

Form Fields:

* Phone
* Address

Actions:

* Submit → PUT /owners/{id}
* Redirect to owners list

---

## 6. Livestock Management Pages

### 6.1 Livestock List Page

Route:

* GET /livestock

---

### Admin View:

* Shows all livestock
* Includes owner info

---

### Owner View:

* Shows only their livestock

---

Table Columns:

* Type
* Breed
* Age
* Health Status
* Owner (admin only)

Buttons:

* Add Livestock
* Edit
* Delete

---

### 6.2 Add Livestock Page

Route:

* GET /livestock/create

Form Fields:

* Type (required)
* Breed (optional)
* Age (optional)
* Health Status (default: Healthy)

Admin:

* Select Owner (dropdown)

Owner:

* Owner auto-assigned (no dropdown)

Actions:

* Submit → POST /livestock
* Redirect to livestock list

---

### 6.3 Edit Livestock Page

Route:

* GET /livestock/{id}/edit

Form Fields:

* Type
* Breed
* Age
* Health Status

Actions:

* Submit → PUT /livestock/{id}
* Redirect to livestock list

---

## 7. Navigation Flow Summary

Unauthenticated:
Login → Register → Login

Authenticated:
Dashboard → Owners (admin) → Livestock

---

## 8. Conditional UI Rendering

Based on role:

Admin:

* Show Owners menu
* Show all livestock
* Show owner selection dropdown

Owner:

* Hide Owners menu
* Show only personal livestock
* Hide owner selection field

---

## 9. Error & Feedback UI

* Show validation errors below form inputs
* Show success messages after:

  * Create
  * Update
  * Delete

---

## 10. UX Guidelines

* Keep forms simple and clean
* Use Tailwind for responsive design
* Use tables for listing data
* Use confirmation prompt before delete

---

## 11. Future Enhancements (Optional)

* Search and filters
* Pagination
* Charts on dashboard
* Dark mode
  