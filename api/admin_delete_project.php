<?php
require_once __DIR__ . "/../config.php";
require_admin();
$data = read_json();
$pidStr = (string)($data['projectId'] ?? '');
$pid = 0;
if (preg_match('/^p(\d+)$/', $pidStr, $m)) $pid = (int)$m[1];
else $pid = (int)($data['projectId'] ?? 0);
if ($pid<=0) json_out(["ok"=>false,"error"=>"Invalid projectId"], 400);

$stmt = $pdo->prepare("DELETE FROM projects WHERE id=?");
$stmt->execute([$pid]);
json_out(["ok"=>true]);
