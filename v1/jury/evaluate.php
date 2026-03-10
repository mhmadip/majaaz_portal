<?php
require_once __DIR__ . "/../config.php";
require_role('jury');

$projectId = (int)($_GET['project_id'] ?? 0);
if ($projectId <= 0) { header("Location: /majaaz_portal/jury/projects.php"); exit; }

$p = $pdo->prepare("SELECT * FROM projects WHERE id=?");
$p->execute([$projectId]);
$project = $p->fetch();
if (!$project) { http_response_code(404); exit("Project not found"); }

$title = "تقييم — " . $project['name'];

$existingStmt = $pdo->prepare("SELECT * FROM evaluations WHERE project_id=? AND jury_id=?");
$existingStmt->execute([$projectId, (int)$_SESSION['user']['id']]);
$existing = $existingStmt->fetch();

$locked = $existing && (int)$existing['published'] === 1;
$scores = array_fill(0, count(CRITERIA), 0);
$comment = "";
if ($existing) {
  $decoded = json_decode($existing['scores_json'], true);
  if (is_array($decoded)) $scores = array_replace($scores, $decoded);
  $comment = (string)($existing['comment'] ?? '');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_check_or_die();
  if ($locked) {
    flash_set("هذا التقييم منشور ولا يمكن تعديله.", "danger");
    header("Location: /majaaz_portal/jury/evaluate.php?project_id={$projectId}"); exit;
  }

  $newScores = [];
  foreach (CRITERIA as $i => $_) {
    $v = (int)($_POST['c'.$i] ?? 0);
    if ($v < 1 || $v > 10) {
      flash_set("يرجى إدخال درجات 1-10 لجميع المعايير.", "danger");
      header("Location: /majaaz_portal/jury/evaluate.php?project_id={$projectId}"); exit;
    }
    $newScores[] = $v;
  }
  $raw = array_sum($newScores);
  $comment = trim($_POST['comment'] ?? '');
  $publish = isset($_POST['publish']) ? 1 : 0;

  $stmt = $pdo->prepare("
    INSERT INTO evaluations (project_id, jury_id, scores_json, raw_score, comment, published)
    VALUES (?,?,?,?,?,?)
    ON DUPLICATE KEY UPDATE scores_json=VALUES(scores_json), raw_score=VALUES(raw_score), comment=VALUES(comment), published=VALUES(published)
  ");
  $stmt->execute([
    $projectId,
    (int)$_SESSION['user']['id'],
    json_encode($newScores, JSON_UNESCAPED_UNICODE),
    $raw,
    ($comment !== '' ? $comment : null),
    $publish
  ]);

  flash_set($publish ? "تم الحفظ والنشر بنجاح." : "تم الحفظ (غير منشور).");
  header("Location: /majaaz_portal/jury/projects.php");
  exit;
}

include __DIR__ . "/../includes/header.php";
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <div>
    <h1 class="h4 mb-1">تقييم مشروع</h1>
    <div class="text-muted small"><?= e($project['name']) ?> — #<?= (int)$projectId ?></div>
  </div>
  <a class="btn btn-outline-secondary" href="/majaaz_portal/jury/projects.php">رجوع</a>
</div>

<?php if ($locked): ?>
  <div class="alert alert-success">✓ هذا التقييم منشور ولا يمكن تعديله.</div>
<?php endif; ?>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post">
      <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

      <?php foreach (CRITERIA as $i => $c): ?>
        <div class="mb-3">
          <div class="fw-semibold mb-2"><?= ($i+1) ?>. <?= e($c) ?></div>
          <div class="d-flex flex-wrap gap-2">
            <?php for ($v=1; $v<=10; $v++): ?>
              <label class="btn btn-sm <?= ((int)$scores[$i]===$v)?'btn-primary':'btn-outline-primary' ?>">
                <input type="radio" name="c<?= $i ?>" value="<?= $v ?>" class="d-none" <?= ((int)$scores[$i]===$v)?'checked':'' ?> <?= $locked?'disabled':'' ?>>
                <?= $v ?>
              </label>
            <?php endfor; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="mb-3">
        <label class="form-label">تعليق عام (اختياري)</label>
        <textarea class="form-control" name="comment" rows="3" <?= $locked?'disabled':'' ?>><?= e($comment) ?></textarea>
      </div>

      <?php
        $rawNow = array_sum(array_map('intval', $scores));
        $normNow = (int)round(($rawNow / MAX_SCORE) * 100);
      ?>
      <div class="p-3 bg-light rounded mb-3 d-flex justify-content-between align-items-center">
        <div class="text-muted">الدرجة الإجمالية</div>
        <div class="text-end">
          <div class="mono fw-bold"><?= $rawNow ?> / <?= MAX_SCORE ?></div>
          <div class="mono text-muted small"><?= $normNow ?> / 100</div>
        </div>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="publish" id="publish" <?= ($existing && (int)$existing['published']===1)?'checked':'' ?> <?= $locked?'disabled':'' ?>>
        <label class="form-check-label" for="publish">نشر التقييم للعموم</label>
      </div>

      <button class="btn btn-primary" type="submit" <?= $locked?'disabled':'' ?>>حفظ</button>
      <div class="text-muted small mt-2">ملاحظة: بعد النشر، لا يمكن تعديل التقييم.</div>
    </form>
  </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
