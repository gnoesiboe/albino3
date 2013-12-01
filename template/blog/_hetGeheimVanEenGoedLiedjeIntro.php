<?php $path = '/blog/het-geheim-van-een-goed-liedje'; ?>
<section>
  <h2 class="title-first">Het geheim van een goed liedje</h2>

  <div class="meta-info">11 november 2013</div>

  <p class="spacer-2">
    Elke dag worden we overspoeld door muziek. Gek genoeg is er maar een keer in de zoveel tijd een liedje wat ons echt raakt. Oorstrelend en kippenvel-gevend mooi. Wat zorgt er nou voor dat juist dat ene lied je raakt en hoe schrijf je zelf zo’n song?
    <a href="/blog/het-geheim-van-een-goed-liedje" class="read-on">&raquo; Lees verder</a>
  </p>

  <div class="image-holder">
    <a href="<?php echo $path; ?>" class="no-border"><img src="/images/blog/bird.png" alt="" width="100%" class="img-full" /></a>
  </div>

  <?php echo $this->renderView(dirname(__FILE__) . '/../_social.php', array(
    'absoluteUrl' => 'http://' . $_SERVER['HTTP_HOST'] . $path
  )); ?>
</section>