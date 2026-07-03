<?php
// Camada simples de leitura/escrita JSON (sem banco de dados).

declare(strict_types=1);

function data_path(string $name): string {
    return GODAI_DATA . '/' . $name . '.json';
}

function load_json(string $name, $default = []) {
    $path = data_path($name);
    if (!is_file($path)) return $default;
    $raw = file_get_contents($path);
    $val = json_decode($raw, true);
    return $val === null ? $default : $val;
}

function save_json(string $name, $value): bool {
    $path = data_path($name);
    $tmp  = $path . '.tmp';
    $json = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) return false;
    if (file_put_contents($tmp, $json, LOCK_EX) === false) return false;
    return rename($tmp, $path);
}

function get_settings(): array {
    return load_json('settings', [
        'companyName'      => 'Godai Terapias Integrativas',
        'slogan'           => '',
        'shortDescription' => '',
        'whatsappNumber'   => '5519997016552',
        'whatsappMessage'  => 'Olá! Gostaria de solicitar um orçamento para Quick Massage Corporativa.',
        'email'            => 'contato@godaiterapias.com.br',
        'contactEmail'     => 'contato@godaiterapias.com.br',
        'phone'            => '(19) 99701-6552',
        'instagram'        => 'https://instagram.com/godai_terapias',
        'linkedin'         => '',
        'address'          => '',
        'city'             => 'Indaiatuba',
        'state'            => 'SP',
    ]);
}

function get_faq(): array {
    $list = load_json('faq', []);
    usort($list, fn($a, $b) => ($a['display_order'] ?? 0) <=> ($b['display_order'] ?? 0));
    return $list;
}

function get_seo(string $page = ''): array {
    $all = load_json('seo', []);
    if ($page === '') return $all;
    return $all[$page] ?? [];
}

function get_gallery(string $category = ''): array {
    $list = load_json('gallery', []);
    if ($category !== '') $list = array_filter($list, fn($g) => ($g['category'] ?? '') === $category);
    return array_values($list);
}


function whatsapp_link(?string $customMessage = null): string {
    $s = get_settings();
    $number = preg_replace('/\D/', '', $s['whatsappNumber'] ?? '');
    $text   = $customMessage ?? ($s['whatsappMessage'] ?? '');
    return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
}

/* =============================================================
 * Navegação — itens do menu principal, gerenciável em admin/navegacao.php
 * ============================================================= */
function get_navigation(): array {
    $data = load_json('navigation', ['items' => []]);
    $items = $data['items'] ?? [];
    $items = array_values(array_filter($items, fn($it) => !empty($it['enabled'])));
    usort($items, fn($a,$b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
    return $items;
}

/* =============================================================
 * CTAs — textos/links de botões, gerenciável em admin/ctas.php
 * ============================================================= */
function get_cta(string $key, array $fallback = ['label'=>'','href'=>'']): array {
    $all = load_json('ctas', []);
    $cta = $all[$key] ?? $fallback;
    // Se href vazio E é um CTA de WhatsApp por convenção, usa whatsapp_link()
    if (empty($cta['href']) && (strpos($key, 'whatsapp') !== false || strpos($key, 'wpp') !== false)) {
        $cta['href'] = whatsapp_link();
    }
    return $cta;
}

/* =============================================================
 * Depoimentos — CRUD em admin/depoimentos.php (ainda não renderizado no site)
 * ============================================================= */
function get_testimonials(bool $onlyActive = true): array {
    $list = load_json('testimonials', []);
    if ($onlyActive) $list = array_filter($list, fn($t) => !empty($t['active']));
    usort($list, fn($a,$b) => ($a['display_order'] ?? 0) <=> ($b['display_order'] ?? 0));
    return array_values($list);
}

/* =============================================================
 * Logs administrativos — histórico de ações no painel
 * ============================================================= */
function admin_log(string $action, string $detail = ''): void {
    $logs = load_json('admin-logs', []);
    $user = function_exists('current_user') ? current_user() : null;
    $logs[] = [
        'ts'     => date('c'),
        'user'   => $user['username'] ?? '(anônimo)',
        'action' => $action,
        'detail' => $detail,
        'ip'     => $_SERVER['REMOTE_ADDR'] ?? '',
    ];
    // Mantém no máximo 500 entradas (descarta as mais antigas)
    if (count($logs) > 500) {
        $logs = array_slice($logs, -500);
    }
    save_json('admin-logs', $logs);
}


/* =============================================================
 * Site Images — gerenciamento centralizado pelo painel admin.
 * Registry hardcoded das imagens substituíveis. Overrides ficam
 * em data/site-images.json apontando para arquivos enviados em
 * assets/uploads/site-images/. Backups em assets/uploads/backups/.
 * ============================================================= */
function site_image_registry(): array {
    return [
        'home_hero' => [
            'label'   => 'Hero Principal',
            'page'    => 'Home',
            'default' => 'assets/img/hero-massage.jpg',
            'reco'    => '1920 × 1080 px (paisagem)',
        ],
        'home_about' => [
            'label'   => 'Sobre a Godai',
            'page'    => 'Home',
            'default' => 'assets/img/about-zen.jpg',
            'reco'    => '1200 × 1500 px (retrato 4:5)',
        ],
        'beneficios_hero' => [
            'label'   => 'Hero Benefícios para Empresas',
            'page'    => 'Benefícios para Empresas',
            'default' => 'assets/img/beneficios-hero.png',
            'reco'    => '1920 × 1080 px (paisagem)',
        ],
    ];
}

function site_image_path(string $key): string {
    $reg = site_image_registry();
    if (!isset($reg[$key])) return '';
    $over = load_json('site-images', []);
    return $over[$key] ?? $reg[$key]['default'];
}

function site_image_url(string $key): string {
    $rel = site_image_path($key);
    return $rel ? base_url($rel) : '';
}
