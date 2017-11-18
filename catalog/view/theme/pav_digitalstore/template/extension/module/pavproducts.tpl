<?php 

	$span = 12/$cols; 
	$active = 'latest';
	$id = rand(1,9)+rand();	
	$config = $sconfig;;
	$theme = $themename;
	$themeConfig = (array)$config->get('themecontrol');
		$listingConfig = array(
		'category_pzoom'                     => 1,
		'quickview'                          => 0,
		'show_swap_image'                    => 0,
		'product_layout'		=> 'default',
		'enable_paneltool'	                 => 0
	);
	$listingConfig      = array_merge($listingConfig, $themeConfig );
	$categoryPzoom 	    = $listingConfig['category_pzoom'];
	$quickview          = $listingConfig['quickview'];
	$swapimg            = $listingConfig['show_swap_image'];
	$categoryPzoom      = isset($themeConfig['category_pzoom']) ? $themeConfig['category_pzoom']:0; 

	if( $listingConfig['enable_paneltool'] && isset($_COOKIE[$theme.'_productlayout']) && $_COOKIE[$theme.'_productlayout'] ){
		$listingConfig['product_layout'] = trim($_COOKIE[$theme.'_productlayout']);
	} 
	$productLayout = DIR_TEMPLATE.$theme.'/template/common/product/'.$listingConfig['product_layout'].'.tpl';	
	if( !is_file($productLayout) ){
		$listingConfig['product_layout'] = 'default';
	}
	$productLayout = DIR_TEMPLATE.$theme.'/template/common/product/'.$listingConfig['product_layout'].'.tpl';
?>

<div class="box pav-categoryproducts no-boxshadown">
<?php if( !empty($module_description) ) { ?>
 <div class="module-desc">
	<?php echo $module_description;?>
 </div>
 <?php } ?>
  

	<div class="box-content">
	
					<div class="tab-nav">
							<ul class="h-tabs" id="producttabs<?php echo $id;?>">
								<?php $width = (100/count($tabs));?>
								<?php foreach( $tabs as $tab => $category ) { 
									if( empty($category) ){ continue;}
									$tab = 'cattabs';
										
									///	echo '<pre>'.print_r( $category,1 ); die; 
									$products = $category['products'];
									$icon = $model_resize->resize( $category['image'], 90, 53 ); 
								?>
									 <li style="width:<?php echo $width;?>%">
									 <a href="#tab-<?php echo $tab.$id.$category['category_id'];?>" data-toggle="tab">
										<?php if ( $icon ) { ?><img class="hidden-sm hidden-xs pull-left" src="<?php echo $icon;?>" alt="<?php echo $tab.$id.$category['category_id'];?>"><?php } ?>
										<?php echo $category['category_name'];?>
									 </a>
									 </li>
								<?php } ?>
							</ul>
					  </div>
					<div class="tab-content">  
						<?php foreach( $tabs as $tab => $category ) { 
						if( empty($category) ){ continue;}
						$tab = 'boxcats';

						$products = $category['products'];
				$icon = $model_resize->resize( $category['image'], 45,45 ); 
						?>
						<div class="tab-pane cat-products-block <?php echo $category['class'];?> clearfix" id="tab-cattabs<?php echo $id.$category['category_id'];?>">	
					<?php if( count($products) > $itemsperpage ) { ?>
							<a class="carousel-control left" href="#<?php echo $tab.$id.$category['category_id'];?>"   data-slide="prev">&lsaquo;</a>
							<a class="carousel-control right" href="#<?php echo $tab.$id.$category['category_id'];?>"  data-slide="next">&rsaquo;</a>
					
						<?php } ?>
						<div class="box-products  pavproducts<?php echo $id;?> slide" id="<?php echo $tab.$id.$category['category_id'];?>">
						
						<div class="carousel-inner ">		
						 <?php $pages = array_chunk( $products, $itemsperpage);	 ?>	
						  <?php foreach ($pages as  $k => $tproducts ) {   ?>
								<div class="item <?php if($k==0) {?>active<?php } ?> products-block">
									<?php foreach( $tproducts as $i => $product ) { ?>
										<?php if( $i++%$cols == 0 ) { ?>
										  <div class="row products-row">
										<?php } ?>
											<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12 product-col">
                                         		<?php require( $productLayout );  ?>
											</div>
									  
									  <?php if( $i%$cols == 0 || $i==count($tproducts) ) { ?>
										 </div>
										<?php } ?>
									<?php } //endforeach; ?>
								</div>
						  <?php } ?>
						</div>  
						</div>
						</div>		
						<?php } // endforeach of tabs ?>	
					</div>

	</div>
</div>


<script type="text/javascript">
$(function () {
	$('.pavproducts<?php echo $id;?>').carousel({interval:99999999999999,auto:false,pause:'hover'});
	$('#producttabs<?php echo $id;?> a:first').tab('show');
});
</script>
