MAJAAZ Architectural Competition Portal (Production-like localhost package)
Stack: PHP (PDO) + MySQL + XAMPP on macOS

1) Copy folder:
   Put the folder "majaaz_portal" into:
   /Applications/XAMPP/xamppfiles/htdocs/

   Final path:
   /Applications/XAMPP/xamppfiles/htdocs/majaaz_portal/

2) Create DB + tables:
   - Open http://localhost/phpmyadmin
   - Create database "majaaz_portal" (or just run schema.sql)
   - Run: majaaz_portal/sql/schema.sql

3) Permissions for uploads:
   The folder majaaz_portal/uploads must be writable by Apache.
   If uploads fail, run in Terminal:
     sudo chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/majaaz_portal/uploads

4) URLs:
   Public:
     http://localhost/majaaz_portal/

   Login:
     http://localhost/majaaz_portal/auth/login.php

   Default Admin:
     email: admin@majaaz.iq
     password: Admin@12345

   Admin panel:
     http://localhost/majaaz_portal/admin/projects.php

   Jury panel (after creating jury accounts):
     http://localhost/majaaz_portal/jury/projects.php

Notes for real production hosting:
- Use HTTPS + secure cookies
- Put DB creds in environment variables
- Add rate limiting + lockout for login
- Add server-side image validation/scanning
- Backup strategy for DB + uploads
