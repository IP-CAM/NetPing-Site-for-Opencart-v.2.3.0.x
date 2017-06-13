<nav id="topbar">
  <div class="container">
  		<div class="row">
  			<div class="col-lg-5 col-md-4">
				<div class="welcome pull-left">
					<?php if ($logged) { ?>
		            <a href="<?php echo $account; ?>"><?php echo $text_account; ?></a> -
		            <a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a>
		            <?php } else { ?>
		            <a href="<?php echo $register; ?>"><?php echo $text_register; ?></a> or
		            <a href="<?php echo $login; ?>"><?php echo $text_login; ?></a>
		            <?php } ?>
				</div>	

				<div class="currency pull-left">
					<?php echo $currency; ?>
				</div> 
				<div class="language pull-left">
					<?php echo $language; ?>
				</div>
				<div class="show-mobile hidden-lg hidden-md pull-left">
					<div class="quick-access">
						<div class="quickaccess-toggle">
							<i class="fa fa-list"></i>															
						</div>	
						<div class="inner-toggle">
							<ul class="links pull-left">
								<li><a class="wishlist" href="<?php echo $wishlist; ?>" id="mobile-wishlist-total"><span class="fa fa-heart"></span><?php echo $text_wishlist; ?></a></li>
								<li><a class="account" href="<?php echo $account; ?>"><span class="fa fa-user"></span><?php echo $text_account; ?></a></li>
								<li><a class="shoppingcart" href="<?php echo $shopping_cart; ?>"><span class="fa fa-shopping-cart"></span><?php echo $text_shopping_cart; ?></a></li>
								<li><a class="last checkout" href="<?php echo $checkout; ?>"><span class="fa fa-file"></span><?php echo $text_checkout; ?></a></li> 
								
							</ul>
						</div>						
					</div>

				</div><!-- end mobile-->
			</div>
			<div class="col-lg-7 col-md-8">
				<?php echo $cart; ?>
				<ul class="links pull-right hidden-sm hidden-xs">
					<li>
						<a class="wishlist" href="<?php echo $wishlist; ?>" id="wishlist-total"><span class="fa fa-heart"></span>
						<?php echo $text_wishlist; ?></a>
					</li>
					<li>
						<a class="account" href="<?php echo $account; ?>"><span class="fa fa-user"></span><?php echo $text_account; ?></a>
					</li>
					<li>
						<a class="shoppingcart" href="<?php echo $shopping_cart; ?>"><span class="fa fa-shopping-cart"></span><?php echo $text_shopping_cart; ?></a>
					</li>
					<li>
						<a class="last checkout" href="<?php echo $checkout; ?>"><span class="fa fa-file"></span>
							<?php echo $text_checkout; ?>
						</a>
					</li> 
					
				</ul>
			</div>
					
	    </div><!-- end -->			
	</div><!-- end container -->
</nav>
<header id="header-main">
	<div class="container">
		<div class="header-wrap">
			<div class="pull-left inner">
				<?php if( $logoType=='logo-theme'){ ?>
					<div  id="logo-theme" class="logo-store">
						<a href="<?php echo $home; ?>">
							<span><?php echo $name; ?></span>
						</a>
					</div>
				<?php } elseif ($logo) { ?>
					<div id="logo" class="logo-store">
						<a href="<?php echo $home; ?>">
							<img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" />
						</a>
					</div>
				<?php } ?>
			</div>
			<!-- menu -->  
			<div id="pav-mainnav" class="pull-right inner">
					<div class="mainnav-wrap">
					<button data-toggle="offcanvas" class="btn button canvas-menu hidden-lg hidden-md" type="button"><span class="fa fa-bars"></span> Menu</button>
					<?php
					/**
					 * Main Menu modules: as default if do not put megamenu, the theme will use categories menu for main menu
					 */
					$modules = $helper->renderModule('pavmegamenu');

					if (count($modules) && !empty($modules)) { ?>

					    
					<?php echo $modules; ?>
					 

					<?php } elseif ($categories) { ?>

					    <div class="navbar navbar-inverse"> 
					        <nav id="mainmenutop" class="megamenu" role="navigation"> 
					            <div class="navbar-header">
					                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					                    <span class="sr-only">Toggle navigation</span>
					                    <span class="fa fa-bars"></span>
					                </button>
					            </div>

					            <div class="collapse navbar-collapse navbar-ex1-collapse">
					                <ul class="nav navbar-nav">
					                    
					                    <?php foreach ($categories as $category) { ?>

					                        <?php if ($category['children']) { ?>			
					                            <li class="parent dropdown deeper ">
					                                <a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?>
					                                    <b class="fa fa-angle-down"></b>
					                                    <span class="triangles"></span>
					                                </a>
					                            <?php } else { ?>
					                            <li>
					                                <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
					                            <?php } ?>
					                            <?php if ($category['children']) { ?>
					                                <ul class="dropdown-menu">
					                                    <?php for ($i = 0; $i < count($category['children']);) { ?>
					                                        <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
					                                        <?php for (; $i < $j; $i++) { ?>
					                                            <?php if (isset($category['children'][$i])) { ?>
					                                                <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
					                                            <?php } ?>
					                                        <?php } ?>
					                                    <?php } ?>
					                                </ul>
					                            <?php } ?>
					                        </li>
					                    <?php } ?>
					                </ul>
					            </div>	
					        </nav>
					    </div>   
					<?php } ?>
					</div>
					<div class="hidden-sm hidden-xs search" id="search" >
						<?php echo $search; ?>
					</div>
			</div>
		</div>
	</div> 
</header>






