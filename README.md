# CasinoControl - Proyecto completo (Frontend + Backend skeleton)

**Contenido**
- Frontend pages (index.php, casinos.php, seguridad.php, horarios.php, novedades.php, reportes.php)
- Components (navbar)
- styles.css, scripts.js (frontend behavior and sample data)
- Backend skeleton: config/db.php (PDO), api/casinos.php (API endpoint to list/get casinos)
- DB schema: db/schema.sql and db/seed.sql

**How to run**
1. Place project in your PHP-enabled webserver (e.g., XAMPP htdocs).
2. Create a MySQL database or import `db/schema.sql`.
3. Adjust `config/db.php` credentials or set environment variables DB_HOST, DB_NAME, DB_USER, DB_PASS.
4. Access `index.php` in browser.

This ZIP contains a full working frontend and a backend skeleton with an API endpoint to list casinos (api/casinos.php).


## Updated features
- CRUD endpoints for casinos, novedades, control_horarios (api/*.php)
- Simple session-based authentication (auth/login.php, auth/logout.php)
- Export endpoints: api/export.php for CSV, XLS (HTML table) and printable HTML for PDF

Login note: create a user in `users` table. You can generate a bcrypt hash in PHP with password_hash('admin123', PASSWORD_DEFAULT) and insert into users.
