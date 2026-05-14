<?php
require_once __DIR__ . "/../config.php";
require_csrf();
require_admin();
$data = read_json();
$eid = (string)($data['evalId'] ?? '');
$id = 0;
if (preg_match('/^e(\d+)$/', $eid, $m)) $id = (int)$m[1];
else $id = (int)$eid;
if ($id <= 0) json_out(["ok"=>false,"error"=>"Invalid evalId"], 400);
$stmt = $pdo->prepare("DELETE FROM evaluations WHERE id=?");
$stmt->execute([$id]);
json_out(["ok"=>true]);
