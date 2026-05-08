# Database Schema: Livestock Ownership Database System

## 1. General Notes

* Database: MySQL
* All tables use `id` as primary key (auto-increment)
* Timestamps (`created_at`, `updated_at`) are required in all tables
* Foreign keys must enforce referential integrity
* Use cascading deletes where specified

---

## 2. Tables Definition

### 2.1 users

Purpose: Authentication and role management

Fields:

* id (bigint, PK, auto-increment)
* name (string, not null)
* email (string, unique, not null)
* password (string, not null)
* role (enum: 'admin', 'owner', default: 'owner')
* created_at (timestamp)
* updated_at (timestamp)

---

### 2.2 owners

Purpose: Stores livestock owner profile data

Fields:

* id (bigint, PK, auto-increment)
* user_id (bigint, FK → users.id, unique, not null)
* phone (string, not null)
* address (text, not null)
* created_at (timestamp)
* updated_at (timestamp)

Constraints:

* Each owner must be linked to exactly one user
* One-to-one relationship with users

---

### 2.3 livestock

Purpose: Stores livestock details

Fields:

* id (bigint, PK, auto-increment)
* owner_id (bigint, FK → owners.id, not null)
* type (string, not null)            # e.g., Cow, Goat, Buffalo
* breed (string, nullable)
* age (integer, nullable)
* health_status (string, default: 'Healthy')
* created_at (timestamp)
* updated_at (timestamp)

Constraints:

* Each livestock must belong to one owner
* One-to-many relationship (Owner → Livestock)
* On owner deletion → cascade delete livestock

---

## 3. Relationships Summary

* User hasOne Owner

* Owner belongsTo User

* Owner hasMany Livestock

* Livestock belongsTo Owner

---

## 4. Indexing Recommendations

* users.email → unique index
* owners.user_id → unique index
* livestock.owner_id → index

---

## 5. Data Integrity Rules

* Cannot create owner without a valid user
* Cannot create livestock without a valid owner
* Deleting a user should delete associated owner (cascade)
* Deleting an owner should delete all associated livestock (cascade)

---

## 6. Future Extensions (Not in MVP)

Possible additional tables:

* health_records (linked to livestock)
* schemes (government schemes tracking)
* locations (geo-based tracking)
