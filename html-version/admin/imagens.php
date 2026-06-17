<?php
require_once __DIR__ . '/_auth.php';
require_login();

$UPLOADS_DIR  = GODAI_ROOT . '/assets/uploads/site-images';
$BACKUPS_DIR  = GODAI_ROOT . '/assets/uploads/backups';
$UPLOADS_REL  = 'assets/uploads/site-images';

if (!is_dir($UPLOADS_DIR))  @mkdir($UPLOADS_DIR, 0775, true);
if (!is_dir($BACKUPS_DIR))  @mkdir($BACKUPS_DIR, 0775, true);

/**
 * Otimiza/re-encoda imagem usando GD: redimensiona se >1920px, remove
 * metadados (GD não preserva EXIF) e recompacta com qualidade web.
 * Retorna true em sucesso, false em falha (mantém arquivo original).
 */
function godai_optimize_image(string $src, string $dst, string $mime): bool {
    if (!function_exists('imagecreatefromstring')) {
        return @copy($src, $dst);
    }
    $data = @file_get_contents($src);
    if ($data === false) return false;
    $img = @imagecreatefromstring($data);
    if (!$img) return false;
    $w = imagesx($img); $h = imagesy($img);
    $maxW = 1920;
    if ($w > $maxW) {
        $nw = $maxW; $nh = (int)round($h * ($maxW / $w));
        $resized = imagecreatetruecolor($nw, $nh);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        imagecopyresampled($resized, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
        imagedestroy($img);
        $img = $resized;
    }
    $ok = false;
    switch ($mime) {
        case 'image/jpeg': $ok = imagejpeg($img, $dst, 85); break;
        case 'image/png':  $ok = imagepng($img, $dst, 6);   break;
        case 'image/webp': $ok = function_exists('imagewebp') ? imagewebp($img, $dst, 85) : @copy($src, $dst); break;
        default:           $ok = @copy($src, $dst);
    }
    imagedestroy($img);
    return (bool)$ok;
}

$registry = site_image_registry();
$overrides = load_json('site-images', []);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = $_POST['action'] ?? '';
    $key    = $_POST['key'] ?? '';
    if (!isset($registry[$key])) {
        flash('error', 'Imagem inválida.');
        header('Location: ' . base_url('admin/imagens.php')); exit;
    }

    if ($action === 'upload' && !empty($_FILES['image']['tmp_name'])) {
        $tmp  = $_FILES['image']['tmp_name'];
        $orig = $_FILES['image']['name'] ?? 'img';
        $size = (int)($_FILES['image']['size'] ?? 0);

        if ($size > 5 * 1024 * 1024) {
            flash('error', 'Arquivo maior que 5 MB. Reduza e tente novamente.');
        } else {
            $info = @getimagesize($tmp);
            $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
            $mime = $info['mime'] ?? '';
            if (!isset($allowed[$mime])) {
                flash('error', 'Formato inválido. Use JPG, PNG ou WEBP.');
            } else {
                // 1. Backup do arquivo atual (se existir e for um arquivo local).
                $currentRel = site_image_path($key);
                $currentAbs = GODAI_ROOT . '/' . ltrim($currentRel, '/');
                if (is_file($currentAbs)) {
                    $bname = pathinfo($currentRel, PATHINFO_FILENAME) . '_' . date('Ymd_His') . '.' . pathinfo($currentRel, PATHINFO_EXTENSION);
                    @copy($currentAbs, $BACKUPS_DIR . '/' . $bname);
                }

                // 2. Salva nova imagem otimizada.
                $ext   = $allowed[$mime];
                $fname = $key . '_' . date('Ymd_His') . '_' . substr(bin2hex(random_bytes(3)),0,6) . '.' . $ext;
                $dst   = $UPLOADS_DIR . '/' . $fname;
                if (godai_optimize_image($tmp, $dst, $mime)) {
                    // 3. Remove override anterior (se estava em uploads/site-images).
                    if (!empty($overrides[$key]) && strpos($overrides[$key], $UPLOADS_REL) === 0) {
                        @unlink(GODAI_ROOT . '/' . $overrides[$key]);
                    }
                    $overrides[$key] = $UPLOADS_REL . '/' . $fname;
                    save_json('site-images', $overrides);
                    flash('success', 'Imagem "' . $registry[$key]['label'] . '" substituída com sucesso.');
                } else {
                    flash('error', 'Não foi possível processar o arquivo enviado.');
                }
            }
        }
    } elseif ($action === 'restore') {
        if (!empty($overrides[$key])) {
            if (strpos($overrides[$key], $UPLOADS_REL) === 0) {
                @unlink(GODAI_ROOT . '/' . $overrides[$key]);
            }
            unset($overrides[$key]);
            save_json('site-images', $overrides);
            flash('success', 'Imagem restaurada para a versão original.');
        }
    }
    header('Location: ' . base_url('admin/imagens.php')); exit;
}

