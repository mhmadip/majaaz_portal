<?php
require_once __DIR__ . "/../config.php";
require_role('jury');
$title = "تقييماتي";

$stmt = $pdo->prepare("
  SELECT e.*, p.name AS project_name
  FROM evaluations e
  JOIN projects p ON p.id=e.project_id
  WHERE e.jury_id=?
  ORDER BY e.saved_at DESC
");
$stmt->execute([(int)$_SESSION['user']['id']]);
$evals = $stmt->fetchAll();

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 mb-0">تقييماتي</h1>
  <a class="btn btn-outline-secondary" href="/majaaz_portal/jury/projects.php">رجوع</a>
</div>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-dark"><tr><th>المشروع</th><th>الدرجة</th><th>من 100</th><th>الحالة</th><th>آخر حفظ</th></tr></thead>
      <tbody>
        <?php if (!$evals): ?>
          <tr><td colspan="5" class="text-center text-muted p-4">لا توجد تقييمات بعد.</td></tr>
        <?php endif; ?>
        <?php foreach ($evals as $ev): 
          $raw=(int)$ev['raw_score'];
          $norm=(int)round(($raw/MAX_SCORE)*100);
        ?>
          <tr>
            <td><?= e($ev['project_name']) ?></td>
            <td class="mono text-primary fw-bold"><?= $raw ?>/<?= MAX_SCORE ?></td>
            <td class="mono text-muted"><?= $norm ?>/100</td>
            <td><?= ((int)$ev['published']===1)?'<span class="badge text-bg-success">منشور</span>':'<span class="badge text-bg-warning">محفوظ</span>' ?></td>
            <td class="text-muted small"><?= e($ev['saved_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
