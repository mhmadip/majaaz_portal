<?php
require_once __DIR__ . "/../config.php";
require_role('jury');
$title = "لوحة المحكّم — المشاريع";

$perPage = 10;
$page = max(1, (int)($_GET['page'] ?? 1));
$q = trim($_GET['q'] ?? '');

$where = "";
$params = [];
if ($q !== '') { $where="WHERE p.name LIKE ?"; $params[]="%{$q}%"; }

$count = $pdo->prepare("SELECT COUNT(*) AS c FROM projects p {$where}");
$count->execute($params);
$total = (int)$count->fetch()['c'];
[$page, $totalPages, $offset] = paginate($total, $perPage, $page);

$sql = "SELECT p.*,
        (SELECT file_path FROM project_images WHERE project_id=p.id AND is_cover=1 LIMIT 1) AS cover,
        (SELECT published FROM evaluations WHERE project_id=p.id AND jury_id=? LIMIT 1) AS my_published,
        (SELECT raw_score FROM evaluations WHERE project_id=p.id AND jury_id=? LIMIT 1) AS my_raw
        FROM projects p {$where}
        ORDER BY p.id DESC
        LIMIT {$perPage} OFFSET {$offset}";
$stmt = $pdo->prepare($sql);
$stmt->execute(array_merge([(int)$_SESSION['user']['id'], (int)$_SESSION['user']['id']], $params));
$projects = $stmt->fetchAll();

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
  <h1 class="h4 mb-0">مشاريع للتحكيم</h1>
  <a class="btn btn-outline-secondary" href="/majaaz_portal/jury/my_evals.php">تقييماتي</a>
</div>

<form class="d-flex gap-2 mb-3" method="get">
  <input class="form-control" name="q" value="<?= e($q) ?>" placeholder="بحث...">
  <button class="btn btn-outline-secondary" type="submit">بحث</button>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-dark">
        <tr><th>#</th><th>المشروع</th><th>حالة تقييمي</th><th>إجراء</th></tr>
      </thead>
      <tbody>
        <?php if (!$projects): ?>
          <tr><td colspan="4" class="text-center text-muted p-4">لا توجد مشاريع.</td></tr>
        <?php endif; ?>
        <?php foreach ($projects as $p): ?>
          <tr>
            <td><?= (int)$p['id'] ?></td>
            <td>
              <div class="fw-bold"><?= e($p['name']) ?></div>
              <div class="text-muted small"><a href="/majaaz_portal/project.php?id=<?= (int)$p['id'] ?>">عرض عام</a></div>
            </td>
            <td>
              <?php if ($p['my_raw'] === null): ?>
                <span class="badge text-bg-secondary">لم يتم</span>
              <?php else: ?>
                <span class="badge <?= ((int)$p['my_published']===1)?'text-bg-success':'text-bg-warning' ?>">
                  <?= ((int)$p['my_published']===1)?'منشور':'محفوظ' ?>
                </span>
                <span class="mono ms-2"><?= (int)$p['my_raw'] ?>/<?= MAX_SCORE ?></span>
              <?php endif; ?>
            </td>
            <td>
              <a class="btn btn-sm btn-primary" href="/majaaz_portal/jury/evaluate.php?project_id=<?= (int)$p['id'] ?>">تقييم</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
