<?php
require_once __DIR__ . "/../config.php";
if (!empty($_SESSION['user'])) {
  header("Location: /majaaz_portal/");
  exit;
}
$title = "تسجيل الدخول";
$error = null;
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_check_or_die();
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($email === '' || $password === '') {
    $error = "يرجى إدخال البريد الإلكتروني وكلمة المرور.";
  } else {
    $stmt = $pdo->prepare("SELECT id, name, email, password_hash, role FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $u = $stmt->fetch();

    if ($u && password_verify($password, $u['password_hash'])) {
      session_regenerate_id(true);
      $_SESSION['user'] = [
        'id' => (int)$u['id'],
        'name' => $u['name'],
        'email' => $u['email'],
        'role' => $u['role'],
      ];
      flash_set("مرحباً بك، " . $u['name'] . "!");
      // redirect by role
      if ($u['role'] === 'admin') header("Location: /majaaz_portal/admin/projects.php");
      else header("Location: /majaaz_portal/jury/projects.php");
      exit;
    } else {
      $error = "بيانات الدخول غير صحيحة.";
    }
  }
}

include __DIR__ . "/../includes/header.php";
?>
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h1 class="h4 mb-3">تسجيل الدخول</h1>
        <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
        <form method="post">
          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input class="form-control" type="email" name="email" value="<?= e($email) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input class="form-control" type="password" name="password" required>
          </div>
          <button class="btn btn-primary w-100" type="submit">دخول</button>
        </form>
        <div class="text-muted small mt-3">
          حساب المدير الافتراضي (من schema.sql):<br>
          <span class="mono">admin@majaaz.iq</span> / <span class="mono">Admin@12345</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
