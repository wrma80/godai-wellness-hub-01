<?php
// _layout.php — header e footer do painel admin.
// Uso:
//   $page_title = 'Dashboard';
//   $active     = 'dashboard';
//   include __DIR__ . '/_layout.php';
//   layout_start();
//     /* conteúdo HTML */
//   layout_end();

declare(strict_types=1);

function admin_menu(): array {
    return [
        ['group'=>'Visão geral'],
        ['key'=>'dashboard', 'label'=>'Dashboard',     'href'=>'index.php',     'icon'=>'◐'],
        ['key'=>'mensagens', 'label'=>'Mensagens',     'href'=>'mensagens.php', 'icon'=>'✉'],

        ['group'=>'Conteúdo'],
        ['key'=>'conteudo',    'label'=>'Conteúdo do site','href'=>'conteudo.php','icon'=>'✎'],
        ['key'=>'faq',         'label'=>'FAQ',             'href'=>'faq.php',         'icon'=>'?'],
        ['key'=>'depoimentos', 'label'=>'Depoimentos',     'href'=>'depoimentos.php', 'icon'=>'❝'],
        ['key'=>'galeria',     'label'=>'Galeria',         'href'=>'galeria.php',     'icon'=>'▣'],
        ['key'=>'imagens',     'label'=>'Imagens do site', 'href'=>'imagens.php',     'icon'=>'◰'],
        ['key'=>'seo',         'label'=>'SEO',             'href'=>'seo.php',         'icon'=>'⌖'],

        ['group'=>'Interface'],
        ['key'=>'navegacao',   'label'=>'Navegação',       'href'=>'navegacao.php',   'icon'=>'☰'],
        ['key'=>'ctas',        'label'=>'CTAs e Botões',   'href'=>'ctas.php',        'icon'=>'▶'],

        ['group'=>'Configurações'],
        ['key'=>'contatos',    'label'=>'Contatos',        'href'=>'contatos.php',    'icon'=>'☎'],
        ['key'=>'email',       'label'=>'E-mail / SMTP',   'href'=>'email.php',       'icon'=>'✦'],
        ['key'=>'seguranca',   'label'=>'Segurança',       'href'=>'seguranca.php',   'icon'=>'⚿'],
        ['key'=>'logs',        'label'=>'Logs',            'href'=>'logs.php',        'icon'=>'⌘'],
    ];
}

function layout_start(): void {
    global $page_title, $active;
    $u = current_user();
    ?>
<!doctype html><html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($page_title ?? 'Painel Godai') ?> — Painel Godai</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="<?= e(base_url('admin/assets/admin.css')) ?>?v=2">
<meta name="robots" content="noindex,nofollow">
</head>
<body class="admin">
<div class="adm-shell">
  <aside class="adm-side" id="admSide">
    <div class="brand">
      <img src="<?= e(base_url('assets/img/godai-logo.png')) ?>" alt="Godai">
      <strong>Painel Godai</strong>
    </div>
    <nav class="adm-nav">
      <?php foreach (admin_menu() as $item): ?>
        <?php if (isset($item['group'])): ?>
          <div class="label"><?= e($item['group']) ?></div>
        <?php else: ?>
          <a href="<?= e(base_url('admin/' . $item['href'])) ?>" class="<?= ($active ?? '') === $item['key'] ? 'active' : '' ?>">
            <span style="width:18px;display:inline-block;text-align:center;opacity:.8;"><?= e($item['icon']) ?></span>
            <?= e($item['label']) ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>
    <div class="foot">
      <?= e($u['username'] ?? '—') ?> · <a href="<?= e(base_url('admin/logout.php')) ?>">Sair</a>
    </div>
  </aside>
  <main class="adm-main">
    <header class="adm-top">
      <div style="display:flex;align-items:center;gap:14px;">
        <button class="adm-toggle" onclick="document.getElementById('admSide').classList.toggle('open')">☰</button>
        <h1><?= e($page_title ?? 'Painel') ?></h1>
      </div>
      <div class="user">
        <a href="<?= e(base_url('index.php')) ?>" target="_blank" class="btn-out">Ver site ↗</a>
      </div>
    </header>
    <div class="adm-content">
    <?php if ($f = pop_flash()): ?>
      <div class="alert alert-<?= e($f['type']) ?>"><?= e($f['msg']) ?></div>
    <?php endif; ?>
<?php
}

function layout_end(): void {
    ?>
    </div>
  </main>
</div>
</body></html>
<?php
}
