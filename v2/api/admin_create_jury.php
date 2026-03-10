<?php
require_once __DIR__ . "/../config.php";
require_admin();
$data = read_json();
$name = trim((string)($data['name'] ?? ''));
$email = trim((string)($data['email'] ?? ''));
$password = (string)($data['password'] ?? '');

if ($name==='' || $email==='' || $password==='') json_out(["ok"=>false,"error"=>"Missing fields"], 400);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) json_out(["ok"=>false,"error"=>"Invalid email"], 400);
if (strlen($password) < 8) json_out(["ok"=>false,"error"=>"Weak password"], 400);

$hash = password_hash($password, PASSWORD_BCRYPT);
try {
  $stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,role) VALUES (?,?,?,'jury')");
  $stmt->execute([$name,$email,$hash]);
} catch (Throwable $e) {
  json_out(["ok"=>false,"error"=>"Email exists"], 409);
}
json_out(["ok"=>true]);
