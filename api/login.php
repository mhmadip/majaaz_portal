<?php
require_once __DIR__ . "/../config.php";

/* ══ RATE LIMITING ══ */
$ip          = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$windowSecs  = 15 * 60;
$maxAttempts = 10;

$pdo->prepare("DELETE FROM login_attempts WHERE attempted_at < DATE_SUB(NOW(), INTERVAL ? SECOND)")
    ->execute([$windowSecs]);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM login_attempts WHERE ip=? AND attempted_at > DATE_SUB(NOW(), INTERVAL ? SECOND)");
$stmt->execute([$ip, $windowSecs]);
$recentFails = (int)$stmt->fetchColumn();

if ($recentFails >= $maxAttempts) {
  json_out(["ok" => false, "error" => "Too many failed attempts. Please wait 15 minutes."], 429);
}

/* ══ CREDENTIALS ══ */
$data  = read_json();
$email = trim((string)($data['email'] ?? ''));
$pass  = (string)($data['password'] ?? '');

if ($email === '' || $pass === '') {
  json_out(["ok" => false, "error" => "Missing fields"], 400);
}

$stmt = $pdo->prepare("SELECT id,name,email,password_hash,role FROM users WHERE email=? LIMIT 1");
$stmt->execute([$email]);
$u = $stmt->fetch();

if (!$u || !password_verify($pass, $u['password_hash'])) {
  $pdo->prepare("INSERT INTO login_attempts (ip) VALUES (?)")->execute([$ip]);
  json_out(["ok" => false, "error" => "Invalid credentials"], 401);
}

$pdo->prepare("DELETE FROM login_attempts WHERE ip=?")->execute([$ip]);

// Store user in session — id as integer for PHP use
$_SESSION['user'] = [
  "id"    => (int)$u['id'],
  "name"  => $u['name'],
  "email" => $u['email'],
  "role"  => $u['role']
];

json_out([
  "ok"        => true,
  "user"      => $_SESSION['user'],
  "csrfToken" => csrf_token()
]);
