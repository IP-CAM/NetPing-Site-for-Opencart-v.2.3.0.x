<div class="box">
	<h3 class="box-heading"><i class="fa fa-align-justify"></i><span><?php echo $heading_title; ?></span></h3>
	<div class="box-content-blog" id="pav-categorymenu" >

		 <?php echo $tree;?>
		 
	</div>
 </div>
<script>
$(document).ready(function(){
	$("#pav-categorymenu ul").addClass("list1");
		// applying the settings
		$("#pav-categorymenu li.active span.head").addClass("selected");
			$('#pav-categorymenu ul').Accordion({
				active: 'span.selected',
				header: 'span.head',
				alwaysOpen: false,
				animated: true,
				showSpeed: 400,
				hideSpeed: 800,
				event: 'click'
			});
});

</script>