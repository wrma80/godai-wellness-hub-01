<?php
$s = get_settings();
$page = current_page();

// Menu vem do painel (admin/navegacao.php). Fallback para lista padrão se vazio.
$navItems = get_navigation();
if (empty($navItems)) {
    $navItems = [
        ['key'=>'home','label'=>'Home','href'=>'index.php'],
        ['key'=>'sobre','label'=>'Sobre','href'=>'sobre.php'],
        ['key'=>'quick-massage','label'=>'Quick Massage','href'=>'quick-massage.php'],
        ['key'=>'beneficios','label'=>'Benefícios para Empresas','href'=>'beneficios.php'],
        ['key'=>'faq','label'=>'FAQ','href'=>'faq.php'],
        ['key'=>'contato','label'=>'Contato','href'=>'contato.php'],
    ];
}

// CTA principal do header
$primaryCta = get_cta('primary_quote', ['label'=>'Solicitar orçamento','href'=>'contato.php']);

// SEO: mescla defaults hardcoded (fallback) com o que vier do painel (admin/seo.php)
$seoKey       = $seoKey ?? page_seo_key();
$seo          = get_seo($seoKey);
$pageTitle    = $pageTitle ?? ($seo['title']       ?? 'Godai Terapias Integrativas — Quick Massage Corporativa');
$pageDesc     = $pageDesc  ?? ($seo['description'] ?? 'Bem-estar corporativo que transforma ambientes. Quick Massage in company para empresas, SIPATs e programas de qualidade de vida.');
// Se o painel definir title/description, sobrescreve o valor hardcoded da página
if (!empty($seo['title']))       $pageTitle = $seo['title'];
if (!empty($seo['description'])) $pageDesc  = $seo['description'];
$pageKeywords = $seo['keywords']       ?? '';
$ogTitle      = $seo['og_title']       ?: $pageTitle;
$ogDesc       = $seo['og_description'] ?: $pageDesc;
$ogImage      = $seo['og_image']       ?? '';
?><!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDesc) ?>">
  <?php if ($pageKeywords !== ''): ?><meta name="keywords" content="<?= e($pageKeywords) ?>"><?php endif; ?>
  <meta name="author" content="<?= e($s['companyName'] ?? 'Godai Terapias Integrativas') ?>">
  <meta property="og:title" content="<?= e($ogTitle) ?>">
  <meta property="og:description" content="<?= e($ogDesc) ?>">
  <meta property="og:type" content="website">
  <?php if ($ogImage !== ''): ?>
  <meta property="og:image" content="<?= e($ogImage) ?>">
  <meta name="twitter:image" content="<?= e($ogImage) ?>">
  <?php endif; ?>
  <meta name="twitter:card" content="<?= $ogImage !== '' ? 'summary_large_image' : 'summary' ?>">
  <meta name="twitter:title" content="<?= e($ogTitle) ?>">
  <meta name="twitter:description" content="<?= e($ogDesc) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
  <link rel="icon" href="<?= e(base_url('assets/img/godai-logo.png')) ?>">
</head>
<body>
<header class="site-header" id="siteHeader">
  <div class="container header-inner">
    <a href="<?= e(base_url('index.php')) ?>" class="logo" aria-label="<?= e($s['companyName'] ?? 'Godai Terapias Integrativas') ?>">
      <img src="<?= e(base_url('assets/img/godai-symbol.png')) ?>" alt="<?= e($s['companyName'] ?? 'Godai Terapias Integrativas') ?>" style="height:64px;width:auto;display:block;">
    </a>
    <nav class="nav-desktop">
      <?php foreach ($navItems as $item):
        $slug = $item['key'] ?? '';
        $href = base_url($item['href']);
        $itemSlug = pathinfo($item['href'], PATHINFO_FILENAME);
        $isActive = $page === $slug || $page === $itemSlug; ?>
        <a href="<?= e($href) ?>" class="nav-link<?= $isActive ? ' is-active' : '' ?>"><?= e($item['label']) ?></a>
      <?php endforeach; ?>
      <a href="<?= e(base_url($primaryCta['href'] ?: 'contato.php')) ?>" class="btn btn-primary btn-pill"><?= e($primaryCta['label'] ?: 'Solicitar orçamento') ?></a>
    </nav>
    <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav-mobile" id="navMobile" hidden>
    <?php foreach ($navItems as $item): ?>
      <a href="<?= e(base_url($item['href'])) ?>"><?= e($item['label']) ?></a>
    <?php endforeach; ?>
    <a href="<?= e(base_url($primaryCta['href'] ?: 'contato.php')) ?>" class="btn btn-primary btn-pill"><?= e($primaryCta['label'] ?: 'Solicitar orçamento') ?></a>
  </div>
</header>
<main class="site-main">
