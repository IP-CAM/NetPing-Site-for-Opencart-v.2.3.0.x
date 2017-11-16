<div class="product-block" itemtype="http://schema.org/Product" itemscope>
<table>
<tr>  <?php if ($product['thumb']) { ?>
      <div class="image">
      	<?php if( $product['special'] ) {   ?>
    	<span class="product-label-special label"><?php echo $objlang->get( 'text_sale' ); ?></span>
    	<?php } ?>
    	<a class="img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a>
    	<?php if ($quickview) { ?>
		<a class="pav-colorbox iframe-link hidden-sm hidden-xs" href="<?php echo $ourl->link('themecontrol/product','product_id='.$product['product_id']);?>"  title="<?php echo $objlang->get('quick_view'); ?>" >
			<span class='fa fa-eye'></span><?php echo $objlang->get('quick_view'); ?></a>
		<?php } ?>  	
      </div>
    <?php } ?>  
	
<td><div class="product-meta">
			<h4 class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
			
			<?php if ($product['price']) { ?>
			<div class="price" itemtype="http://schema.org/Offer" itemscope itemprop="offers">
				<?php if (!$product['special']) {  ?>
					<span class="special-price"><?php echo $product['price']; ?></span>
					<?php if( preg_match( '#(\d+).?(\d+)#',  $product['price'], $p ) ) { ?> 
					<meta content="<?php echo $p[0]; ?>" itemprop="price">
					<?php } ?>
				<?php } else { ?>
					<span class="price-new"><?php echo $product['special']; ?></span>
					<span class="price-old"><?php echo $product['price']; ?></span> 
					<?php if( preg_match( '#(\d+).?(\d+)#',  $product['special'], $p ) ) { ?> 
					<meta content="<?php echo $p[0]; ?>" itemprop="price">
					<?php } ?>
				<?php } ?>
				<meta content="<?php ?>" itemprop="priceCurrency">
			</div>
			<?php } ?>

			<!--<?php if( isset($product['description']) ){ ?> 
				<div class="description" itemprop="description"><?php echo utf8_substr( strip_tags($product['description']),0,256);?>...</div>
			<?php } ?>-->
			
			<!-- Product Short Description module -->
			<div class="sh-desc-list text-links"><p><?php echo $product['description']; ?></p></div>
			<!--<p><?php echo $product['description']; ?></p>-->


		 	  <?php if ( isset( $product['rating']) ) { ?>
             <!-- <div class="rating">
                <?php for ($is = 1; $is <= 5; $is++) { ?>
                <?php if ($product['rating'] < $is) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                <?php } ?>
                <?php } ?>
              </div> -->
              <?php } ?>

            <?php if( !isset($listingConfig['catalog_mode']) || !$listingConfig['catalog_mode'] ) { ?>
			<!-- <div class="cart pull-left">
				
					<input type="button" value="<?php echo $objlang->get("button_cart"); ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button" />			
				</div> -->
			<?php } ?>
			 <div class="wishlist-compare">
			<!-- 	<span class="wishlist">
			 		<a class="fa fa-heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"  title="<?php echo $objlang->get("button_wishlist"); ?>" >
			  			<span><?php echo $objlang->get("button_wishlist");?></span>
			  		</a>
			 	</span> -->
			 	<span class="compare">
			 		<a class="fa fa-retweet"  onclick="compare.add('<?php echo $product['product_id']; ?>');" title="<?php echo $objlang->get("button_compare"); ?>" >
			  			<span><?php echo $objlang->get("button_compare"); ?></span>
			  		</a>
			 	</span>  
			</div>			
	</div></td></tr>
</table>
</div>





