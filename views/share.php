<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $url
 * @var string $script
 * @var bool $facebook
 * @var bool $x
 * @var bool $xing
 * @var bool $linkedin
 */
?>

<script type="module" src="<?=$this->esc($script)?>"></script>
<figure class="socialshareprivacy_share">
  <figcaption>Share</figcaption>
  <div class="socialshareprivacy_links">
<?if ($facebook):?>
    <a class="socialshareprivacy_facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$this->esc($url)?>" data-share-url="https://www.facebook.com/sharer/sharer.php?u=" target="_blank">
      <img src="./plugins/socialshareprivacy/images/facebook.svg" height="32" alt="facebook logo">
    </a>
<?endif?>
<?if ($x):?>
    <a class="socialshareprivacy_x" href="https://x.com/intent/post?url=<?=$this->esc($url)?>" data-share-url="https://x.com/intent/post?url=" target="_blank">
      <img src="./plugins/socialshareprivacy/images/x.svg" height="32" alt="X logo">
    </a>
<?endif?>
<?if ($xing):?>
    <a class="socialshareprivacy_xing" href="https://www.xing.com/social/share/spi?url=<?=$this->esc($url)?>" data-share-url="https://www.xing.com/social/share/spi?url=" target="_blank">
      <img src="./plugins/socialshareprivacy/images/xing.svg" height="32" alt="XING logo">
    </a>
<?endif?>
<?if ($linkedin):?>
    <a class="socialshareprivacy_linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?=$this->esc($url)?>" data-share-url="https://www.linkedin.com/sharing/share-offsite/?url=" target="_blank">
      <img src="./plugins/socialshareprivacy/images/linkedin.svg" height="32" alt="LinkedIn logo">
    </a>
<?endif?>
  </div>
</figure>
