<?php 
	$span = 12/$cols; 
?>
<div class="box ">
	<div class="box-heading"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span><?php echo $heading_title; ?></span></div>
	<div class="box-content" >
		<?php if( !empty($blogs) ) { ?>
		<div class="pavblog-latest clearfix">
			<?php foreach( $blogs as $key => $blog ) { $key = $key + 1;?>
			<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> pavblock">
					<div class="blog-item">
					    <img src="<?php echo $blog['thumb'];?>" title="<?php echo $blog['title'];?>" alt="<?php echo $blog['title'];?>" style="text-align:left"/>
							<div class="blog-header clearfix">
								<span class="created"><span><?php echo $blog['created'];?></span></span><!--/-->
								<!--	<span class="comment_count"><span><?php echo $blog['comment_count'];?><?php echo $objlang->get("text_comment_count");?></span> --></span>
								<div class="blog-title blog-header-latest">
									<a href="<?php echo $blog['link'];?>" title="<?php echo $blog['title'];?>"><?php echo $blog['title'];?></a>
								</div>
							</div>
							<div class="blog-body">
								<?php if( $blog['thumb']  )  { ?>
								<a class="image hide" href="<?php echo $blog['link'];?>">
									<img src="<?php echo $blog['thumb'];?>" title="<?php echo $blog['title'];?>" alt=""/>
								</a>
								<?php } ?>
								<div class="description">
										<?php $blog['description'] = strip_tags($blog['description']); ?>
										<?php echo utf8_substr( $blog['description'],0, 140);?>...
								</div>
								<!--<a class="readmore btn-arrow-right" href="<?php echo $blog['link'];?>"><?php echo $objlang->get('text_readmore');?></a>-->
							    <a class="btn demo readmore-new" href="<?php echo $blog['link'];?>"><?php echo $objlang->get('text_readmore');?></a>
							</div>	
						</div>
			</div>
			<?php if( ( $key%$cols==0 || $key == count($blogs)) ){  ?>
				<div class="clearfix"></div>
			<?php } ?>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
 </div>
