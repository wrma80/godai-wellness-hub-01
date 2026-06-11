<?php $s = get_settings(); ?>
</main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <img src="<?= e(base_url('assets/img/godai-logo-sage.png')) ?>" alt="Godai Terapias Integrativas" style="height:88px;width:auto;display:block;">
      <p>Bem-estar corporativo com equilíbrio e acolhimento. Levamos a Quick Massage até a sua empresa para promover saúde, produtividade e qualidade de vida.</p>
    </div>
    <div>
      <h4>Navegação</h4>
      <ul>
        <li><a href="<?= e(base_url('index.php')) ?>">Home</a></li>
        <li><a href="<?= e(base_url('sobre.php')) ?>">Sobre</a></li>
        <li><a href="<?= e(base_url('quick-massage.php')) ?>">Quick Massage</a></li>
        <li><a href="<?= e(base_url('faq.php')) ?>">FAQ</a></li>
        <li><a href="<?= e(base_url('contato.php')) ?>">Contato</a></li>
        <li style="margin-top:10px;"><a href="<?= e(base_url('politica-de-privacidade.php')) ?>">Política de Privacidade</a></li>
        <li><a href="<?= e(base_url('termos-de-uso.php')) ?>">Termos de Uso</a></li>
      </ul>
    </div>
    <div>
      <h4>Contato</h4>
      <ul>
        <li>📍 <?= e($s['city']) ?></li>
        <li>✉ <a href="mailto:<?= e($s['email']) ?>"><?= e($s['email']) ?></a></li>
        <li>💬 <a href="<?= e(whatsapp_link()) ?>" target="_blank" rel="noopener">(19) 99701-6552</a></li>
        <li>◎ <a href="<?= e($s['instagram']) ?>" target="_blank" rel="noopener">@godai_terapias</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom container">
    <p>© <?= date('Y') ?> Godai Terapias Integrativas. Todos os direitos reservados.</p>
    <a href="<?= e(base_url('admin/')) ?>" class="footer-admin">Painel</a>
  </div>
</footer>
<a href="<?= e(whatsapp_link()) ?>" class="whatsapp-float" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
  <svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor"><path d="M20.52 3.48A11.93 11.93 0 0 0 12.04 0C5.5 0 .2 5.3.2 11.84a11.78 11.78 0 0 0 1.6 5.94L0 24l6.36-1.66a11.85 11.85 0 0 0 5.68 1.45h.01c6.54 0 11.84-5.3 11.84-11.84 0-3.16-1.23-6.13-3.37-8.47ZM12.05 21.4h-.01a9.55 9.55 0 0 1-4.86-1.33l-.35-.21-3.77.99 1.01-3.67-.23-.38a9.5 9.5 0 0 1-1.46-5.07c0-5.27 4.29-9.55 9.57-9.55 2.55 0 4.95.99 6.76 2.8a9.5 9.5 0 0 1 2.8 6.76c0 5.28-4.29 9.66-9.46 9.66Zm5.46-7.16c-.3-.15-1.77-.87-2.05-.97-.27-.1-.47-.15-.67.15s-.77.97-.94 1.17c-.17.2-.35.22-.65.07s-1.27-.47-2.42-1.5c-.9-.8-1.5-1.79-1.68-2.09-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51l-.57-.01a1.1 1.1 0 0 0-.8.37c-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.69.63.71.23 1.36.2 1.87.12.57-.08 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/></svg>
</a>
<script src="<?= e(base_url('assets/js/main.js')) ?>"></script>
</body>
</html>
