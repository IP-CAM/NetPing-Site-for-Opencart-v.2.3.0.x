<?php if($head){ ?><h3><?php echo $head; ?></h3><?php } ?>
<div class="custom_menu <?php if($style){ echo 'custom_menu_style"'; } ?> list-group">
<?php foreach($custom_menu as $menu){ ?> 
<?php if (in_array($menu['id'], $in_module)) { ?>
	<div>
<?php if($menu['sub_menu']){ ?>
	<a href="<?php echo $menu['link'] ?>" class="list-group-item"><?php if($menu['image']) { ?><img src="<?php echo $menu['image']; ?>" alt="<?php echo $menu['name']; ?>" /><?php } else { ?><i class="fa fa-chevron-right"></i><?php } ?><span><?php echo $menu['name']; ?></span><i class="fa fa-chevron-down"></i></a>
<?php } else {?>
	<a href="<?php echo $menu['link'] ?>" class="list-group-item"><?php if($menu['image']) { ?><img src="<?php echo $menu['image']; ?>" alt="<?php echo $menu['name']; ?>" /><?php } else { ?><i class="fa fa-chevron-right"></i><?php } ?><span><?php echo $menu['name']; ?></span></a>
<?php }?>		
<?php if($menu['sub_menu']){ ?>
<?php for ($i = 0; $i < count($menu['sub_menu']);) { ?>	
<?php $j = $i + ceil(count($menu['sub_menu']) / $menu['column']); ?>
<div class="list-group">
<?php for (; $i < $j; $i++) { ?>
<?php if (isset($menu['sub_menu'][$i]) && in_array($menu['sub_menu'][$i]['id'], $in_module)) { ?>

<div>
<?php if($menu['sub_menu'][$i]['link'] != ''){?>					
<a class="list-group-item" href="<?php echo $menu['sub_menu'][$i]['link']; ?>"><?php if($menu['sub_menu'][$i]['image']) { ?><img src="<?php echo $menu['sub_menu'][$i]['image']; ?>" alt="<?php echo $menu['sub_menu'][$i]['name']; ?>" /><?php } ?><span><?php echo $menu['sub_menu'][$i]['name']; ?></span><?php if($menu['sub_menu'][$i]['sub_menu']) {?><i class="fa fa-chevron-down"></i><?php } ?></a>
<?php } else {?>
<b class="list-group-item"><?php if($menu['sub_menu'][$i]['image']) { ?><img src="<?php echo $menu['sub_menu'][$i]['image']; ?>" alt="<?php echo $menu['sub_menu'][$i]['name']; ?>" /><?php } ?><span><?php echo $menu['sub_menu'][$i]['name']; ?></span><?php if($menu['sub_menu'][$i]['sub_menu']) {?><i class="fa fa-chevron-down"></i><?php } ?></b>
<?php } ?>
<?php if($menu['sub_menu'][$i]['sub_menu']) {?>
<div class="list-group">
<?php for ($wi = 0; $wi < count($menu['sub_menu'][$i]['sub_menu']); $wi++) { ?>	
<?php if (in_array($menu['sub_menu'][$i]['sub_menu'][$wi]['id'], $in_module)) { ?>
<a class="list-group-item" href="<?php echo $menu['sub_menu'][$i]['sub_menu'][$wi]['link']; ?>"><?php echo $menu['sub_menu'][$i]['sub_menu'][$wi]['name']; ?></a>
<?php }?>
<?php }?>
</div>			
<?php }?>
</div>


<?php }?>
<?php }?>
</div>
<?php }?>
<?php } ?>
</div>	

			
<?php } ?>
<?php } ?>
<script>
	$(document).ready(function() {
		$('.list-group-item').hover(function(){
			$(this).parent().prev().addClass('active');
			$(this).parent().parent().prev().addClass('active');
			$(this).parent().parent().parent().prev().addClass('active');
		},function(){
			$(this).parent().prev().removeClass('active');
			$(this).parent().parent().prev().removeClass('active');
			$(this).parent().parent().parent().prev().removeClass('active');
		});
	});
</script>
</div>