# Godai Terapias Integrativas — versão PHP estática

Versão paralela do site institucional escrita em **HTML, CSS, JS e PHP**, pronta para ser hospedada em qualquer servidor Apache/Nginx com PHP 8+ (sem banco de dados).

A versão React principal continua funcionando normalmente fora desta pasta.

## Estrutura

```
html-version/
├── index.php / sobre.php / servicos.php / metodologia.php / contato.php
├── admin/
│   ├── index.php       ← painel completo (login + edição)
│   └── _auth.php
├── includes/
│   ├── config.php      ← bootstrap, sessão, helpers
│   ├── data.php        ← leitura/escrita JSON
│   ├── header.php
│   └── footer.php
├── data/               ← conteúdo editável (JSON, protegido por .htaccess)
│   ├── settings.json
│   ├── services.json
│   ├── pricing.json
│   └── admin.json
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── img/
```

## Como publicar

1. Faça upload da pasta `html-version/` para a sua hospedagem (pode ser a raiz ou um subdiretório).
2. Garanta que a pasta `data/` tenha **permissão de escrita** para o servidor (geralmente 755 ou 775).
3. Acesse `seu-dominio.com/` (ou o caminho onde subiu) — o site já carrega.
4. Acesse `seu-dominio.com/admin/` para entrar no painel.

## Acesso ao painel

- **Usuário:** `admin`
- **Senha:** `admin123`

> **Importante:** Altere a senha no primeiro login na aba **Conta**.

## O que é editável

- **Serviços** — títulos, duração, capacidade, descrição, ordem (adicionar/remover)
- **Preços** — tabela 4h / 6h / 8h (1 e 2 terapeutas, valores e capacidades)
- **Contatos** — WhatsApp, mensagem padrão, e-mail, Instagram, cidade

Todas as alterações refletem **imediatamente** no site público, sem precisar editar código.

## Captura de leads

O formulário de contato monta uma mensagem completa e abre o WhatsApp do número configurado. Não há armazenamento de leads em banco — preparado para integração futura com CRM.

## Requisitos técnicos

- PHP **8.0+** (usa `password_hash`/`password_verify` com bcrypt)
- Apache com `mod_rewrite` opcional (não obrigatório — não usamos URLs amigáveis)
- Nenhum banco de dados ou Composer

## Segurança

- Senha do admin armazenada com **bcrypt**
- Sessão PHP padrão + token **CSRF** em todos os formulários
- `data/.htaccess` e `includes/.htaccess` bloqueiam acesso direto via web
- `.htaccess` raiz nega download de qualquer `.json`

Para hospedagens em **Nginx**, replique a regra de bloqueio para `*.json` dentro de `/data/` e `/includes/`.
