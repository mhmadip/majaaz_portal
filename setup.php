<?php
require __DIR__ . "/config.php";

$email = "admin@majaaz.iq";
$password = "Admin@12345";

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,role)
VALUES ('المدير العام',?,?, 'admin')
ON DUPLICATE KEY UPDATE password_hash=VALUES(password_hash), role='admin', name=VALUES(name)");
$stmt->execute([$email,$hash]);

echo "Admin created/updated successfully.<br>";
echo "Email: <b>admin@majaaz.iq</b><br>";
echo "Password: <b>Admin@12345</b><br>";
echo "Hash prefix: <b>" . substr($hash,0,4) . "</b><br><br>";
echo "<b>IMPORTANT:</b> Delete <code>setup.php</code> after running.";
