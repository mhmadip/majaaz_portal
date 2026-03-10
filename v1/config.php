<?php
declare(strict_types=1);

session_start();

// === DB CONFIG (XAMPP defaults) ===
$dbHost = "127.0.0.1";
$dbName = "majaaz_portal";
$dbUser = "root";
$dbPass = ""; // XAMPP default

$dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";

$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (Throwable $e) {
  http_response_code(500);
  exit("DB connection failed: " . htmlspecialchars($e->getMessage()));
}

// CSRF token (for POST forms)
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function require_login(): void {
  if (empty($_SESSION['user'])) {
    header("Location: /majaaz_portal/auth/login.php");
    exit;
  }
}

function require_role(string $role): void {
  require_login();
  if (($_SESSION['user']['role'] ?? '') !== $role) {
    http_response_code(403);
    exit("Forbidden");
  }
}

function csrf_check_or_die(): void {
  if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
    http_response_code(403);
    exit("Invalid CSRF token");
  }
}

function flash_set(string $msg, string $type='success'): void {
  $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}

function flash_get(): ?array {
  $f = $_SESSION['flash'] ?? null;
  unset($_SESSION['flash']);
  return $f;
}

function paginate(int $total, int $perPage, int $page): array {
  $totalPages = max(1, (int)ceil($total / $perPage));
  $page = max(1, min($page, $totalPages));
  $offset = ($page - 1) * $perPage;
  return [$page, $totalPages, $offset];
}

// 8 criteria as per your HTML
const CRITERIA = [
  'يهدف المشروع إلى حل مشكلة محددة وواقعية (اجتماعية، جغرافية، ثقافية، وظيفية)',
  'يقترح المشروع خطة حل واضحة وناجحة للمشكلة المطروحة',
  'يُظهر الطالب منطقاً تصميمياً قوياً في قراراته (الكتلة، التوزيع، الفتحات، الحركة)',
  'لا يعاني المشروع من إشكاليات وظيفية جوهرية',
  'يبدو المشروع متناغماً مع موقعه ومتكيفاً مع بيئته المحلية والجغرافية',
  'يستجيب المشروع للمناخ والمواد المحلية وتقاليد البناء في المنطقة',
  'الرسومات المقدمة (ثنائية وثلاثية الأبعاد) مفصّلة وواضحة وتشرح المشروع بشكل جيد',
  'يعكس المشروع جدية الطالب واجتهاده الواضح'
];
const MAX_SCORE = 80; // 8 criteria * 10
