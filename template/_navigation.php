<?php $path = $_SERVER['REQUEST_URI']; ?>
<ul id="navigation">
  <li><a href="/"<?php echo $path === '/' ? ' class="active"' : ''; ?>><img src="/images/house.png" alt="" /></a></li>
  <li><a href="/blog"<?php echo $path === '/blog' ? ' class="active"' : ''; ?>>blog</a></li>
  <li><a href="/muziektherapie"<?php echo $path === '/muziektherapie' ? ' class="active"' : ''; ?>>muziektherapie</a></li>
  <li><a href="/songwritingles"<?php echo $path === '/songwritingles' ? ' class="active"' : ''; ?>>songwritingles</a></li>
  <li><a href="/zangles"<?php echo $path === '/zangles' ? ' class="active"' : ''; ?>>zangles</a></li>
  <li><a href="/workshops"<?php echo $path === '/workshops' ? ' class="active"' : ''; ?>>workshops</a></li>
  <li><a href="/over-lijflied"<?php echo $path === '/over-lijflied' ? ' class="active"' : ''; ?>>over lijflied</a></li>
  <li><a href="/contact"<?php echo $path === '/contact' ? ' class="active"' : ''; ?>>contact</a></li>
</ul>