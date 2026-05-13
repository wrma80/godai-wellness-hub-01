# Godai Terapias Integrativas — versão 100% estática

Versão totalmente estática (HTML + CSS + JS), sem PHP e sem banco de dados. Pode ser hospedada em qualquer lugar: GitHub Pages, Netlify, Vercel, Cloudflare Pages, S3, ou hospedagem compartilhada comum.

## Estrutura

```
static-version/
├── index.html
├── sobre.html
├── servicos.html
├── metodologia.html
├── contato.html
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── img/
```

## Como publicar

Faça upload da pasta `static-version/` (ou apenas seu conteúdo) para a hospedagem. Acesse o domínio — pronto.

## Diferenças em relação às outras versões

| Recurso              | React | PHP                | Estática             |
| -------------------- | ----- | ------------------ | -------------------- |
| Painel admin         | ✅    | ✅                 | ❌ (edite no código) |
| Conteúdo dinâmico    | ✅    | ✅ (JSON)          | ❌ (HTML fixo)       |
| Requer PHP/Node      | Node  | PHP 8+             | ❌ Nenhum            |
| Formulário → CRM/DB  | ✅    | preparado p/ CRM   | apenas WhatsApp      |

## Editar conteúdo

Como esta versão não tem painel, qualquer alteração de texto, serviço ou preço é feita diretamente nos arquivos `.html`. Para regenerar a partir dos JSONs da versão PHP, rode:

```
python3 /tmp/build_static.py
```

(o script lê de `html-version/data/*.json` e reescreve os HTMLs)

## Formulário de contato

O formulário em `contato.html` monta a mensagem no cliente (JavaScript) e abre o WhatsApp configurado. Não envia e-mail nem grava em banco.
