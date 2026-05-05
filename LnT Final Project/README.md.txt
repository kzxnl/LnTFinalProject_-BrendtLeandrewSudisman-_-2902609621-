# Electronic Store CMS - RESTful API

Proyek backend RESTful API untuk sistem manajemen konten (CMS) toko elektronik, dibangun menggunakan Laravel dan JWT Authentication.

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- PostgreSQL / MySQL

## Daftar Endpoint API

### Otentikasi
- `POST /api/login` - Login admin dan dapatkan JWT Bearer Token.

### Public API (Tanpa Token)
- `GET /api/public/products` - List semua produk (Mendukung *Pagination* dan *Filtering*. Query opsional: `?category_id=x` & `?search=keyword`).
- `GET /api/public/products/{id}` - Detail produk spesifik.

### Admin API (Membutuhkan Bearer Token)
Gunakan header `Authorization: Bearer <token>` untuk mengakses endpoint ini.
- `POST /api/admin/refresh-token` - Memperbarui token yang sudah ada.
- `GET, POST, PUT, DELETE /api/admin/products` - Full CRUD produk.