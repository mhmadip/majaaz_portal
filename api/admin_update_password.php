<?php
require_once __DIR__ . "/../config.php";
require_csrf();
require_admin();
$data = read_json();
$uid = (string)($data['userId'] ?? '');
$id = 0;
if (preg_match('/^u(\d+)$/', $uid, $m)) $id = (int)$m[1];
else $id = (int)$uid;
$pass = (string)($data['password'] ?? '');
if ($id <= 0) json_out(["ok"=>false,"error"=>"Invalid userId"], 400);
if (strlen($pass) < 4) json_out(["ok"=>false,"error"=>"Password too short"], 400);
$hash = password_hash($pass, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("UPDATE users SET password_hash=? WHERE id=?");
$stmt->execute([$hash, $id]);
json_out(["ok"=>true]);
