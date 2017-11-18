<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-category" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <br>
            <ul id="mmos_short_d" class="nav nav-tabs">
                <li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
                <li><a href="#supporttabs" data-toggle="tab"><?php echo $tab_support; ?></a></li>
				<li id="mmos-offer"></li>
				<li class="pull-right"><a  class="link" href="http://www.opencart.com/index.php?route=extension/extension&filter_username=mmosolution" target="_blank" class="text-success"><img src="//mmosolution.com/image/opencart.gif"> More Extension...</a></li>
				<li class="pull-right"><a  class="text-link"  href="http://mmosolution.com" target="_blank" class="text-success"><img src="//mmosolution.com/image/mmosolution_20x20.gif">More Extension...</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-setting">
                    <div class="panel-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status"><?php echo $text_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="mmos_shortdescr[status]" id="input-status" class="form-control">
                                        <?php if ($mmos_shortdescr['status'] == '1') { ?>
                                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_enabled; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class=" table table-striped table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th><?php echo $entry_setting; ?></th>
                                        <th><?php echo $entry_value; ?></th>
                                    </tr>
                                </thead>
                                <?php $i=1; foreach($mmos_shortdescr_accept as $key => $value) { ?> 
                                <tr>
                                    <td class="col-sm-4"><?php echo $language_option[$key]; ?></td> 
                                    <td> <input type="<?php echo $value; ?>" class="form-control" name="mmos_shortdescr[<?php echo $key ; ?>]" <?php echo isset($mmos_shortdescr[$key]) ? 'value="'.$mmos_shortdescr[$key].'" checked' : ''; ?>></td> 
                                </tr>

                                <?php $i++; } ?>
                            </table>
                        </div>

                    </div>
                    </form>
                </div>
                <div class="tab-pane" id="supporttabs">
                    <div class="panel">
						<div class=" clearfix">
							<div class="panel-body">
								<h4> About <?php echo $heading_title; ?></h4>
								<h5>Installed Version: V.<?php echo $MMOS_version; ?> </h5>
								<h5>Latest version: <span id="mmos_latest_version"><a href="http://mmosolution.com/index.php?route=product/search&search=<?php echo trim(strip_tags($heading_title)); ?>" target="_blank">Unknown -- Check</a></span></h5>
								<hr>
								<h4>About Author</h4>
								<div id="contact-infor">
									<i class="fa fa-envelope-o"></i> <a href="mailto:support@mmosolution.com?Subject=<?php echo trim(strip_tags($heading_title)).' OC '.VERSION; ?>" target="_top">support@mmosolution.com</a></br>
									<i class="fa fa-globe"></i> <a href="http://mmosolution.com" target="_blank">http://mmosolution.com</a> </br>
									<i class="fa fa-ticket"></i> <a href="http://mmosolution.com/support/" target="_blank">Open Ticket</a> </br>
									<br>
									<h4>Our on Social</h4>
									<a href="http://www.facebook.com/mmosolution" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
									<a class="text-success" href="http://plus.google.com/+Mmosolution" target="_blank"><i class="fa  fa-2x fa-google-plus-square"></i></a>
									<a class="text-warning" href="http://mmosolution.com/mmosolution_rss.rss" target="_blank"><i class="fa fa-2x fa-rss-square"></i></a>
									<a href="http://twitter.com/mmosolution" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
									<a class="text-danger" href="http://www.youtube.com/mmosolution" target="_blank"><i class="fa fa-2x fa-youtube-square"></i></a>
								</div>
								<div id="relate-products">
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // input product model
        var productcode = '<?php echo $MMOS_code_id ;?>';

    </script>

    <script type="text/javascript" src="//mmosolution.com/support.js"></script>
    <?php echo $footer; ?>


