<?php
require_once __DIR__ . "/../config.php";
require_role('admin');
$title = "لوحة المدير — المشاريع";

// Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'create') {
  csrf_check_or_die();
  $name = trim($_POST['name'] ?? '');
  if ($name === '') {
    flash_set("اسم المشروع مطلوب.", "danger");
  } else {
    $stmt = $pdo->prepare("INSERT INTO projects (name) VALUES (?)");
    $stmt->execute([$name]);
    flash_set("تم إنشاء المشروع بنجاح.");
  }
  header("Location: /majaaz_portal/admin/projects.php");
  exit;
}

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
  csrf_check_or_die();
  $id = (int)($_POST['id'] ?? 0);
  if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id=?");
    $stmt->execute([$id]);
    flash_set("تم حذف المشروع.");
  }
  header("Location: /majaaz_portal/admin/projects.php");
  exit;
}

// List with pagination
$perPage = 10;
$page = max(1, (int)($_GET['page'] ?? 1));
$q = trim($_GET['q'] ?? '');
$where = "";
$params = [];
if ($q !== '') { $where="WHERE name LIKE ?"; $params[]="%{$q}%"; }

$c = $pdo->prepare("SELECT COUNT(*) AS c FROM projects {$where}");
$c->execute($params);
$total = (int)$c->fetch()['c'];
[$page, $totalPages, $offset] = paginate($total, $perPage, $page);

$stmt = $pdo->prepare("SELECT * FROM projects {$where} ORDER BY id DESC LIMIT {$perPage} OFFSET {$offset}");
$stmt->execute($params);
$projects = $stmt->fetchAll();

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
  <h1 class="h4 mb-0">إدارة المشاريع</h1>
  <div class="d-flex gap-2">
    <a class="btn btn-outline-secondary" href="/majaaz_portal/admin/jury.php">إدارة لجنة التحكيم</a>
    <a class="btn btn-outline-secondary" href="/majaaz_portal/">عرض الصفحة العامة</a>
  </div>
</div>

<div class="card shadow-sm mb-3">
  <div class="card-body">
    <form class="row g-2" method="post">
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
      <input type="hidden" name="action" value="create">
      <div class="col-md-9">
        <input class="form-control" name="name" placeholder="اسم المشروع..." required>
      </div>
      <div class="col-md-3 d-grid">
        <button class="btn btn-primary" type="submit">+ إضافة مشروع</button>
      </div>
    </form>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-2">
  <form class="d-flex gap-2" method="get">
    <input class="form-control" name="q" value="<?= e($q) ?>" placeholder="بحث...">
    <button class="btn btn-outline-secondary" type="submit">بحث</button>
  </form>
  <div class="text-muted small">المجموع: <?= (int)$total ?></div>
</div>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-dark">
        <tr><th>#</th><th>اسم المشروع</th><th>تاريخ</th><th>إجراءات</th></tr>
      </thead>
      <tbody>
        <?php if (!$projects): ?>
          <tr><td colspan="4" class="text-center text-muted p-4">لا توجد مشاريع.</td></tr>
        <?php endif; ?>
        <?php foreach ($projects as $p): ?>
          <tr>
            <td><?= (int)$p['id'] ?></td>
            <td><?= e($p['name']) ?></td>
            <td class="text-muted small"><?= e($p['created_at']) ?></td>
            <td class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-primary" href="/majaaz_portal/admin/project_images.php?id=<?= (int)$p['id'] ?>">الصور/الغلاف</a>
              <form method="post" onsubmit="return confirm('حذف المشروع؟ سيتم حذف الصور والتقييمات أيضاً.');">
                <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="btn btn-sm btn-danger" type="submit">حذف</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php if ($total > 0): ?>
  <nav class="mt-3">
    <ul class="pagination justify-content-center">
      <?php
        $mk = function($p) use ($q) {
          $qs = http_build_query(array_filter(['page'=>$p,'q'=>$q], fn($v)=>$v!=='' && $v!==null));
          return "/majaaz_portal/admin/projects.php".($qs ? "?{$qs}" : "");
        };
      ?>
      <li class="page-item <?= $page<=1?'disabled':'' ?>"><a class="page-link" href="<?= e($mk(max(1,$page-1))) ?>">السابق</a></li>
      <?php for($i=max(1,$page-2); $i<=min($totalPages,$page+2); $i++): ?>
        <li class="page-item <?= $i===$page?'active':'' ?>"><a class="page-link" href="<?= e($mk($i)) ?>"><?= $i ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?= $page>=$totalPages?'disabled':'' ?>"><a class="page-link" href="<?= e($mk(min($totalPages,$page+1))) ?>">التالي</a></li>
    </ul>
  </nav>
<?php endif; ?>

<?php include __DIR__ . "/../includes/footer.php"; ?>
