<?php

/**
 * @var \Albino\View\Template $this
 */

$this->set('ogTitle', 'Lied-schrijven als therapie');
$this->set('ogDescription', "Schrijf van je af, Letterlijk. Stop het in een liedje, zing de longen uit je lijf en voel je beter. Therapeutisch liedjes schrijven geeft je meer inzicht in wat je nou eigenlijk voelt en denkt, en zorgt ervoor dat je dit een plekje kan geven. Vertel jouw eigen verhaal en zorg er onderweg voor dat je meer ontspannen wordt, sterker wordt, trotser wordt. Groeien, terwijl je toch dicht bij jezelf blijft. Jouw verhaal, jouw liedje.");

?>
<section>
  <h1 class="title-first">Lied-schrijven als therapie</h1>
  <span class="meta-info">12 november 2013</span>
  <p>Schrijf van je af, Letterlijk. Stop het in een liedje, zing de longen uit je lijf en voel je beter</p>
  <p>Therapeutisch liedjes schrijven geeft je meer inzicht in wat je nou eigenlijk voelt en denkt, en zorgt ervoor dat je dit een plekje kan geven. Vertel jouw eigen verhaal en zorg er onderweg voor dat je meer ontspannen wordt, sterker wordt, trotser wordt. Groeien, terwijl je toch dicht bij jezelf blijft. Jouw verhaal, jouw liedje.</p>
  <p class="spacer-2">Muziektherapeut en docent Christel laat horen wat je kan verwachten van lied-schrijven als therapie.</p>

  <div class="spacer-2 video">
    <iframe width="500" height="281" src="//www.youtube.com/embed/l0MivCGoWmg?rel=0" frameborder="0" allowfullscreen></iframe>
  </div>

  <?php echo $this->renderView(dirname(__FILE__) . '/../_social.php'); ?>
</section>