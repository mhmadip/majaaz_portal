<?php
require_once __DIR__ . "/config.php";
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: /majaaz_portal/"); exit; }

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id=?");
$stmt->execute([$id]);
$project = $stmt->fetch();
if (!$project) { http_response_code(404); exit("Project not found"); }

$title = $project['name'];

$imgStmt = $pdo->prepare("SELECT * FROM project_images WHERE project_id=? ORDER BY is_cover DESC, id DESC");
$imgStmt->execute([$id]);
$images = $imgStmt->fetchAll();

$evalStmt = $pdo->prepare("
  SELECT e.*, u.name AS juror_name
  FROM evaluations e
  JOIN users u ON u.id=e.jury_id
  WHERE e.project_id=? AND e.published=1
  ORDER BY e.raw_score DESC
");
$evalStmt->execute([$id]);
$evals = $evalStmt->fetchAll();

function norm100(int $raw): int { return (int)round(($raw / MAX_SCORE) * 100); }

include __DIR__ . "/includes/header.php";
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <div>
    <h1 class="h3 mb-1"><?= e($project['name']) ?></h1>
    <div class="text-muted small">مشروع رقم <?= (int)$project['id'] ?></div>
  </div>
  <a class="btn btn-outline-secondary" href="/majaaz_portal/">رجوع</a>
</div>

<div class="card shadow-sm mb-3">
  <div class="card-body">
    <h2 class="h5 mb-3">الصور</h2>
    <?php if (!$images): ?>
      <div class="text-muted">لا توجد صور لهذا المشروع بعد.</div>
    <?php else: ?>
      <div class="row g-3">
        <?php foreach ($images as $im): ?>
          <div class="col-sm-6 col-lg-4">
            <div class="card h-100">
              <img src="/majaaz_portal/<?= e($im['file_path']) ?>" style="height:200px;object-fit:cover;">
              <div class="card-body">
                <?php if ((int)$im['is_cover'] === 1): ?><span class="badge text-bg-primary">غلاف</span><?php endif; ?>
                <div class="small text-muted mt-2"><?= e($im['description'] ?? '') ?></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="card shadow-sm">
  <div class="card-body">
    <h2 class="h5 mb-3">تقييمات لجنة التحكيم (المنشورة)</h2>
    <?php if (!$evals): ?>
      <div class="alert alert-secondary mb-0">⏳ لم تُنشر أي تقييمات لهذا المشروع بعد.</div>
    <?php else: ?>
      <div class="row g-3">
        <?php foreach ($evals as $ev): 
          $scores = json_decode($ev['scores_json'], true) ?: [];
          $raw = (int)$ev['raw_score'];
        ?>
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                  <div class="fw-bold">👤 <?= e($ev['juror_name']) ?></div>
                  <div class="text-end">
                    <div class="mono fw-bold"><?= $raw ?> / <?= MAX_SCORE ?></div>
                    <div class="text-muted small mono"><?= norm100($raw) ?> / 100</div>
                  </div>
                </div>
                <hr>
                <div class="small">
                  <?php foreach (CRITERIA as $i => $c): ?>
                    <div class="d-flex justify-content-between border-bottom py-2">
                      <div class="text-muted" style="flex:1;"><?= ($i+1) ?>. <?= e($c) ?></div>
                      <div class="mono fw-bold text-primary ms-3"><?= (int)($scores[$i] ?? 0) ?></div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <?php if (!empty($ev['comment'])): ?>
                  <div class="mt-3 p-3 bg-light rounded">"<?= e($ev['comment']) ?>"</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
