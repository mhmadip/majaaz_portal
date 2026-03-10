<?php
require_once __DIR__ . "/../config.php";
require_login();
if (($_SESSION['user']['role'] ?? '') !== 'jury') json_out(["ok"=>false,"error"=>"Forbidden"], 403);

$data = read_json();
$projectId = (string)($data['projectId'] ?? '');
$pid = 0;
if (preg_match('/^p(\d+)$/', $projectId, $m)) $pid = (int)$m[1];
else $pid = (int)$projectId;
if ($pid<=0) json_out(["ok"=>false,"error"=>"Invalid projectId"], 400);

$scores = $data['scores'] ?? [];
if (!is_array($scores) || count($scores) < 1) json_out(["ok"=>false,"error"=>"Scores required"], 400);

$raw = 0;
foreach ($scores as $v) { $raw += (int)$v; }

$comment = trim((string)($data['comment'] ?? ''));
$published = !empty($data['published']) ? 1 : 0;

$stmt = $pdo->prepare("
INSERT INTO evaluations (project_id, jury_id, scores_json, raw_score, comment, published)
VALUES (?,?,?,?,?,?)
ON DUPLICATE KEY UPDATE scores_json=VALUES(scores_json), raw_score=VALUES(raw_score), comment=VALUES(comment), published=VALUES(published)
");
$stmt->execute([
  $pid,
  (int)$_SESSION['user']['id'],
  json_encode($scores, JSON_UNESCAPED_UNICODE),
  $raw,
  ($comment!==''?$comment:null),
  $published
]);

json_out(["ok"=>true]);
