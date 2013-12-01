<?php

/**
 * @var \Albino\View\Template $this
 */

$imagePath = '/images/blog/bird.png';
$this->set('ogTitle', 'Het geheim van een goed liedje');
$this->set('ogImage', 'http://' . $_SERVER['HTTP_HOST'] . $imagePath);
$this->set('ogDescription', "Muziek is veel meer dan een gelukkige combinatie van melodie, akkoorden en tekst. Jouw humeur van die dag, jouw smaak en jouw herinneringen spelen een belangrijke rol in hoe jij muziek ervaart. Muziek is gevoel. Als op en top mens beslissen we elke dag wat we met onze gevoelens doen, wegstoppen, uithuilen of juist omzetten in iets creatiefs.");

?>
<section>
  <h1 class="title-first">Het geheim van een goed liedje</h1>
  <div class="meta-info">11 november 2013</div>
  <p class="intro">Elke dag worden we overspoeld door muziek. Gek genoeg is er maar een keer in de zoveel tijd een liedje wat ons echt raakt. Oorstrelend en kippenvel-gevend mooi. Wat zorgt er nou voor dat juist dat ene lied je raakt en hoe schrijf je zelf zo’n song?</p>

  <div class="image-holder">
    <img src="<?php echo $imagePath; ?>" alt="" class="img-full" />
  </div>

  <p>
    Muziek is veel meer dan een gelukkige combinatie van melodie, akkoorden en tekst. Jouw humeur van die dag, jouw smaak en jouw herinneringen spelen een belangrijke rol in hoe jij muziek ervaart. Muziek is gevoel. Als op en top mens beslissen we elke dag wat we met onze gevoelens doen, wegstoppen, uithuilen of juist omzetten in iets creatiefs. <br />
    En dat is nou precies de kracht van een goede liedjes schrijver; je eigenheid gebruiken en je gevoel op papier krijgen. Dit is een belangrijke voorwaarde voor een uniek liedje wat mensen raakt.
  </p>

  <p>Tv talentenjachten zoals ‘De beste singer/songwriter’ en ‘The voice of Holland’ zorgen ervoor dat de liedjes schrijver steeds meer op de voorgrond komt te staan. Maar hoe schrijf je nou zelf een lied? Hieronder 3 punten om je alvast op weg te helpen.</p>

  <h2 class="title-second">1. Inspiratie</h2>
  <p>
    Welk verhaal wil je vertellen, wat wil je kwijt? Zoek dit dicht bij jezelf om ‘n geloofwaardige song te schrijven. Als je 100% zelf gelooft wat je zingt, zullen anderen dat ook doen!<br />
    Geen inspiratie? Ga eens buiten op ‘n bankje zitten, kijk bewust wat er om je heen gebeurt of waar je je over verwondert. Of hou eens in een notitieboekje bij waar je over hebt zitten tobben. Wedden dat de inspiratie komt?
  </p>

  <h2 class="title-second">2. Muzikale puzzel</h2>
  <p>Pak een van je favoriete songs erbij en luister wat daarin gebeurt. Wat vind je er eigenlijk zo mooi aan? Zoek het akkoorden schema eens op en pik er 1 ding uit wat je wil gebruiken. Pak je instrument erbij en voeg eigen ideeën toe. Ga zoeken, zingen en puzzelen wat muzikaal bij elkaar past. Probeer in de beginfase al tekst, akkoorden en melodie samen te voegen. Een sleutelwoord is in ieder geval; hou het simpel. Zoals ‘Stay’ van Rihanna & Mikky Ekko. Deze song maakt slim gebruik van een steeds herhalend akkoorden patroon. Misschien niet jouw smaak, maar wel een goed voorbeeld van een sterk en eenvoudig liedje. Simpele liedjes blijven vaak beter hangen en klinken authentiek.</p>

  <h2 class="title-second">3. Jouw eigenheid</h2>
  <p>
    Wanneer de grote lijnen van je song staan, gooi er dan nog een extra sausje over heen; Wat is op en top jij? Dit kan jouw unieke zangstem zijn, een manier van aanslaan op de gitaar of gebruik hiphop beats bij je rocksong. Durf anders te zijn!<br />
    Lastig om te zien wat bij jou past? Begin eens met het coveren van een aantal liedjes. Zo krijg je meer gevoel voor jouw eigen stijl.
  </p>

  <p>Tot slot: Als jij het mooi vind, is het ook mooi! Ben vooral niet bang om verschillende dingen uit te proberen.</p>
  <p>Meer leren over liedjes schrijven of ontdekken wat nou jouw eigenheid is? Lijflied is een muziekpraktijk in Goirle waar je oa lessen in songwriting kan volgen.</p>

  <?php echo $this->renderView(dirname(__FILE__) . '/../_social.php'); ?>
</section>