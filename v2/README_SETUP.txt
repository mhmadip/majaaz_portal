KEEP YOUR ORIGINAL DESIGN (Option B)
This package keeps your exact HTML/CSS design and connects it to MySQL via PHP APIs.

1) Copy folder to XAMPP htdocs:
   /Applications/XAMPP/xamppfiles/htdocs/majaaz_portal

2) Import DB:
   - http://localhost/phpmyadmin
   - Run: majaaz_portal/sql/schema.sql

3) Open:
   http://localhost/majaaz_portal/

4) Login with admin:
   admin@majaaz.iq / Admin@12345

Notes:
- This build loads DB data using api/bootstrap.php and logs in using api/login.php.
- If you see blank content, open DevTools console and check for errors.
