# Project Specification: Livestock Ownership Database System

## 1. Project Overview

This project is a web-based application built using Laravel (PHP framework) to manage and track livestock ownership data. The system provides functionality for registering livestock owners, managing livestock records, and viewing aggregated data through a dashboard.

The goal is to create a centralized system for efficient livestock data management.

---

## 2. Tech Stack

* Backend: Laravel (PHP)
* Frontend: Blade Templates + Tailwind CSS
* Database: MySQL
* Authentication: Laravel built-in auth system

---

## 3. User Roles

### 3.1 Admin

* Full access to all data
* Can manage all owners and livestock
* Can view system-wide dashboard

### 3.2 Owner (Farmer)

* Can log in to the system
* Can manage only their own livestock
* Cannot access other owners' data

---

## 4. Core Features (MVP Scope)

### 4.1 Authentication

* User registration
* User login
* User logout
* Role-based access control (admin / owner)

---

### 4.2 Owner Management

* Create owner profile
* View owner details
* Update owner information
* Delete owner

---

### 4.3 Livestock Management

* Add livestock
* View livestock list
* Update livestock details
* Delete livestock

---

### 4.4 Dashboard

* Total number of owners
* Total number of livestock
* Livestock distribution (basic counts)

---

## 5. Data Model Overview

Entities:

* User (authentication)
* Owner (profile linked to user)
* Livestock (linked to owner)

---

## 6. Access Control Rules

* Admin can access all owners and livestock
* Owners can access only their own livestock
* Each owner is linked to exactly one user
* Each livestock must belong to one owner

---

## 7. Functional Flow

1. User registers or logs in
2. If role = owner:

   * Access personal dashboard
   * Manage own livestock
3. If role = admin:

   * Access full dashboard
   * Manage all owners and livestock

---

## 8. Out of Scope (For MVP)

* Payment systems
* Advanced analytics
* AI chatbot integration
* Mobile app
* Real-time tracking (GPS)

---

## 9. Success Criteria

* Users can register and log in successfully
* Owners can manage their livestock without errors
* Admin can view and manage all data
* Data is stored and retrieved correctly from the database

---

## 10. Future Enhancements (Optional)

* Health records for livestock
* Government scheme tracking
* Data visualization (charts)
* AI-based recommendations
