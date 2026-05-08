# Business Rules: Livestock Ownership Database System

## 1. Overview

This document defines all business logic, constraints, and access control rules that must be enforced across the application.

These rules must be implemented at:

* Controller level
* Middleware level
* Database level (where applicable)

---

## 2. User Role Rules

### 2.1 Role Types

* admin
* owner

### 2.2 Default Role

* All newly registered users must have role = 'owner'

### 2.3 Role Restrictions

Admin:

* Full access to all resources
* Can manage all owners and livestock

Owner:

* Limited access
* Can only manage their own livestock
* Cannot access owner management routes

---

## 3. Owner Rules

### 3.1 Ownership Constraint

* Each owner must be linked to exactly one user
* One user can have only one owner profile

### 3.2 Creation Rules

* Owner can only be created by admin
* Owner must be linked to an existing user

### 3.3 Deletion Rules

* Deleting an owner must:

  * Delete all associated livestock (cascade)
  * Maintain database integrity

### 3.4 Access Rules

* Owners cannot view or modify other owners
* Only admin can view all owners

---

## 4. Livestock Rules

### 4.1 Ownership Constraint

* Each livestock must belong to exactly one owner
* Livestock cannot exist without an owner

### 4.2 Creation Rules

* Livestock can be created by:

  * Admin (for any owner)
  * Owner (only for themselves)

### 4.3 Update Rules

* Admin can update any livestock
* Owner can update only their own livestock

### 4.4 Deletion Rules

* Admin can delete any livestock
* Owner can delete only their own livestock

---

## 5. Access Control Rules

### 5.1 General Access

* All protected routes require authentication

### 5.2 Admin Access

* Can access:

  * /owners (all routes)
  * /livestock (all records)
  * /dashboard (global data)

### 5.3 Owner Access

* Cannot access:

  * /owners routes
* Can access:

  * /livestock routes (restricted to own data)
  * /dashboard (personal data only)

---

## 6. Data Filtering Rules

### 6.1 Livestock Listing

Admin:

* Can view all livestock records

Owner:

* Must only see livestock where:
  owner_id = current_user.owner.id

---

## 7. Validation Rules

### 7.1 Owner Validation

* phone → required, string
* address → required, text

### 7.2 Livestock Validation

* type → required, string
* breed → optional
* age → optional, integer
* health_status → default to 'Healthy' if not provided

---

## 8. Data Integrity Rules

* Cannot create owner without valid user_id
* Cannot create livestock without valid owner_id
* Foreign keys must enforce relationships
* Cascade delete must be applied:

  * users → owners
  * owners → livestock

---

## 9. Dashboard Rules

Admin Dashboard:

* Show total number of owners
* Show total number of livestock

Owner Dashboard:

* Show only their livestock count
* No access to global statistics

---

## 10. Security Rules

* Users must be authenticated before accessing protected routes
* Role-based middleware must be enforced
* Direct URL access must not bypass restrictions
* Owners must not access or manipulate other users' data

---

## 11. Error Handling Rules

* Unauthorized access → return 403 Forbidden
* Invalid data → return validation errors
* Missing resource → return 404 Not Found

---

## 12. Future Extensions (Optional)

* Add audit logs for actions
* Add role hierarchy (e.g., sub-admin)
* Add approval system for livestock registration
