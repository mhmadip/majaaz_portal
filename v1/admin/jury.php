<?php
require_once __DIR__ . "/../config.php";
require_role('admin');
$title = "لوحة المدير — لجنة التحكيم";

// Create juror
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create') {
  csrf_check_or_die();
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';

  if ($name==='' || $email==='' || $pass==='') {
    flash_set("جميع الحقول مطلوبة.", "danger");
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set("البريد الإلكتروني غير صحيح.", "danger");
  } elseif (strlen($pass) < 8) {
    flash_set("كلمة المرور يجب أن تكون 8 أحرف على الأقل.", "danger");
  } else {
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    try {
      $stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,role) VALUES (?,?,?,'jury')");
      $stmt->execute([$name,$email,$hash]);
      flash_set("تم إنشاء حساب محكّم.");
    } catch (Throwable $e) {
      flash_set("تعذر إنشاء الحساب (قد يكون البريد مستخدم).", "danger");
    }
  }
  header("Location: /majaaz_portal/admin/jury.php");
  exit;
}

// Delete juror
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
  csrf_check_or_die();
  $id = (int)($_POST['id'] ?? 0);
  if ($id > 0) {
    // prevent deleting self
    if ($id === (int)($_SESSION['user']['id'] ?? -1)) {
      flash_set("لا يمكن حذف حسابك الحالي.", "danger");
    } else {
      $stmt = $pdo->prepare("DELETE FROM users WHERE id=? AND role='jury'");
      $stmt->execute([$id]);
      flash_set("تم حذف المحكّم.");
    }
  }
  header("Location: /majaaz_portal/admin/jury.php");
  exit;
}

$jury = $pdo->query("SELECT id,name,email,created_at FROM users WHERE role='jury' ORDER BY id DESC")->fetchAll();

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
  <h1 class="h4 mb-0">إدارة لجنة التحكيم</h1>
  <div class="d-flex gap-2">
    <a class="btn btn-outline-secondary" href="/majaaz_portal/admin/projects.php">إدارة المشاريع</a>
  </div>
</div>

<div class="card shadow-sm mb-3">
  <div class="card-body">
    <h2 class="h6 mb-3">إضافة محكّم</h2>
    <form method="post" class="row g-2">
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
      <input type="hidden" name="action" value="create">
      <div class="col-md-4"><input class="form-control" name="name" placeholder="الاسم" required></div>
      <div class="col-md-4"><input class="form-control" type="email" name="email" placeholder="البريد الإلكتروني" required></div>
      <div class="col-md-3"><input class="form-control" type="password" name="password" placeholder="كلمة المرور" required></div>
      <div class="col-md-1 d-grid"><button class="btn btn-primary" type="submit">+</button></div>
    </form>
  </div>
</div>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-dark"><tr><th>#</th><th>الاسم</th><th>البريد</th><th>تاريخ</th><th>إجراء</th></tr></thead>
      <tbody>
        <?php if (!$jury): ?>
          <tr><td colspan="5" class="text-center text-muted p-4">لا يوجد محكّمين.</td></tr>
        <?php endif; ?>
        <?php foreach ($jury as $j): ?>
          <tr>
            <td><?= (int)$j['id'] ?></td>
            <td><?= e($j['name']) ?></td>
            <td class="mono"><?= e($j['email']) ?></td>
            <td class="text-muted small"><?= e($j['created_at']) ?></td>
            <td>
              <form method="post" onsubmit="return confirm('حذف المحكّم؟ سيتم حذف تقييماته كذلك.');">
                <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$j['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
