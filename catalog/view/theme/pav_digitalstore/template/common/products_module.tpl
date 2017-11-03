<?php 
	$cols = 4;
	$span = 12/$cols;
	$config = $sconfig; 
	$theme = $themename;
	$themeConfig  	 			= (array)$config->get('themecontrol');
	$listingConfig  			= array( 		
		'category_pzoom' 		=> 1,
		'show_swap_image' 		=> 0,
		'quickview' 			=> 0,
		'product_layout'		=> 'default',
		'catalog_mode'			=> '',
	); 
	$listingConfig  			= array_merge($listingConfig, $themeConfig );
	$categoryPzoom 	    		= $listingConfig['category_pzoom'];
	$quickview 					= $listingConfig['quickview'];
	$swapimg 					= ($listingConfig['show_swap_image'])?'swap':'';
 

	$productLayout = DIR_TEMPLATE.$theme.'/template/common/product/'.$listingConfig['product_layout'].'.tpl';	
	if( !is_file($productLayout) ){
		$listingConfig['product_layout'] = 'default';
	}
	$productLayout = DIR_TEMPLATE.$theme.'/template/common/product/'.$listingConfig['product_layout'].'.tpl';	
?>

<div class="box-heading">
	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
	<span><?php echo $heading_title; ?></span>
	<em class="line"></em>
</div>
<?php if(!empty($products)){ ?>
<div class="box-content">
	<div id="product-<?php echo $carousel; ?>" class="slide product-grid" data-interval="0">
		<?php if(count($products) > $cols){ ?>
		<div class="carousel-controls">
	      <a class="carousel-control left fa fa-angle-left" href="#product-<?php echo $carousel; ?>" data-slide="prev"></a>
	      <a class="carousel-control right fa fa-angle-right" href="#product-<?php echo $carousel; ?>" data-slide="next"></a>
	    </div>
		<?php } ?>
		<div class="carousel-inner">
			<?php foreach ($products as $i => $product) { $i=$i+1; ?>
			<?php if( $i%$cols == 1 && $cols > 1 ) { ?>
			<div class= "item <?php if($i==1) {?>active<?php } ?>">	<div class="products-block-">
				<div class="row products-row">
			<?php } ?>
				<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12 product-col">
					<?php require( $productLayout );  ?>
				</div>
			<?php if( $cols > 1  && ($i%$cols == 0 || $i==count($products)) ) { ?>
				</div>
			</div>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
$('#products-<?php echo $carousel; ?>').carousel({interval:false});
</script>