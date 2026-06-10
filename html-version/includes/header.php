<?php
require_once __DIR__ . '/config.php';
$s = get_settings();
$page = current_page();
$nav = [
  ['index',        'Home'],
  ['sobre',        'Sobre'],
  ['quick-massage','Quick Massage'],
  ['faq',          'FAQ'],
  ['contato',      'Contato'],
];
$pageTitle = $pageTitle ?? 'Godai Terapias Integrativas — Quick Massage Corporativa';
$pageDesc  = $pageDesc  ?? 'Bem-estar corporativo que transforma ambientes. Quick Massage in company para empresas, SIPATs e programas de qualidade de vida.';
?><!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDesc) ?>">
  <meta name="author" content="Godai Terapias Integrativas">
  <meta property="og:title" content="<?= e($pageTitle) ?>">
  <meta property="og:description" content="<?= e($pageDesc) ?>">
  <meta property="og:type" content="website">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css')) ?>">
  <link rel="icon" href="<?= e(base_url('assets/img/godai-logo.png')) ?>">
</head>
<body>
<header class="site-header" id="siteHeader">
  <div class="container header-inner">
    <a href="<?= e(base_url('index.php')) ?>" class="logo" aria-label="Godai Terapias Integrativas">
      <img src="<?= e(base_url('assets/img/godai-symbol.png')) ?>" alt="Godai Terapias Integrativas" style="height:64px;width:auto;display:block;">
    </a>
    <nav class="nav-desktop">
      <?php foreach ($nav as [$slug, $label]):
        $href = $slug === 'index' ? base_url('index.php') : base_url($slug . '.php');
        $isActive = $page === $slug; ?>
        <a href="<?= e($href) ?>" class="nav-link<?= $isActive ? ' is-active' : '' ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
      <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento</a>
    </nav>
    <button class="nav-toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="nav-mobile" id="navMobile" hidden>
    <?php foreach ($nav as [$slug, $label]):
      $href = $slug === 'index' ? base_url('index.php') : base_url($slug . '.php'); ?>
      <a href="<?= e($href) ?>"><?= e($label) ?></a>
    <?php endforeach; ?>
    <a href="<?= e(base_url('contato.php')) ?>" class="btn btn-primary btn-pill">Solicitar orçamento</a>
  </div>
</header>
<main class="site-main">
