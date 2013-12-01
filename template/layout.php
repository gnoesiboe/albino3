<?php

/**
 * @var string $content
 * @var \Albino\View\Template $this
 */

$metaTitle = ($this->has('seoTitle') === true ? $this->get('seoTitle') : '') . 'Lijflied - Muziektherapie, songwritingles, zangles en workshops in Goirle';
$metaDescription = $this->has('metaDescription') === true ? $this->get('metaDescription') : 'Lijflied wil jouw leven mooier maken met muziek. Je talent ontwikkelen, uitlaatklep nodig of persoonlijke problemen aanpakken? dat bepaal jij! Bij lijflied kun je terecht voor muziektherapie, songwritingles, zangles en workshops waar jouw eigenheid centraal staat. Muziekpraktijk in Goirle';
$metaKeywords = $this->has('metaKeywords') === true ? $this->get('metaKeywords') : 'Lijflied, Christel van der Bruggen, muziek, muziekles, Muziektherapie, Songwritingles, Zangles, afasie, mantelzorgers, nah, zelfvertrouwen, kanker, traumaverwerking, verliesverwerking, handicap, eigenheid, Workshops, Ontspanning, Zang en Stem, Therapeutische songwriting, Muziekpraktijk, Therapeutisch liedjesschrijven, Goirle';

$ogTitle = $this->has('ogTitle') === true ? $this->get('ogTitle') : $metaTitle;
$ogUrl = $this->has('ogUrl') === true ? $this->get('ogUrl') : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$ogDescription = $this->has('ogDescription') === true ? $this->get('ogDescription') : $metaDescription;
$ogImage = $this->has('ogImage') === true ? $this->get('ogImage') : 'http://' . $_SERVER['HTTP_HOST'] . '/images/logo.jpg';
$ogType = $this->has('ogType') === true ? $this->get('ogType') : 'website';

?><!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="nl"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="nl"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="nl"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html xmlns="http://www.w3.org/1999/xhtml" class="no-js" lang="nl" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="<?php echo $metaTitle; ?>" />
    <meta name="keywords" content="<?php echo $metaKeywords; ?>" />
    <meta name="description" content="" />
    <meta name="language" content="nl" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta property="og:site_name" content="Lijflied.com"/>
    <meta property="og:locale" content="nl_NL">
    <meta property="og:title" content="<?php echo $ogTitle; ?>" />
    <meta property="og:url" content="<?php echo $ogUrl; ?>" />
    <meta property="og:description" content="<?php echo $ogDescription; ?>">
    <meta property="og:image" content="<?php echo $ogImage; ?>" />
    <meta property="og:type" content="<?php echo $ogType; ?>" />

    <title><?php echo $metaTitle; ?></title>

    <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/css/layout.css" />

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  </head>
  <body>
    <script type="text/javascript" src="/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="/js/init.js"></script>

    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=160840050770396";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="container">
      <div id="header">
        <div class="social">
          <a href="https://www.facebook.com/lijflied" rel="external"><img src="/images/social/facebook.png" alt="" /></a>
          <a href="http://www.linkedin.com/profile/view?id=294950687" rel="external"><img src="/images/social/linkedin.png" alt="" /></a>
        </div>

        <div id="logo"><!-- --></div>

        <a href="/" id="title">Lijflied</a>
        <div id="slogan">Muziek, op jouw lijf geschreven</div>

        <?php echo $this->renderView(dirname(__FILE__) . '/_navigation.php'); ?>
      </div>

      <div id="content">
        <div id="left">
          <?php echo $content; ?>
        </div>
        <div id="right">
          <?php echo $this->renderView(dirname(__FILE__) . '/contact/_teaser.php'); ?>
          <?php echo $this->renderView(dirname(__FILE__) . '/about/_aboutLijflied.php'); ?>
        </div>
      </div>
    </div>

    <div id="footer"><!-- --></div>

    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-44278803-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </body>
</html>