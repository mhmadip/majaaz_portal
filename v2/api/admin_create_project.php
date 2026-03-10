<?php
require_once __DIR__ . "/../config.php";
require_admin();
$data = read_json();
$name = trim((string)($data['name'] ?? ''));
if ($name==='') json_out(["ok"=>false,"error"=>"Name required"], 400);

$stmt = $pdo->prepare("INSERT INTO projects (name) VALUES (?)");
$stmt->execute([$name]);

json_out(["ok"=>true]);
