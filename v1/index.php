<?php
require_once __DIR__ . "/config.php";
$title = "بوابة مسابقة مجاز المعمارية ٢٠٢٦";

$perPage = 9;
$page = max(1, (int)($_GET['page'] ?? 1));
$q = trim($_GET['q'] ?? '');

$where = "";
$params = [];
if ($q !== '') {
  $where = "WHERE p.name LIKE ?";
  $params[] = "%{$q}%";
}

$countStmt = $pdo->prepare("SELECT COUNT(*) AS c FROM projects p {$where}");
$countStmt->execute($params);
$total = (int)$countStmt->fetch()['c'];
[$page, $totalPages, $offset] = paginate($total, $perPage, $page);

$sql = "SELECT p.*,
        (SELECT file_path FROM project_images WHERE project_id=p.id AND is_cover=1 LIMIT 1) AS cover
        FROM projects p {$where}
        ORDER BY p.id DESC
        LIMIT {$perPage} OFFSET {$offset}";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();

include __DIR__ . "/includes/header.php";
?>
<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
  <div>
    <h1 class="h3 mb-1">المشاريع المشاركة</h1>
    <div class="text-muted small">استعراض مشاريع مسابقة مجاز — يمكن مشاهدة التقييمات المنشورة فقط</div>
  </div>
  <form class="d-flex gap-2" method="get" action="/majaaz_portal/">
    <input class="form-control" style="min-width:220px" name="q" value="<?= e($q) ?>" placeholder="بحث باسم المشروع...">
    <button class="btn btn-outline-secondary" type="submit">بحث</button>
  </form>
</div>

<div class="row g-3">
  <?php if (!$projects): ?>
    <div class="col-12"><div class="alert alert-secondary">لا توجد مشاريع.</div></div>
  <?php endif; ?>

  <?php foreach ($projects as $p): ?>
    <div class="col-sm-6 col-lg-4">
      <a href="/majaaz_portal/project.php?id=<?= (int)$p['id'] ?>" class="text-decoration-none">
        <div class="card shadow-sm h-100">
          <?php if (!empty($p['cover'])): ?>
            <img src="/majaaz_portal/<?= e($p['cover']) ?>" class="card-img-top" style="height:190px;object-fit:cover;border-top-left-radius:16px;border-top-right-radius:16px;">
          <?php else: ?>
            <div class="d-flex align-items-center justify-content-center text-muted" style="height:190px;background:#eef2f7;border-top-left-radius:16px;border-top-right-radius:16px;">
              لا توجد صورة غلاف
            </div>
          <?php endif; ?>
          <div class="card-body">
            <div class="fw-bold"><?= e($p['name']) ?></div>
            <div class="text-muted small">#<?= (int)$p['id'] ?> • <?= e($p['created_at']) ?></div>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</div>

<?php if ($total > 0): ?>
  <nav class="mt-4">
    <ul class="pagination justify-content-center">
      <?php
        $mk = function($p) use ($q) {
          $qs = http_build_query(array_filter(['page'=>$p,'q'=>$q], fn($v)=>$v!=='' && $v!==null));
          return "/majaaz_portal/".($qs ? "?{$qs}" : "");
        };
      ?>
      <li class="page-item <?= $page<=1?'disabled':'' ?>"><a class="page-link" href="<?= e($mk(max(1,$page-1))) ?>">السابق</a></li>
      <?php
        $win=2; $start=max(1,$page-$win); $end=min($totalPages,$page+$win);
        if($start>1){ echo '<li class="page-item"><a class="page-link" href="'.e($mk(1)).'">1</a></li>'; if($start>2) echo '<li class="page-item disabled"><span class="page-link">…</span></li>'; }
        for($i=$start;$i<=$end;$i++){ $a=$i===$page?'active':''; echo '<li class="page-item '.$a.'"><a class="page-link" href="'.e($mk($i)).'">'.$i.'</a></li>'; }
        if($end<$totalPages){ if($end<$totalPages-1) echo '<li class="page-item disabled"><span class="page-link">…</span></li>'; echo '<li class="page-item"><a class="page-link" href="'.e($mk($totalPages)).'">'.$totalPages.'</a></li>'; }
      ?>
      <li class="page-item <?= $page>=$totalPages?'disabled':'' ?>"><a class="page-link" href="<?= e($mk(min($totalPages,$page+1))) ?>">التالي</a></li>
    </ul>
  </nav>
<?php endif; ?>

<?php include __DIR__ . "/includes/footer.php"; ?>
