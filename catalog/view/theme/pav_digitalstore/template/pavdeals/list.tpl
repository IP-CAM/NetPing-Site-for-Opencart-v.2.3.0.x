<?php
	$span = floor(12/$cols);
?>

<?php echo $header; ?>
<div class="container">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	</ul>
	<div class="row"><?php echo $column_left; ?>
	<?php if ($column_left && $column_right) { ?>
	<?php $class = 'col-sm-6'; ?>
	<?php } elseif ($column_left || $column_right) { ?>
	<?php $class = 'col-sm-9'; ?>
	<?php } else { ?>
	<?php $class = 'col-sm-12'; ?>
	<?php } ?>
		<div id="content" class="<?php echo $class; ?> box productdeals"><?php echo $content_top; ?>
			<h3 class="hidden"><?php echo $objlang->get('deal_option'); ?></h3>
			<!-- Deal Option -->
			<div class="">
				<ul class="nav nav-tabs">
					<?php foreach ($head_titles as $item): ?>
					<?php if ($item['active']): ?>
					<li class="active"><a href="<?php echo $item['href'];?>"><?php echo $item['text'];?></a></li>
					<?php else: ?>
					<li><a href="<?php echo $item['href'];?>"><?php echo $item['text'];?></a></li>
					<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>

			<!-- Fillter Product -->
			<?php if (count($products) > 0): ?>
			<div class="row product-filter">
				<div class="display hidden">
				  <span><?php echo $objlang->get('text_display'); ?></span>
				  
				      <button type="button" id="list-view" class="btn btn-switch fa fa-th-list" data-toggle="tooltip" title="<?php echo $objlang->get("button_list"); ?>"></button>
				      <button type="button" id="grid-view" class="btn btn-switch fa fa-th-large" data-toggle="tooltip" title="<?php echo $objlang->get("button_grid"); ?>"></button>
				    
				 </div> 

				<div class="sort pull-right">
					<label class="control-label" for="input-sort"><?php echo $objlang->get('text_sort'); ?></label>
					<select id="input-sort" class="form-control" onchange="location = this.value;">
						<?php foreach ($sorts as $sorts) { ?>
						<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
						<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>

				<div class="limit pull-right">
					<label class="control-label" for="input-limit"><?php echo $objlang->get('text_limit'); ?></label>
					<select id="input-limit" class="form-control" onchange="location = this.value;">
						<?php foreach ($limits as $limits) { ?>
						<?php if ($limits['value'] == $limit) { ?>
						<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
			
				<div class="category pull-right">
					<label class="control-label" for="input-category"><?php echo $objlang->get('text_category'); ?></label>
					<select id="input-category" class="form-control" name="category_id" onchange="location = this.value;">
						<option value="<?php echo $href_default;?>"><?php echo $objlang->get("text_category_all"); ?></option>
						<?php foreach ($categories as $category_1) { ?>
						<?php if ($category_1['category_id'] == $category_id) { ?>
						<option value="<?php echo $category_1['href']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $category_1['href']; ?>"><?php echo $category_1['name']; ?></option>
						<?php } ?>
						<?php foreach ($category_1['children'] as $category_2) { ?>
						<?php if ($category_2['child_id'] == $category_id) { ?>
						<option value="<?php echo $category_2['href']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $category_2['href']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
						<?php } ?>

						<?php if (isset($category_2['children'])) { ?>
						<?php foreach ($category_2['children'] as $category_3) { ?>
						<?php if ($category_3['child_id'] == $category_id) { ?>
						<option value="<?php echo $category_3['href']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $category_3['href']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
						<?php } ?>
						<?php } //endforeach categories_2?>
						<?php } //endif endforeach categories_2?>

						<?php } //endforeach categories_1?>
						<?php } //endforeach categories_0?>
					</select>
				</div>

			</div>
			<?php endif; ?>

			<!-- List Product -->
			<?php if (count($products) > 0): ?>
			<div class=" productdeals">
				<div class="box-content" >
					<div class="products-block">
						<?php foreach( $products as $i => $product ):  $i=$i+1;?>
						<?php if( $i%$cols == 1 || $cols == 1): ?><div class="row products-row"><?php endif; ?>

							<div class="product-col product-layout  col-sm-<?php echo $span;?> col-xs-12">

								<div class="product-block">
									
									<?php if ($product['thumb']) { ?>
							      <div class="image">
							      	<?php if( $product['special'] ) {   ?>
							    	<span class="product-label-special label"><?php echo $objlang->get( 'text_sale' ); ?></span>
							    	<?php } ?>
							    	<a class="img" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a>

							      </div>
							    <?php } ?>  

									<div class="product-meta">
										
											<h4 class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
											<?php if ($product['price']) { ?>
											<p class="price">
												<?php if (!$product['special']) { ?>
												<?php echo $product['price']; ?>
												<?php } else { ?>
												<span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
												<?php } ?>
												<?php if (!empty($product['tax'])) { ?>
												<span class="price-tax"><?php echo $objlang->get('text_tax'); ?> <?php echo $product['tax']; ?></span>
												<?php } ?>
											</p>
											<?php } ?>
											<p class="description hidden"><?php echo $product['description']; ?></p>
											<?php if ($product['rating']) { ?>
											<div class="rating">
												<?php for ($i = 1; $i <= 5; $i++) { ?>
												<?php if ($product['rating'] < $i) { ?>
												<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
												<?php } else { ?>
												<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
												<?php } ?>
												<?php } ?>
											</div>
											<?php } ?>
											<?php if( !isset($listingConfig['catalog_mode']) || !$listingConfig['catalog_mode'] ) { ?>
												<div class="cart pull-left">
												
													<input type="button" value="<?php echo $objlang->get("button_cart"); ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');" class="button" />			
												</div>
											<?php } ?>
											 <div class="wishlist-compare">
											 	<span class="wishlist">
											 		<a class="fa fa-heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"  title="<?php echo $objlang->get("button_wishlist"); ?>" >
											  			<span><?php echo $objlang->get("button_wishlist");?></span>
											  		</a>
											 	</span>
											 	<span class="compare">
											 		<a class="fa fa-retweet"  onclick="compare.add('<?php echo $product['product_id']; ?>');" title="<?php echo $objlang->get("button_compare"); ?>" >
											  			<span><?php echo $objlang->get("button_compare"); ?></span>
											  		</a>
											 	</span>  
											</div>	
											
						
																		
									<!-- count down -->
										<div class="group-deals">
											<div class="deal-collection text-left">
												<div class="deal_detail">
													<ul>
														<li>
															<span><?php echo $objlang->get("text_discount");?></span>
															<span class="deal_detail_num"><?php echo $product['deal_discount'];?>%</span>
														</li>
														<li>
															<span><?php echo $objlang->get("text_you_save");?></span>
															<span class="deal_detail_num"><span class="price"><?php echo $product["save_price"]; ?></span></span>
														</li>
														<li>
															<span><?php echo $objlang->get("text_bought");?></span>
															<span class="deal_detail_num"><?php echo $product['bought'];?></span>
														</li>
													</ul>
												</div>
												<div class="deal-qty-box">
													<?php echo sprintf($objlang->get("text_quantity_deal"), $product["quantity"]);?>
												</div>

												<div class="item-detail">
													<div class="timer-explain">(<?php echo date($objlang->get("date_format_short"), strtotime($product['date_end_string'])); ?>)</div>
												</div>
											</div>
											<div id="item<?php echo $module; ?>countdown_<?php echo $product['product_id']; ?>" class="item-countdown"></div>
											<script type="text/javascript">
												jQuery(document).ready(function($){
													$("#item<?php echo $module; ?>countdown_<?php echo $product['product_id']; ?>").lofCountDown({
														formatStyle:2,
														TargetDate:"<?php echo date('m/d/Y G:i:s', strtotime($product['date_end_string'])); ?>",
														DisplayFormat:"<ul><li>%%D%% <div><?php echo $objlang->get("text_days");?></div></li><li> %%H%% <div><?php echo $objlang->get("text_hours");?></div></li><li> %%M%% <div><?php echo $objlang->get("text_minutes");?></div></li><li> %%S%% <div><?php echo $objlang->get("text_seconds");?></div></li></ul>",
														FinishMessage: "<?php echo $objlang->get('text_finish');?>"
													});
												});
											</script>
										</div>
							
									</div>		
								</div>


								
							</div>
						<?php if($i%$cols == 0): ?>
						</div>
						<?php endif; ?>

						<?php endforeach; ?>

						
					</div><!--end product-grid-->
				</div><!--end box-content-->

			</div><!-- end div content list product -->

			<!-- pagination -->
			<div class="paging clearfix">
				<div class="pull-left"><?php echo $pagination; ?></div>
				<div class="pull-right"><?php echo $results; ?></div>
			</div>
			<?php endif; ?>


			<?php echo $content_bottom; ?>
		</div><!-- end div #content -->
		<?php echo $column_right; ?>
	</div><!-- end div .row -->
</div><!-- end div .container -->
<?php echo $footer; ?>
