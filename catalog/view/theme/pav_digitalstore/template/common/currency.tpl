<?php if (count($currencies) > 1) { ?>
<div class="currency-wrapper">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-currency">
  <div class="btn-group">
    <button type="button" class="btn-dropdown dropdown-toggle" data-toggle="dropdown">
    <?php foreach ($currencies as $currency) { ?>
    <?php if ($currency['symbol_left'] && $currency['code'] == $code) { ?>
    <span><?php echo $currency['symbol_left']; ?></span>
    <?php } elseif ($currency['symbol_right'] && $currency['code'] == $code) { ?>
    <strong><?php echo $currency['symbol_right']; ?></strong>
    <?php } ?>
    <?php } ?>
   
    <span class="hidden"><?php echo $text_currency; ?></span>  
    <span class="fa fa-sort-desc"></span>
  </button>
    <ul class="dropdown-menu">
      <?php foreach ($currencies as $currency) { ?>
      <?php if ($currency['symbol_left']) { ?>
      <li><button class="currency-select list-item" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_left']; ?> <?php echo $currency['title']; ?></button></li>
      <?php } else { ?>
      <li><button class="currency-select list-item" type="button" name="<?php echo $currency['code']; ?>"><?php echo $currency['symbol_right']; ?> <?php echo $currency['title']; ?></button></li>
      <?php } ?>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
