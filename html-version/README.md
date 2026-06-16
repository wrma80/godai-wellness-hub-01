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

1. Faça upload da pasta `html-version/` para a sua hospedagem (raiz ou subdiretório).
2. Garanta permissão de escrita (775) para `data/` e `assets/uploads/`.
3. Acesse `seu-dominio.com/admin/bootstrap.php` **uma única vez** para criar o usuário inicial.
4. **Apague** `admin/bootstrap.php` via FTP após o setup.
5. Configure o SMTP em **Painel → E-mail / SMTP** ou copiando manualmente `includes/email-config.example.php` → `includes/email-config.php`.

## Acesso ao painel

URL: `seu-dominio.com/admin/login.php`

- **Usuário inicial:** `Godai`
- **Senha inicial:** `123456`

> **Importante:** altere a senha em **Painel → Segurança** logo após o primeiro login.

### Esqueci minha senha

Em `admin/login.php` → "Esqueci minha senha". O link de recuperação é enviado para o e-mail cadastrado em **Segurança → E-mail de recuperação**. Validade: 60 minutos. Requer SMTP configurado.

## Módulos do painel

- **Dashboard** — visão geral, atalhos, alertas
- **Mensagens** — histórico dos formulários recebidos, busca, filtros e exportação CSV
- **Conteúdo do site** — textos editáveis das páginas Home, Sobre e Quick Massage
- **Serviços / Preços / FAQ** — CRUD completo
- **Galeria** — upload (JPG/PNG/WEBP até 8MB) por categoria, imagem principal
- **SEO** — title, description, keywords e Open Graph por página
- **Contatos** — empresa, redes sociais, endereço, e-mail destinatário dos formulários
- **E-mail / SMTP** — credenciais Locaweb (grava `includes/email-config.php`)
- **Segurança** — alterar senha, alterar e-mail de recuperação


Todas as alterações refletem **imediatamente** no site público, sem precisar editar código.

## Formulário de contato (envio por e-mail)

O formulário envia os dados via **PHP + PHPMailer + SMTP autenticado** (compatível com Locaweb). As credenciais SMTP **não** são versionadas no Git.

### Configuração SMTP (1x após o deploy)

1. No servidor (via FTP/painel Locaweb), entre em `html-version/includes/`.
2. Copie `email-config.example.php` para `email-config.php`.
3. Edite `email-config.php` com as credenciais SMTP da Locaweb:
   - `SMTP_HOST` — geralmente `email-ssl.com.br` ou `smtp.seudominio.com.br`
   - `SMTP_PORT` — `587` (TLS) ou `465` (SSL)
   - `SMTP_SECURE` — `tls` ou `ssl`
   - `SMTP_USERNAME` — e-mail completo (ex.: `contato@godaiterapias.com.br`)
   - `SMTP_PASSWORD` — senha do e-mail
4. Pronto. Os formulários passam a enviar para o e-mail configurado em **Admin → Contatos → "E-mail que receberá os formulários"**.

> ⚠️ **Nunca** commite o arquivo `email-config.php` — ele está no `.gitignore`. Apenas o modelo `email-config.example.php` é versionado.



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
