## Alterações

### 1. Logo do menu (Home)
- Copiar `/mnt/user-uploads/Logo_negativo.png` para:
  - `src/assets/godai-symbol.png` (sobrescrever)
  - `html-version/assets/img/godai-symbol.png` (sobrescrever)
- O `Logo.tsx` (variant `dark`) e o `header.php` já apontam para esses arquivos — apenas a substituição binária resolve o cache.

### 2. Texto "Sobre a GODAI" → "Sobre a Godai"
Procurar e ajustar a string em caixa baixa nos arquivos:
- `src/routes/sobre.tsx` (hero da página Sobre)
- `html-version/sobre.php` (equivalente PHP)
- Verificar também `src/routes/index.tsx` e `html-version/index.php` caso a label apareça em outras seções.

Não alterar estilo, layout, cor ou tamanho — apenas o texto.
