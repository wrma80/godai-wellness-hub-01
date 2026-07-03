<?php
require_once __DIR__ . '/_auth.php';
require_login();

$SECTIONS = [
    'home' => [
        'label' => 'Home',
        'fields' => [
            'hero_eyebrow'  => 'Hero — Eyebrow',
            'hero_title'    => 'Hero — Título',
            'hero_subtitle' => 'Hero — Subtítulo',
            'cta_label'     => 'Texto do botão CTA',
        ],
    ],
    'sobre' => [
        'label' => 'Sobre',
        'fields' => [
            'intro'   => 'Introdução / História',
            'missao'  => 'Missão',
            'visao'   => 'Visão',
            'valores' => 'Valores',
        ],
    ],
    'quick_massage' => [
        'label' => 'Quick Massage',
        'fields' => [
            'intro'      => 'Introdução',
            'beneficios' => 'Benefícios',
            'processo'   => 'Processo / Como funciona',
        ],
    ],
];

$active_tab = $_GET['s'] ?? 'home';
if (!isset($SECTIONS[$active_tab])) $active_tab = 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $data = load_json('content', []);
    $s = $_POST['section'] ?? 'home';
    if (!isset($SECTIONS[$s])) $s = 'home';
    $entry = $data[$s] ?? [];
    foreach ($SECTIONS[$s]['fields'] as $key => $_) {
        $entry[$key] = trim((string)($_POST[$key] ?? ''));
    }
    $data[$s] = $entry;
    save_json('content', $data);
    admin_log('conteudo.save', ''); flash('success', 'Conteúdo salvo.');
    header('Location: ' . base_url('admin/conteudo.php?s='.urlencode($s)));
    exit;
}

$data = load_json('content', []);
$cur = $data[$active_tab] ?? [];
$csrf = csrf_token();
$page_title = 'Conteúdo do site';
$active = 'conteudo';
require __DIR__ . '/_layout.php';
layout_start();
?>
<div class="card" style="padding-bottom:6px;">
  <div style="display:flex;gap:6px;flex-wrap:wrap;">
    <?php foreach ($SECTIONS as $k=>$cfg): ?>
      <a href="?s=<?= e($k) ?>" class="btn btn-sm <?= $active_tab===$k?'btn-primary':'btn-out' ?>"><?= e($cfg['label']) ?></a>
    <?php endforeach; ?>
  </div>
</div>

<form method="post">
  <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">
  <input type="hidden" name="section" value="<?= e($active_tab) ?>">

  <div class="card">
    <h2>Conteúdo da seção — <?= e($SECTIONS[$active_tab]['label']) ?></h2>
    <p class="sub">Os textos editados aqui ficam disponíveis para uso nos templates do site.</p>
    <?php foreach ($SECTIONS[$active_tab]['fields'] as $key => $label): ?>
      <div class="field">
        <label><?= e($label) ?></label>
        <textarea name="<?= e($key) ?>" rows="3"><?= e($cur[$key] ?? '') ?></textarea>
      </div>
    <?php endforeach; ?>
    <button class="btn btn-primary">Salvar conteúdo</button>
  </div>
</form>
<?php layout_end(); ?>
