## Routing Overview

### Public
- GET `/` → returns `welcome` view
- Auth routes (provided by Breeze in `routes/auth.php`):
  - GET `/login` → `login` view
  - POST `/login` → authenticate
  - POST `/logout` → logout
  - Password reset & email verification endpoints as scaffolded

### Authenticated (middleware: `auth`)
- GET `/dashboard` → `dashboard` view (also requires `verified`)

- Profile
  - GET `/profile` → `ProfileController@edit`
  - PATCH `/profile` → `ProfileController@update`
  - DELETE `/profile` → `ProfileController@destroy`

- Locations (CRUD)
  - GET `/locations` → `LocationController@index` (list, DataTables)
  - GET `/locations/create` → `LocationController@create`
  - POST `/locations` → `LocationController@store`
  - GET `/locations/{location}/edit` → `LocationController@edit`
  - PUT `/locations/{location}` → `LocationController@update`
  - DELETE `/locations/{location}` → `LocationController@destroy`

- Import
  - POST `/locations/import` → `LocationController@importCsv` (upload `.csv` and insert)

- API (for DataTables)
  - GET `/api/locations` → `LocationController@apiList` (server-side processing)

### Auth requirements
- All `/locations*` and `/api/locations` endpoints require authentication.
- `/login`, `/register` (if enabled), and password reset routes are public.


