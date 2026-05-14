<?php
require_once __DIR__ . "/lib.php";
require_csrf();
require_admin();

$data = read_json();
$ar   = $data['ar'] ?? [];
$en   = $data['en'] ?? [];

if (!is_array($ar) || !is_array($en) || count($ar) < 1 || count($ar) !== count($en)) {
  json_out(["ok" => false, "error" => "Invalid criteria"], 400);
}

$criteria = [
  "ar" => array_values(array_map('strval', $ar)),
  "en" => array_values(array_map('strval', $en)),
];

$path = __DIR__ . "/../criteria.json";
if (file_put_contents($path, json_encode($criteria, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) === false) {
  json_out(["ok" => false, "error" => "Could not write criteria file"], 500);
}

json_out(["ok" => true]);
