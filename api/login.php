<?php
require_once __DIR__ . "/../config.php";
$data = read_json();
$email = trim((string)($data['email'] ?? ''));
$pass  = (string)($data['password'] ?? '');

if ($email === '' || $pass === '') json_out(["ok"=>false,"error"=>"Missing fields"], 400);

$stmt = $pdo->prepare("SELECT id,name,email,password_hash,role FROM users WHERE email=? LIMIT 1");
$stmt->execute([$email]);
$u = $stmt->fetch();
if (!$u || !password_verify($pass, $u['password_hash'])) json_out(["ok"=>false,"error"=>"Invalid credentials"], 401);

session_regenerate_id(true);
$_SESSION['user'] = [
  "id" => (int)$u['id'],
  "name" => $u['name'],
  "email" => $u['email'],
  "role" => $u['role']
];

json_out(["ok"=>true,"user"=>$_SESSION['user']]);
