<?php
declare(strict_types=1);
session_start();

$dbHost="127.0.0.1";
$dbName="majaaz_portal";
$dbUser="root";
$dbPass="";

$dsn="mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
$options=[
  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES=>false,
];
try{ $pdo=new PDO($dsn,$dbUser,$dbPass,$options); }
catch(Throwable $e){ http_response_code(500); exit("DB connection failed: ".htmlspecialchars($e->getMessage())); }

header("X-Content-Type-Options: nosniff");

function json_out($data, int $code=200): void{
  http_response_code($code);
  header("Content-Type: application/json; charset=utf-8");
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}
function require_login(): void{
  if(empty($_SESSION['user'])) json_out(["ok"=>false,"error"=>"Unauthorized"], 401);
}
function require_admin(): void{
  require_login();
  if(($_SESSION['user']['role'] ?? '')!=='admin') json_out(["ok"=>false,"error"=>"Forbidden"], 403);
}
function read_json(): array{
  $raw = file_get_contents("php://input") ?: "";
  $d = json_decode($raw, true);
  return is_array($d) ? $d : [];
}
function safe_file_ext(string $name): string{
  $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  $allowed = ['jpg','jpeg','png','webp'];
  return in_array($ext,$allowed,true) ? $ext : '';
}
