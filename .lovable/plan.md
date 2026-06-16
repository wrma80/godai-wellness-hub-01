## Ajustes solicitados — Sobre, Contato e Instagram

Aplicar nas duas versões do site (React em `src/routes/` e PHP em `html-version/`) sem alterar a identidade visual.

### 1. Padronização dos títulos da página "Sobre"

Hoje o hero usa "Sobre a Godai" como `<span>` pequeno (eyebrow) e o título principal é "Uma história construída pelo cuidado com as pessoas." Já em "Nossa origem" o eyebrow é "Nossa origem" e o título grande é "Como nasceu a Godai".

A solicitação é que **"Sobre a Godai" tenha o mesmo tamanho/peso/altura/espaçamento de "Nossa Origem"** (ou seja, mesmo estilo de eyebrow). Para isso:

- **React (`src/routes/sobre.tsx`, linha 38):** trocar a classe do `<span>` "Sobre a Godai" de `text-sm font-medium tracking-wide text-sage` para `text-xs font-semibold uppercase tracking-[0.25em] text-sage` — idêntico ao eyebrow de "Nossa origem" (linha 63). Sem inline-style.
- **PHP (`html-version/sobre.php`, linha 9):** remover os overrides inline (`style="text-transform:none;letter-spacing:normal;font-weight:500;"`) deixando apenas `<span class="eyebrow">Sobre a Godai</span>`, igual aos demais eyebrows da página.

### 2. Simplificação da página de Contato

Remover a faixa de 4 cards ("Atendimento personalizado / Estrutura inclusa / Atendimento corporativo / Flexibilidade de horários"). Formulário e bloco de contato permanecem inalterados.

- **React (`src/routes/contato.tsx`):** remover o array `DIFS` (linhas 16–21) e a `<section>` inteira que o renderiza (linhas 67–80). Remover o import `Check` se não for mais usado em outras partes (continuará sendo usado no estado "sent", então mantém).
- **PHP (`html-version/contato.php`):** remover a `<section>` linhas 16–24 (bloco `bullet-list`).

### 3. Rótulo do Instagram → `@godai_terapias`

- **`src/components/Footer.tsx` (linha 55):** já mostra `@godai_terapias` — nenhum ajuste necessário.
- **`src/routes/contato.tsx` (linha 110):** trocar o texto "Instagram" por `@godai_terapias`.
- **`html-version/contato.php` (linha 34):** trocar o texto do link "Instagram" por `@godai_terapias`.
- **`html-version/includes/footer.php`:** já mostra `@godai_terapias` — sem alteração.

### 4. Ícone oficial do Instagram

Verificar o ícone usado. No React, `Footer.tsx` e `contato.tsx` já importam `Instagram` do `lucide-react`, que é o glifo oficial (câmera quadrada com lente). Manter.

No PHP, hoje é usado o caractere `◎` (footer e contato). Substituir por um SVG inline do ícone oficial do Instagram (mesmo path do Lucide), mantendo as classes/estilo atuais:

- `html-version/includes/footer.php` (linha do Instagram dentro da `<ul>` de contato).
- `html-version/contato.php` (linha 34, dentro do `<span class="ico">`).

SVG a usar (24×24, `currentColor`, traço 1.5, igual ao Lucide):

```html
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
  fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
  <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
</svg>
```

### 5. Consistência geral

Após as alterações, conferir visualmente Sobre e Contato em desktop e mobile (preview React e snapshot do PHP) para garantir alinhamento, espaçamento e responsividade.

### Entrega

**Arquivos a alterar:**
- `src/routes/sobre.tsx` — estilo do eyebrow "Sobre a Godai".
- `src/routes/contato.tsx` — remover seção de cards; trocar texto do link Instagram.
- `html-version/sobre.php` — remover overrides inline do eyebrow.
- `html-version/contato.php` — remover seção `bullet-list`; trocar texto e ícone do Instagram.
- `html-version/includes/footer.php` — trocar ícone `◎` por SVG oficial do Instagram.

**Sem alterações em:** formulário, identidade visual (cores/tipografia), demais páginas, backend PHP, painel admin.
