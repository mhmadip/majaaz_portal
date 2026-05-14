<?php
require_once __DIR__ . "/../config.php";
require_csrf();
require_admin();
$data = read_json();
$uid = (string)($data['userId'] ?? '');
$id = 0;
if (preg_match('/^u(\d+)$/', $uid, $m)) $id = (int)$m[1];
else $id = (int)$uid;
if ($id <= 0) json_out(["ok"=>false,"error"=>"Invalid userId"], 400);
// Prevent deleting self
if ($id === (int)$_SESSION['user']['id']) json_out(["ok"=>false,"error"=>"Cannot delete yourself"], 400);
$stmt = $pdo->prepare("DELETE FROM users WHERE id=? AND role='jury'");
$stmt->execute([$id]);
json_out(["ok"=>true]);
