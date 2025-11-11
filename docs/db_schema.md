## Database Schema

### users
- id: bigint, primary key
- name: string(255)
- email: string(255), unique
- email_verified_at: timestamp nullable
- password: string(255)
- remember_token: string(100) nullable
- created_at / updated_at

### locations
- id: bigint, primary key
- name: string(255), required
- address: string(255), nullable
- latitude: decimal(10,7), nullable
- longitude: decimal(10,7), nullable
- type: string(255), nullable
- status: tinyInteger, default 1 (1=active, 0=inactive)
- meta: json, nullable
- created_at / updated_at

Notes:
- `locations.status` is used to quickly enable/disable a location.
- `locations.meta` can store extra attributes without schema changes.


