<?php if (count($languages) > 1) { ?>
<div class="language-wrapper">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language">
  <div class="btn-group">
    <button type="button" class="btn-dropdown dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <span><img class="" src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"></span>
    <?php } ?>
    <?php } ?>
    <span class="hidden"><?php echo $text_language; ?></span>
    <span class="fa fa-sort-desc"></span>
  </button>
    <ul class="dropdown-menu dropdown">
      <?php foreach ($languages as $language) { ?>
      <li><button class="language-select list-item" type="button" name="<?php echo $language['code']; ?>"><img src="catalog/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" alt="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></button></li>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
