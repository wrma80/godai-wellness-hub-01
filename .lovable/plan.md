## Causa

O workflow `.github/workflows/deploy.yml` faz FTP sync de `./html-version/` inteiro para `/public_html/` a cada push. Isso sobrescreve os arquivos de runtime no servidor pelos do repositório — inclusive `data/admin.json`, que no repo está com `"users": []`. Resultado: toda vez que você faz deploy, o usuário criado via bootstrap é apagado, junto com FAQ, mensagens, conteúdo editado, imagens enviadas, logs, etc.

Ou seja, não é só o login — qualquer alteração feita no painel é perdida no próximo deploy.

## Correção

**1. Excluir dados de runtime do deploy**

Editar `.github/workflows/deploy.yml` e adicionar `exclude` no passo FTP-Deploy-Action para nunca sobrescrever:

- `html-version/data/**` (admin.json, faq.json, messages.json, content.json, settings.json, seo.json, gallery.json, navigation.json, ctas.json, testimonials.json, site-images.json, admin-logs.json, password-resets.json)
- `html-version/assets/uploads/**` (imagens enviadas pelo painel, backups)
- `html-version/includes/email-config.php` (credenciais SMTP)

Assim o FTP continua publicando código (`.php`, CSS, JS, imagens fixas de `assets/img/`), mas preserva estado editável.

**2. Converter os JSONs versionados em seeds**

Renomear os arquivos de `data/` do repositório para `*.example.json` (ou mover para `data/seed/`) e ajustar `.gitignore` para ignorar os `data/*.json` reais. Isso evita conflito futuro e deixa claro no repo o schema esperado.

O `includes/data.php` já cria arquivos ausentes quando lidos (`load_json` retorna default). Se não criar, adicionar fallback que copia do seed na primeira leitura.

**3. Refazer o setup uma última vez**

Depois que o workflow corrigido entrar em produção, você acessa `admin/bootstrap.php` uma vez e cria o usuário. A partir daí, deploys futuros não mexem mais em `data/` nem em `assets/uploads/`.

## Detalhes técnicos

Trecho do workflow após ajuste:

```yaml
- name: FTP Deploy
  uses: SamKirkland/FTP-Deploy-Action@master
  with:
    server: ${{ secrets.HOST }}
    username: ${{ secrets.USER }}
    password: ${{ secrets.PASS }}
    local-dir: ./html-version/
    server-dir: /public_html/
    exclude: |
      **/.git*
      **/.git*/**
      html-version/data/**
      html-version/assets/uploads/**
      html-version/includes/email-config.php
```

(Como `local-dir` já é `./html-version/`, os padrões de exclude serão relativos a essa raiz — ajustar para `data/**`, `assets/uploads/**`, `includes/email-config.php`.)

## Fora do escopo

- Backup automático dos JSONs (posso adicionar depois se quiser).
- Migração para banco (Supabase/MySQL) — mudança maior, tratamos separadamente.