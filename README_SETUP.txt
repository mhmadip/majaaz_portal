MAJAAZ Portal — Same Design + MySQL Backend (Fixed Authentication)

This package keeps your original UI/design and uses MySQL + PHP APIs.
It avoids the bcrypt $2b$ issue by generating the admin hash using PHP (produces $2y$).

INSTALL (XAMPP on macOS)
1) Copy folder:
   /Applications/XAMPP/xamppfiles/htdocs/majaaz_portal

2) Import DB schema:
   - Open http://localhost/phpmyadmin
   - Run: majaaz_portal/sql/schema.sql

3) Create Admin (run once):
   - Open http://localhost/majaaz_portal/setup.php
   - Confirm hash prefix shows $2y$
   - DELETE setup.php after success

LOGIN
- admin@majaaz.iq / Admin@12345

TROUBLESHOOT
- If the UI looks empty, ensure API is reachable:
  http://localhost/majaaz_portal/api/bootstrap.php
- If image upload features exist in your UI, confirm uploads folder permissions.