$csrf = csrf_token();
$page_title = 'Imagens do site';
$active = 'imagens';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card">
  <h2>Imagens do site</h2>
  <p class="sub">Substitua as imagens utilizadas nas páginas do site sem necessidade de acessar FTP ou GitHub. Formatos aceitos: JPG, PNG, WEBP — máx. 5 MB. Recomendado: 1920 × 1080 px ou superior. As imagens são otimizadas automaticamente e a versão anterior fica salva em <code>assets/uploads/backups/</code>.</p>
</div>

<?php foreach ($registry as $key => $meta):
    $rel = site_image_path($key);
    $abs = GODAI_ROOT . '/' . ltrim($rel, '/');
    $url = base_url($rel) . '?v=' . (is_file($abs) ? filemtime($abs) : '0');
    $dims = is_file($abs) ? @getimagesize($abs) : null;
    $sizeKb = is_file($abs) ? round(filesize($abs)/1024) : 0;
    $isOverridden = !empty($overrides[$key]);
?>
<div class="card">
  <div style="display:grid;gap:24px;grid-template-columns:280px 1fr;align-items:start;">
    <div>
      <div style="border:1px solid var(--line);border-radius:10px;overflow:hidden;background:var(--cream-2);aspect-ratio:16/10;display:grid;place-items:center;">
        <?php if (is_file($abs)): ?>
          <img src="<?= e($url) ?>" alt="" style="width:100%;height:100%;object-fit:cover;display:block;">
        <?php else: ?>
          <span class="sub">Arquivo não encontrado</span>
        <?php endif; ?>
      </div>
    </div>
    <div>
      <h2 style="margin:0;display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
        <?= e($meta['label']) ?>
        <?php if ($isOverridden): ?><span style="font-size:11px;background:var(--sage-soft);color:var(--sage-deep);padding:3px 8px;border-radius:999px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;">Personalizada</span>
        <?php else: ?><span style="font-size:11px;background:var(--cream-2);color:var(--muted);padding:3px 8px;border-radius:999px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;">Original</span><?php endif; ?>
      </h2>
      <p class="sub" style="margin-top:6px;">
        Página: <strong><?= e($meta['page']) ?></strong> · Recomendado: <?= e($meta['reco']) ?>
      </p>
      <table class="tbl" style="margin-top:8px;">
        <tr><th style="width:140px;">Arquivo</th><td style="word-break:break-all;font-family:monospace;font-size:12px;"><?= e($rel) ?></td></tr>
        <tr><th>Dimensões</th><td><?= $dims ? $dims[0] . ' × ' . $dims[1] . ' px' : '—' ?></td></tr>
        <tr><th>Tamanho</th><td><?= $sizeKb ? $sizeKb . ' KB' : '—' ?></td></tr>
      </table>

      <form method="post" enctype="multipart/form-data" style="margin-top:18px;display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
        <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="upload">
        <input type="hidden" name="key" value="<?= e($key) ?>">
        <div class="field" style="margin:0;flex:1;min-width:240px;">
          <label>Substituir imagem</label>
          <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required>
          <small>JPG, PNG ou WEBP · máx. 5 MB · recomendado <?= e($meta['reco']) ?></small>
        </div>
        <button class="btn btn-primary">Enviar nova imagem</button>
        <?php if ($isOverridden): ?>
          <button type="submit" form="restore-<?= e($key) ?>" class="btn btn-out">Restaurar original</button>
        <?php endif; ?>
      </form>
      <?php if ($isOverridden): ?>
        <form method="post" id="restore-<?= e($key) ?>" onsubmit="return confirm('Restaurar a imagem original? A versão personalizada será removida.');" style="display:none;">
          <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
          <input type="hidden" name="action" value="restore">
          <input type="hidden" name="key" value="<?= e($key) ?>">
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endforeach; ?>

<div class="card">
  <h2>Backups</h2>
  <p class="sub">Toda imagem substituída gera um backup automático em <code>assets/uploads/backups/</code> com data e hora no nome do arquivo, permitindo restauração manual via FTP se necessário.</p>
  <?php
    $bkps = is_dir($BACKUPS_DIR) ? array_values(array_filter(scandir($BACKUPS_DIR), fn($f) => !in_array($f, ['.','..','.htaccess'], true))) : [];
    rsort($bkps);
  ?>
  <?php if (!$bkps): ?>
    <p class="sub">Nenhum backup gerado ainda.</p>
  <?php else: ?>
    <table class="tbl">
      <thead><tr><th>Arquivo</th><th style="width:140px;">Tamanho</th><th style="width:180px;">Data</th></tr></thead>
      <tbody>
      <?php foreach (array_slice($bkps, 0, 20) as $f):
        $p = $BACKUPS_DIR . '/' . $f; ?>
        <tr>
          <td style="font-family:monospace;font-size:12px;"><?= e($f) ?></td>
          <td><?= round(filesize($p)/1024) ?> KB</td>
          <td><?= date('d/m/Y H:i', filemtime($p)) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php layout_end(); ?>
