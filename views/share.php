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
  <figcaption><?=$this->text("label_share")?></figcaption>
  <div class="socialshareprivacy_links">
<?if ($facebook):?>
    <a class="socialshareprivacy_facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=$this->esc($url)?>" data-share-url="https://www.facebook.com/sharer/sharer.php?u=" title="<?=$this->text("label_share_facebook")?>" target="_blank">
      <img src="./plugins/socialshareprivacy/images/facebook.svg" height="32" alt="<?=$this->text("alt_facebook")?>">
    </a>
<?endif?>
<?if ($x):?>
    <a class="socialshareprivacy_x" href="https://x.com/intent/post?url=<?=$this->esc($url)?>" data-share-url="https://x.com/intent/post?url=" title="<?=$this->text("label_share_x")?>" target="_blank">
      <img src="./plugins/socialshareprivacy/images/x.svg" height="32" alt="<?=$this->text("alt_x")?>">
    </a>
<?endif?>
<?if ($xing):?>
    <a class="socialshareprivacy_xing" href="https://www.xing.com/social/share/spi?url=<?=$this->esc($url)?>" data-share-url="https://www.xing.com/social/share/spi?url=" title="<?=$this->text("label_share_xing")?>" target="_blank">
      <img src="./plugins/socialshareprivacy/images/xing.svg" height="32" alt="<?=$this->text("alt_xing")?>">
    </a>
<?endif?>
<?if ($linkedin):?>
    <a class="socialshareprivacy_linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?=$this->esc($url)?>" data-share-url="https://www.linkedin.com/sharing/share-offsite/?url=" title="<?=$this->text("label_share_linkedin")?>" target="_blank">
      <img src="./plugins/socialshareprivacy/images/linkedin.svg" height="32" alt="<?=$this->text("alt_linkedin")?>">
    </a>
<?endif?>
  </div>
</figure>
