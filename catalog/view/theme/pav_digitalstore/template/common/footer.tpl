<?php
  $blockid = 'mass_bottom';
  $blockcls = '';
  $modules = $helper->getModulesByPosition( $blockid ); 
  $ospans = array(1=>12, 2=>12);
  $tmcols = 'col-sm-12 col-xs-12';
  require( ThemeControlHelper::getLayoutPath( 'common/block-cols.tpl' ) );
?>
 
<footer id="footer">
 
  <?php
    $blockid = 'footer_top';
    $blockcls = '';
    $modules = $helper->getModulesByPosition( $blockid ); 
    $ospans = array();
   if( count($modules) &&  $helper->getConfig('enable_footer_center') ){
    require( ThemeControlHelper::getLayoutPath( 'common/block-footcols.tpl' ) );

  } else { ?>
   <div class="footer-top">
    <div class="container">
      <div class="inner">
        <div class="row">
          <?php if( $content=$helper->getLangConfig('widget_social') ) {?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <?php echo $content; ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>     
   </div> 
<?php } ?> 

  <?php
  /**
   * Footer Center Position
   * $ospans allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
   */
  $blockid = 'footer_center';
  $blockcls = '';
  $modules = $helper->getModulesByPosition( $blockid ); 
  $ospans = array();
  if( count($modules) &&  $helper->getConfig('enable_footer_center') ){
    require( ThemeControlHelper::getLayoutPath( 'common/block-footcols.tpl' ) );

  } else { ?>
  
  <div class="footer-center">
    <div class="container">
      <div class="inner">
        <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 column">
          <div class="box">
            <div class="box-heading"><span><?php echo $text_service; ?></span></div>
            <ul class="list" style="list-style: none outside none; padding: 0;">
			  <li><a href="../buy">How to buy?</a></li>
              <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
			  <li><a href="../support">Support</a></li>
            </ul>
          </div>
		  <br>
		  <div class="box">
            <div class="box-heading"><span>Partners</span></div>
            <ul class="list" style="list-style: none outside none; padding: 0;">
			  <li><a href="../partners">Official partners</a></li>
			  <li><a href="../partnership-how-to">How to become a partner?</a></li>
<!--              <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
              <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
              <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>-->
            </ul>
          </div>
        </div>
<!--        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 column">
          <div class="box">
            <div class="box-heading"><span><?php echo $text_account; ?></span></div>
            <ul class="list" style="list-style: none outside none; padding: 0;">
              <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
              <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
              <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
              <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
              <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
            </ul>
          </div>
        </div>
-->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 column">
	      <div class="box">
		    <div class="box-heading"><span><?php echo $text_information; ?></span></div>
            <ul class="list" style="list-style: none outside none; padding: 0;">
              <?php foreach ($informations as $information) { ?>
              <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
              <li><a href="../#">News</a></li>
			  <li><a href="../#">Tutorial</a></li>
			  <li><a href="../#">FAQ</a></li>
			  <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
			  <?php } ?>
            </ul>
           </div>
	    </div>
         <?php if( $content=$helper->getLangConfig('widget_contact_us') ) {?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 column">
            <div class="box contact-us">
              <div class="box-heading"><span><?php echo $objlang->get('text_contact_us'); ?></span></div>
              <?php echo $content; ?>
            </div>
          </div>
          <?php } ?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 column">
            <?php
              echo $helper->renderModule('pavnewsletter');
            ?>
          </div>
    </div>
    </div>
     </div> </div> 
<?php  } ?> 


  <?php
    $blockid = 'footer_bottom';
    $blockcls = '';
    $ospans = array();
    require( ThemeControlHelper::getLayoutPath( 'common/block-footcols.tpl' ) );
  ?>

</footer>
 
<div id="powered">
  <div class="container">
    <div class="inner clearfix">
      <div class="copyright pull-left">
        <?php if( $helper->getConfig('enable_custom_copyright', 0) ) { ?>
          <?php echo $helper->getConfig('copyright'); ?>
        <?php } else { ?>
          <?php echo $powered; ?>. 
        <?php } ?>
      </div>  
      <?php if( $content=$helper->getLangConfig('widget_paypal') ) {?>
        <div class="paypal pull-right">
            <?php echo $content; ?>
        </div>
        <?php } ?>
      
        
      </div>
    </div>   
  </div>
<div id="top" class="bo-social-icons">
    <a href="#" class="bo-social-gray radius-x scrollup"><i class="fa fa-angle-up"></i></a>
  </div>
<?php if( $helper->getConfig('enable_paneltool',0) ){  ?>
  <?php  echo $helper->renderAddon( 'panel' );?>
<?php  } ?>

</div>
<?php
  $offcanvas = $helper->getConfig('offcanvas','category');
  if($offcanvas == "megamenu") {
      echo $helper->renderAddon( 'offcanvas');
  } else {
      echo $helper->renderAddon( 'offcanvas-category');
  }

  ?> 
</div>
</body></html>