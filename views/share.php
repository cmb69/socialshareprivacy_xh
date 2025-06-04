<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $url
 * @var bool $facebook
 * @var bool $x
 * @var bool $xing
 * @var bool $linkedin
 */
?>

<figure class="socialshareprivacy_share">
  <figcaption>Share</figcaption>
  <div class="socialshareprivacy_links">
<?if ($facebook):?>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$this->esc($url)?>" target="_blank">facebook</a>
<?endif?>
<?if ($x):?>
    <a href="https://x.com/intent/post?url=<?=$this->esc($url)?>" target="_blank">X</a>
<?endif?>
<?if ($xing):?>
    <a href="https://www.xing.com/social/share/spi?url=<?=$this->esc($url)?>" target="_blank">XING</a>
<?endif?>
<?if ($linkedin):?>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?=$this->esc($url)?>" target="_blank">LinkedIn</a>
<?endif?>
  </div>
</figure>
