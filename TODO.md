# Fix Laravel LMS Errors - TODO

## Current Progress: 2/8 steps completed ✅

### Step 1: Comment out conflicting Laravel default users migration ✓
### Step 2: Fix User model (add casts, traits, PK config) ✓
- Target: `app/Models/User.php`

### Step 3: Fix AuthController login to use email instead of nama ✓
- Target: `app/Http/Controllers/AuthController.php`

### Step 3: Fix AuthController login to use email instead of nama
- Target: `app/Http/Controllers/AuthController.php`

### Step 4: Fix all custom 2026 migrations (correct table/column names, add FKs)
- Targets: 9 migration files in `database/migrations/2026_01_01_00000*.php`

### Step 5: Recreate corrupted login.blade.php
- Target: `resources/views/auth/login.blade.php`

### Step 6: Add missing dashboard route redirect
- Target: `routes/web.php`

### Step 7: Run php artisan migrate:fresh
- Execute command

### Step 8: Test login and dashboard
- Verify fixes

**Next Action**: Execute Step 1
