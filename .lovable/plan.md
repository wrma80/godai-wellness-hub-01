# Plano de implementação

Esta é uma entrega grande. Vou dividir em **2 fases**. Confirme antes de eu seguir — especialmente a Fase 2, que é extensa e precisa de algumas decisões.

---

## Fase 1 — Ajuste SMTP para Locaweb (rápido, seguro)

Objetivo: separar credenciais SMTP do código versionado.

### Arquivos
- **Criar** `html-version/includes/email-config.example.php` — modelo com constantes vazias e comentários.
- **Renomear conceito**: `html-version/includes/email-config.php` deixa de ser versionado. O arquivo atual (com constantes vazias) vira o `.example.php`. O `.php` real será criado manualmente no servidor via FTP.
- **Atualizar** `.gitignore` na raiz: adicionar `html-version/includes/email-config.php`.
- **Atualizar** `html-version/processa-contato.php` para:
  - Verificar se `email-config.php` existe; se não, carregar o `.example.php` como fallback para evitar fatal error.
  - Mensagem clara no log se as credenciais ainda não foram configuradas.
- **Atualizar** `html-version/README.md` com instruções: "após deploy FTP, copiar `email-config.example.php` → `email-config.php` e preencher".
- **Remover do repo** o `email-config.php` atual (ele tem só constantes vazias — sem perda).

Sem variáveis do GitHub Actions. Compatível 100% com hospedagem compartilhada Locaweb.

---

## Fase 2 — Reformulação do Painel Administrativo (PHP)

Escopo MUITO grande. Vou listar o que entendi e os pontos que precisam de decisão.

### Premissas que assumi (confirme)
1. **Tudo em PHP puro** (mesma stack do `html-version/admin/`), sem tocar no painel React/Supabase.
2. **Banco de dados**: o site hoje usa arquivos JSON em `html-version/data/`. Você quer migrar para **MySQL** (padrão Locaweb) ou **manter JSON** e só adicionar autenticação/módulos?
   - MySQL → preciso que você crie o banco no painel Locaweb e me passe host/usuário/senha/nome (via secret, não no chat).
   - JSON → mais simples, sem dependência externa, mas menos robusto para "formulários recebidos" com filtros/exportação.
3. **Recuperação de senha por e-mail**: depende do SMTP da Fase 1 estar configurado em produção. Vou implementar mas só funcionará após você preencher `email-config.php` no servidor.
4. **Upload de imagens da galeria**: armazenadas em `html-version/assets/uploads/` com `.htaccess` bloqueando execução de PHP.
5. **Usuário inicial Godai / 123456**: vou criar via script `bootstrap-admin.php` que roda 1x e se autodeleta, OU já incluir o hash no `data/admin.json` (mais simples). Prefere qual?

### Módulos a construir (PHP)

| Módulo | Arquivo | Origem dos dados |
|---|---|---|
| Login + logout + sessão | `admin/login.php`, `admin/logout.php` | `admin.json` ou tabela `usuarios` |
| Recuperar senha | `admin/esqueci.php`, `admin/redefinir.php?token=` | tokens em `data/password-resets.json` ou tabela |
| Alterar senha | `admin/seguranca.php` | — |
| Dashboard | `admin/index.php` | agregados dos demais |
| Conteúdo do Site (Home/Sobre/Quick Massage) | `admin/conteudo.php` | JSON ou tabela |
| FAQ (CRUD + reorder) | `admin/faq.php` | JSON/tabela |
| Galeria (upload + categorias) | `admin/galeria.php` | filesystem + JSON/tabela |
| Contatos (empresa, redes, endereço) | `admin/contatos.php` | `settings.json` expandido |
| SEO por página | `admin/seo.php` | JSON/tabela |
| Formulários recebidos (histórico + CSV) | `admin/mensagens.php` | tabela (ou JSON append) |
| Configurações SMTP | `admin/email.php` | escreve em `email-config.php` no servidor |

### Layout
- Menu lateral fixo, paleta Verde Sage + Creme (mesma do site).
- CSS próprio em `html-version/admin/assets/admin.css`.
- Responsivo mobile.

### Segurança
- Todas as rotas exigem `require_login()` (já existe esqueleto em `admin/_auth.php`).
- CSRF em todos os formulários (já existe `csrf_token()`).
- `password_hash()` / `password_verify()` (bcrypt).
- Tokens de reset com `random_bytes(32)`, expiração 60min, single-use.

### Frente React/Supabase
- **Não vou mexer** no painel `/admin` React/Supabase nem nas tabelas do Lovable Cloud. Esse painel continua existindo em paralelo. Se você quiser desativá-lo, me diga.

---

## Perguntas para decidir antes da Fase 2

1. **Banco**: MySQL na Locaweb ou manter JSON?
2. **Usuário inicial**: hash já no `admin.json` (mais simples) ou script bootstrap?
3. **Painel React/Supabase atual** (`/admin` na versão TanStack): manter, ocultar ou remover?
4. **Quer que eu execute a Fase 1 agora** (é rápida e independente) **enquanto você decide a Fase 2**?
