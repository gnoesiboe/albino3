<?php

/**
 * @var string $absoluteUrl
 */

$absoluteUrl = isset($absoluteUrl) === true ? $absoluteUrl : 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<ul class="social">
  <li>
    <div class="fb-like" data-href="<?php echo $absoluteUrl; ?>" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
  </li>
  <li>
    <div class="fb-share-button" data-href="<?php echo $absoluteUrl; ?>" data-type="box_count"></div>
  </li>
  <li>
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $absoluteUrl; ?>" data-lang="en" data-count="vertical" data-dnt="true">Tweet</a>
  </li>
</ul>