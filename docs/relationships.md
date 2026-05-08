# Relationships Specification: Livestock Ownership Database System

## 1. Overview

This document defines the relationships between models using Laravel Eloquent ORM conventions.

All relationships must be implemented in their respective model classes.

---

## 2. User ↔ Owner (One-to-One)

### Relationship Type:

* One-to-One

### Definition:

* A User has one Owner profile
* An Owner belongs to one User

### Implementation:

User Model:

```php
public function owner()
{
    return $this->hasOne(Owner::class);
}
```

Owner Model:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

---

## 3. Owner ↔ Livestock (One-to-Many)

### Relationship Type:

* One-to-Many

### Definition:

* An Owner can have multiple Livestock
* Each Livestock belongs to one Owner

### Implementation:

Owner Model:

```php
public function livestock()
{
    return $this->hasMany(Livestock::class);
}
```

Livestock Model:

```php
public function owner()
{
    return $this->belongsTo(Owner::class);
}
```

---

## 4. Relationship Constraints

* `owners.user_id` must reference a valid user
* `livestock.owner_id` must reference a valid owner
* Relationships must enforce referential integrity via foreign keys

---

## 5. Eager Loading Recommendations

To optimize queries, use eager loading where necessary:

Examples:

```php
Owner::with('livestock')->get();
User::with('owner')->get();
Livestock::with('owner')->get();
```

---

## 6. Naming Conventions

* Relationship methods must use singular/plural correctly:

  * `owner()` → single
  * `livestock()` → multiple

* Foreign keys:

  * user_id → in owners table
  * owner_id → in livestock table

---

## 7. Access Patterns

Examples:

* Get livestock of a user:

```php
$user->owner->livestock
```

* Get owner from livestock:

```php
$livestock->owner
```

* Get user from livestock:

```php
$livestock->owner->user
```

---

## 8. Future Extensions (Optional)

* Add `hasMany` health records in Livestock model
* Add relationships for schemes if implemented later
