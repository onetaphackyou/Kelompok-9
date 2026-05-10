# TODO - Fix login pada semua role

## Step 1
- [x] Pahami struktur login & role
  - [x] Cek `routes/web.php`
  - [x] Cek `app/Http/Controllers/Auth/LoginController.php`
  - [x] Cek middleware role (`RoleMiddleware`)

## Step 2
- [ ] Rapikan `routes/web.php` agar redirect dari `LoginController` menuju route yang valid dan route role konsisten
  - [ ] Pastikan semua route role masuk ke group `middleware(['auth','role:<role>'])`
  - [ ] Pastikan `route('mahasiswa.dashboard'|'dosen.dashboard'|'admin_prodi.dashboard'|'administrator.dashboard')` benar ada
  - [ ] Hindari duplikasi/conflict route

## Step 3
- [ ] Jalankan `php artisan route:list` dan validasi route yang diperlukan ada

## Step 4
- [ ] Perbaiki fatal error PHP bila ditemukan
  - [ ] Validasi semua controller `AdminProdi/*` tidak punya whitespace/statement sebelum `namespace`

## Step 5
- [ ] Tutup error migrate terkait tabel `sessions`
  - [ ] Pastikan migrasi session tidak dijalankan ulang atau table di-ignore

## Step 6
- [ ] Test manual login untuk semua role
  - [ ] mahasiswa
  - [ ] dosen
  - [ ] admin_prodi
  - [ ] administrator

