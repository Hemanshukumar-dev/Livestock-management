# Routes Specification: Livestock Ownership Database System

## 1. General Notes

* All routes must be defined in `routes/web.php`
* Use Laravel middleware for authentication and role-based access
* Use RESTful conventions for CRUD operations
* Group routes logically using prefixes and middleware

---

## 2. Middleware Requirements

### Authentication Middleware

* `auth` → ensures user is logged in

### Role-Based Middleware (to be implemented)

* `isAdmin` → allows only admin users
* `isOwner` → allows only owner users

---

## 3. Authentication Routes

Handled using Laravel built-in authentication:

Routes:

* GET /login → show login form
* POST /login → authenticate user
* POST /logout → logout user
* GET /register → show registration form
* POST /register → register new user

Access:

* Public (no authentication required)

---

## 4. Dashboard Route

Route:

* GET /dashboard

Controller:

* DashboardController@index

Access:

* Authenticated users only

Behavior:

* If admin → show system-wide stats
* If owner → show personal livestock stats

---

## 5. Owner Routes

Prefix: `/owners`
Middleware: `auth`, `isAdmin`

### Routes:

* GET /owners
  → OwnerController@index
  → List all owners

* GET /owners/create
  → OwnerController@create
  → Show form to create owner

* POST /owners
  → OwnerController@store
  → Save new owner

* GET /owners/{id}/edit
  → OwnerController@edit
  → Show edit form

* PUT /owners/{id}
  → OwnerController@update
  → Update owner

* DELETE /owners/{id}
  → OwnerController@destroy
  → Delete owner

---

## 6. Livestock Routes

Prefix: `/livestock`
Middleware: `auth`

### Routes:

* GET /livestock
  → LivestockController@index
  → List livestock
  → Admin: all livestock
  → Owner: only their livestock

* GET /livestock/create
  → LivestockController@create
  → Show form to add livestock

* POST /livestock
  → LivestockController@store
  → Save livestock

* GET /livestock/{id}/edit
  → LivestockController@edit
  → Show edit form

* PUT /livestock/{id}
  → LivestockController@update
  → Update livestock

* DELETE /livestock/{id}
  → LivestockController@destroy
  → Delete livestock

---

## 7. Route Grouping (Laravel Structure)

All routes should be grouped as follows:

```php
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('owners', OwnerController::class);
    });

    Route::resource('livestock', LivestockController::class);
});
```

---

## 8. Access Control Logic

### Admin:

* Full access to:

  * Owners
  * Livestock
  * Dashboard

### Owner:

* No access to owner management routes
* Can only:

  * View their livestock
  * Add/edit/delete their livestock

---

## 9. Validation Expectations

Each route handling POST/PUT must validate:

### Owner:

* phone → required
* address → required

### Livestock:

* type → required
* breed → optional
* age → optional (integer)
* health_status → default if not provided

---

## 10. Naming Conventions

* Route names should follow Laravel standards:

  * owners.index
  * owners.create
  * livestock.store

* Controllers must be:

  * OwnerController
  * LivestockController
  * DashboardController

---

## 11. Future Extensions (Optional)

* API routes in `routes/api.php`
* Pagination for listing routes
* Search/filter endpoints
* AJAX-based CRUD operations
