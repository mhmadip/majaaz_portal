<?php
require_once __DIR__ . "/../config.php";
require_role('admin');

$projectId = (int)($_GET['id'] ?? 0);
if ($projectId <= 0) { header("Location: /majaaz_portal/admin/projects.php"); exit; }

$pstmt = $pdo->prepare("SELECT * FROM projects WHERE id=?");
$pstmt->execute([$projectId]);
$project = $pstmt->fetch();
if (!$project) { http_response_code(404); exit("Project not found"); }

$title = "صور المشروع — " . $project['name'];

// Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'upload') {
  csrf_check_or_die();

  if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    flash_set("فشل رفع الصورة.", "danger");
    header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}"); exit;
  }

  $desc = trim($_POST['description'] ?? '');

  $tmp = $_FILES['image']['tmp_name'];
  $orig = $_FILES['image']['name'] ?? 'image';
  $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
  $allowed = ['jpg','jpeg','png','webp'];
  if (!in_array($ext, $allowed, true)) {
    flash_set("الامتداد غير مدعوم. استخدم JPG/PNG/WebP.", "danger");
    header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}"); exit;
  }

  $safe = bin2hex(random_bytes(12)) . "." . $ext;
  $relPath = "uploads/" . $safe;
  $dest = __DIR__ . "/../" . $relPath;

  if (!move_uploaded_file($tmp, $dest)) {
    flash_set("تعذر حفظ الملف داخل uploads. تأكد من صلاحيات الكتابة.", "danger");
    header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}"); exit;
  }

  $stmt = $pdo->prepare("INSERT INTO project_images (project_id, file_path, description) VALUES (?,?,?)");
  $stmt->execute([$projectId, $relPath, ($desc !== '' ? $desc : null)]);
  flash_set("تم رفع الصورة.");
  header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}");
  exit;
}

// Set cover
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'set_cover') {
  csrf_check_or_die();
  $imgId = (int)($_POST['img_id'] ?? 0);
  $pdo->beginTransaction();
  $pdo->prepare("UPDATE project_images SET is_cover=0 WHERE project_id=?")->execute([$projectId]);
  $pdo->prepare("UPDATE project_images SET is_cover=1 WHERE id=? AND project_id=?")->execute([$imgId, $projectId]);
  $pdo->commit();
  flash_set("تم تعيين صورة الغلاف.");
  header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}");
  exit;
}

// Delete image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_image') {
  csrf_check_or_die();
  $imgId = (int)($_POST['img_id'] ?? 0);
  $stmt = $pdo->prepare("SELECT file_path FROM project_images WHERE id=? AND project_id=?");
  $stmt->execute([$imgId, $projectId]);
  $im = $stmt->fetch();
  if ($im) {
    $pdo->prepare("DELETE FROM project_images WHERE id=? AND project_id=?")->execute([$imgId, $projectId]);
    $fp = __DIR__ . "/../" . $im['file_path'];
    if (is_file($fp)) @unlink($fp);
    flash_set("تم حذف الصورة.");
  }
  header("Location: /majaaz_portal/admin/project_images.php?id={$projectId}");
  exit;
}

$imgs = $pdo->prepare("SELECT * FROM project_images WHERE project_id=? ORDER BY is_cover DESC, id DESC");
$imgs->execute([$projectId]);
$images = $imgs->fetchAll();

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <div>
    <h1 class="h4 mb-1">صور المشروع</h1>
    <div class="text-muted small"><?= e($project['name']) ?> — #<?= (int)$projectId ?></div>
  </div>
  <a class="btn btn-outline-secondary" href="/majaaz_portal/admin/projects.php">رجوع</a>
</div>

<div class="card shadow-sm mb-3">
  <div class="card-body">
    <form method="post" enctype="multipart/form-data" class="row g-2">
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
      <input type="hidden" name="action" value="upload">
      <div class="col-md-5">
        <input class="form-control" type="file" name="image" accept="image/*" required>
      </div>
      <div class="col-md-5">
        <input class="form-control" name="description" placeholder="وصف اختياري للصورة...">
      </div>
      <div class="col-md-2 d-grid">
        <button class="btn btn-primary" type="submit">رفع</button>
      </div>
    </form>
    <div class="text-muted small mt-2">ملاحظة: قد تحتاج لتعديل صلاحيات مجلد <span class="mono">uploads</span> ليكون قابلاً للكتابة.</div>
  </div>
</div>

<div class="row g-3">
  <?php if (!$images): ?>
    <div class="col-12"><div class="alert alert-secondary">لا توجد صور بعد.</div></div>
  <?php endif; ?>

  <?php foreach ($images as $im): ?>
    <div class="col-sm-6 col-lg-4">
      <div class="card shadow-sm h-100">
        <img src="/majaaz_portal/<?= e($im['file_path']) ?>" style="height:200px;object-fit:cover;border-top-left-radius:16px;border-top-right-radius:16px;">
        <div class="card-body">
          <?php if ((int)$im['is_cover']===1): ?><span class="badge text-bg-primary">غلاف</span><?php endif; ?>
          <div class="small text-muted mt-2"><?= e($im['description'] ?? '') ?></div>
          <div class="d-flex gap-2 mt-3">
            <form method="post" class="d-inline">
              <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
              <input type="hidden" name="action" value="set_cover">
              <input type="hidden" name="img_id" value="<?= (int)$im['id'] ?>">
              <button class="btn btn-sm btn-outline-primary" type="submit">تعيين كغلاف</button>
            </form>
            <form method="post" class="d-inline" onsubmit="return confirm('حذف الصورة؟');">
              <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
              <input type="hidden" name="action" value="delete_image">
              <input type="hidden" name="img_id" value="<?= (int)$im['id'] ?>">
              <button class="btn btn-sm btn-danger" type="submit">حذف</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
