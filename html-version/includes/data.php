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

function get_services(): array {
    $list = load_json('services', []);
    usort($list, fn($a, $b) => ($a['display_order'] ?? 0) <=> ($b['display_order'] ?? 0));
    return $list;
}

function get_pricing(): array {
    $list = load_json('pricing', []);
    usort($list, fn($a, $b) => ($a['display_order'] ?? 0) <=> ($b['display_order'] ?? 0));
    return $list;
}

function whatsapp_link(?string $customMessage = null): string {
    $s = get_settings();
    $number = preg_replace('/\D/', '', $s['whatsappNumber'] ?? '');
    $text   = $customMessage ?? ($s['whatsappMessage'] ?? '');
    return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
}
