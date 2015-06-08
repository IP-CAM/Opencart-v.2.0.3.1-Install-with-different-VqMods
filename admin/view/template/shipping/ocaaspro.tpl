<!doctype html> 
<?php echo $header; ?>

<?php if ($version < 200) { ?>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" media="screen">
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" media="screen">
	<?php if ($joomla < 300) { ?>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<?php } ?>
<?php } ?>

<style>
<?php if ($mijoshop || $aceshop) { ?>
	<?php if ($joomla >= 300) { ?>
		/* Joomla! v3.x */
		input[type="file"], input[type="image"], input[type="submit"], input[type="reset"], input[type="button"] {width: 100%; height: inherit; line-height: inherit;}
		input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {width: 100% !important; height: 30px !important; padding: 5px 5px !important;}
		select, textarea {width: 100% !important;}
		.navbar {min-height: 30px;}
		.navbar-inner {min-height: 0;}
		.navbar-inner .container-fluid {border: 0px; margin-bottom: 0px;}
		.btn-subhead {display: none !important;}
		div.modal {width: 680px; background-color: transparent; border: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; overflow: none;}
		.modal {display: none; overflow: hidden; position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 1050; -webkit-overflow-scrolling: touch; outline: 0;}
		#menu > ul li ul li ul {margin: -29px 0 0 147px !important;}
	<?php } else { ?>
		/* Joomla! v2.x */
		#toolbar-box {display: none !important;}
		#menu > ul li ul {overflow: visible !important;}
		#menu > ul li ul li ul {margin: -29px 0 0 151px !important;}
		h1 {padding-bottom: 0px !important;}
	<?php } ?>
<?php } else { ?>
	<?php if ($version < 200) { ?>
		/* OpenCart Menu */
		#menu > ul {margin-top: -2px;}
		#menu > ul li ul {overflow: visible !important;}
		<?php if ($version < 155) { ?>
			#menu > ul li ul a {height: 27px !important;}
			#menu > ul li ul ul {margin-left: 147px !important; margin-top: -29px !important;}
		<?php } else { ?>
			#menu > ul li ul ul {margin-left: 151px !important; margin-top: -29px !important;}
		<?php } ?>
	<?php } ?>
	.page-header {vertical-align: middle; margin: 15px 0; padding: 0; border-bottom: none;}
	.page-header h1 {font-family: 'Open Sans', sans-serif; font-weight: 400; font-size: 30px; color: #848484; display: inline-block; margin-bottom: 15px;}
	.breadcrumb {display: inline-block; background: none; margin: 0; padding: 0 10px;}
	.breadcrumb li a {color: #999999; font-size: 11px; padding: 0px; margin: 0px;}
	.breadcrumb li:last-child a {color: #1e91cf;}
	.breadcrumb li a:hover {text-decoration: none;}
	.breadcrumb li + li:before {content: "/"; font-family: FontAwesome; color: #BBBBBB; padding: 0 5px;}
<?php } ?>
	
	/* Panel */
	.panel-default > .panel-heading {background-color: #F7F7F7;	padding: 5px 15px;}
	.panel-default > .panel-heading .btn {font-size: 18px; background-color: #3299BB; color: #FFF; background: none; padding: 4px 8px; transform: rotate(45deg); -ms-transform: rotate(45deg); -webkit-transform: rotate(45deg);}
	.panel-default > .panel-heading .btn:hover {background-color: #424242;}
	.panel-title {padding: 5px 0; font-size: 20px; text-shadow: 1px 1px 0 #FFF;}
	.panel-title i {color: #3299BB;}
	.panel-title a {color: #3299BB;}
	.panel-body {padding: 10px;}
		
	/* Containers */
	body {color: #424242; font-size: 12px;}
	#general-settings {margin-bottom: 15px;}
	#top-controls {margin-bottom: 15px;}
	#tutorial {border: 1px solid #BCBCBC; margin-bottom: 15px; font-size: 20px;	font-weight: bold; text-align: center;}
	#bottom-controls {margin-bottom: 15px;}
	.col-md-3 {margin-top: 5px;}
	.scrollbox {border: 1px solid #BCBCBC; width: auto; height: 100px; text-align: left; overflow-y: scroll;}
	.scrollbox div {padding: 3px;}
	.input ul {list-style-type: none; padding-left: 0px; margin-left: 0px;}
	.rate-error {color: #a94442; font-weight: bold; padding: 5px; text-align: center;}
	.rate-error i {font-weight: normal !important;}
	.footer {font-size: 10px; font-weight: bold; background-color: #E9E9E9; border-top: 1px solid #BCBCBC; padding: 5px;}
	.optional {font-weight: normal; color: #3c763d;}
	
	/* Modals */
	.modal-content {border-radius: 0px;}
	.modal-header {background-color: #3299BB; color: #FFF; padding: 10px; border-bottom: 0px;}
	.modal-header .close {color: #FFF; vertical-align: middle; margin: 0px;	opacity: 1;	transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}
	.modal-header .close:hover {opacity: .5;}
	.modal-title {font-weight: bold;}
	.modal-body ol>li, .modal-body ul>li {margin-bottom: 10px;}
	.modal-body table {width: 100%;}
	.modal-body table td {border: 1px solid #BCBCBC; padding: 5px;}
	.modal-body table td:first-child {width: 33%;}
	.modal-footer {border-top: 1px solid #BCBCBC; margin-top: 0px;}
	
	/* General */
	a, a:visited {color: #3299BB; cursor: pointer;}
	a:hover, a:focus {color: #3299BB; text-decoration: underline;}
	.odd {background-color: #E9E9E9 !important;}
	label {font-weight: normal; margin: 0px;}
	.input-group .form-control {z-index: 0 !important;}
	input[type='text'] {padding: 5px 5px;}
	.no-padding {padding-left: 0px !important; padding-right: 0px !important; padding-top: 0px !important; padding-bottom: 0px !important; padding: 0px !important;}
	.no-margin {margin-left: 0px !important; margin-right: 0px !important; margin-top: 0px !important; margin-bottom: 0px !important; margin: 0px !important;}
	.form-control {height: 30px; padding: 5px 8px; font-size: 13px; line-height: 1.4; background-color: #fff; border: 1px solid #d9d9d9; border-top-color: silver; border-radius: 1px; -webkit-box-shadow: none; box-shadow: none; -webkit-transition: none; -o-transition: none; transition: none;}
  
	/* Rates */
	.rate {margin-bottom: 15px;}
	.rate-header {background-image: none; background-color: #3299BB; color: #FFF; padding: 6px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}
	.rate-header:hover {background-color: #424242;}
	.rate-header-nochange:hover {background-color: #3299BB !important;}
	.rate-header h2 {font-size: 16px; margin: 0px; cursor: pointer;}
	.rate-header h2 small {color: #FFF;}
	.rate-header img {height: 16px; vertical-align: middle;}
	.rate-header i {color: #FFF;}
	.rate-content {border: 1px solid #BCBCBC;}
	
	/* Fields */
	.entry {background-color: #E9E9E9; font-weight: bold; border-top: 1px solid #BCBCBC; border-bottom: 1px solid #BCBCBC;}
	.entry, .input {font-size: 12px; padding: 5px;}
	
	/* Buttons */
	.btn:hover, .btn:focus {color: #FFF;}
	.btn-oca, .btn-oca:visited {background-color: #3299BB; color: #FFF; border-radius: 0px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out; text-shadow: none !important;}
	.btn-oca:hover {background-color: #424242;}
	.btn-oca i {color: #FFF;}
	
	/*Load Screen*/
	.loading-small {vertical-align: middle; padding: 5px;}
	.loading {position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%;}
	.loading .background {background-color: #424242; opacity: 0.65; width: 100%; height: 100%;}
	.loading .foreground {position: fixed; top: 50%; left: 50%; background-color: #FFF; border: 1px solid #BCBCBC; padding: 25px; color: #424242; font-size: 16px; font-weight: bold; text-align: center;}
	
	/* Tables */
	.table {margin-bottom: 0px; font-size: 12px;}
	.table thead tr th, .table tbody tr td {border: 0px !important; padding: 2px; vertical-align: middle; text-align: center;}
	.table tbody tr td:first-child {text-align: left;}
</style>

<?php if (isset($column_left)) { echo $column_left; } ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $text_name; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div id="notification">
      <?php if ($success) { ?><div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
      <?php if ($error_warning) { ?><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
      <?php if ($demo) { ?><div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $text_demo; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-truck"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <div id="general-settings" class="container-fluid">
          <div class="row rate-header rate-header-nochange">
            <h2 class="pull-left"><i class="fa fa-cogs"></i> <?php echo $heading_system_settings; ?></h2>
            
          </div>
          <div class="row">
            <div class="col-md-3 text-center">
              <div class="entry"><?php echo $entry_status; ?></div>
              <div class="input">
                <select name="<?php echo $extension; ?>_status" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_status; ?>">
                  <?php if (${$extension . '_status'}) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="entry"><?php echo $entry_title; ?></div>
              <div class="input">
                <?php foreach ($languages as $language) { ?>
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
                    <input type="text" name="<?php echo $extension; ?>_title[<?php echo $language['code']; ?>]" value="<?php echo (isset(${$extension.'_title'}[$language['code']])) ? ${$extension.'_title'}[$language['code']] : ''; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_title; ?>" />
                  </div>
                <?php } ?>
              </div>
              <div class="entry"><?php echo $entry_sort_order; ?></div>
              <div class="input">
                <input type="text" name="<?php echo $extension; ?>_sort_order" class="form-control" value="<?php echo ${$extension . '_sort_order'}; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_sort_order; ?>" />
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="entry"><?php echo $entry_sort_quotes; ?></div>
              <div class="input">
                <select name="<?php echo $extension; ?>_sort_quotes" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_sort_quotes; ?>">
                  <?php foreach ($sort_quotes as $sort_quote) { ?>
                    <?php if ($sort_quote['id'] == ${$extension . '_sort_quotes'}) { ?>
                      <option value="<?php echo $sort_quote['id']; ?>" selected="selected"><?php echo $sort_quote['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $sort_quote['id']; ?>"><?php echo $sort_quote['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="entry"><?php echo $entry_title_display; ?></div>
              <div class="input">
                <select name="<?php echo $extension; ?>_title_display" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_title_display; ?>">
                  <?php foreach ($title_displays as $title_display) { ?>
                    <?php if ($title_display['id'] == ${$extension . '_title_display'}) { ?>
                      <option value="<?php echo $title_display['id']; ?>" selected="selected"><?php echo $title_display['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $title_display['id']; ?>"><?php echo $title_display['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="entry"><?php echo $entry_display_value; ?></div>
              <div class="input">
                <select name="<?php echo $extension; ?>_display_value" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_display_value; ?>">
                  <?php if (${$extension . '_display_value'}) { ?> 
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="entry"><?php echo $entry_debug; ?></div>
              <div class="input">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>
                        <select name="<?php echo $extension; ?>_debug" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_debug; ?>">
                          <?php if (${$extension . '_debug'}) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                          <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td style="width: 1%;"><a role="button" type="button" class="btn btn-oca" href="<?php echo $debug_download; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_download; ?>"><i class="fa fa-download"></i></a></td>
                      <td style="width: 1%;"><a role="button" type="button" class="btn btn-oca" onclick="clearDebug();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_clear; ?>"><i class="fa fa-eraser"></i></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="entry"><?php echo $entry_modals; ?></div>
              <div class="input text-left">
                <table class="table">
                  <tbody>
                    <tr>
                      <td style="text-align: left; vertical-align: top; width: 50%;">
                        <ul>
                          <li><a role="button" data-toggle="modal" data-target="#modalTutorial"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_tutorial_header; ?></a></li>
                          <li><a role="button" data-toggle="modal" data-target="#modalPostalCodeRanges"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_postalcode_header; ?></a></li>
                          <li><a role="button" data-toggle="modal" data-target="#modalCategorySettings"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_categories_header; ?></a></li>
                          <li><a role="button" data-toggle="modal" data-target="#modalMultiRate"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_multirate_header; ?></a></li>
                        </ul>
                      </td>
                      <td style="text-align: left; vertical-align: top; width: 50%;">
                        <ul>
                          <li><a role="button" data-toggle="modal" data-target="#modalRateSettings"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_ratesettings_header; ?></a></li>
                          <li><a role="button" data-toggle="modal" data-target="#modalRates"><i class="fa fa-info-circle fa-lg"></i> <?php echo $modal_rates_header; ?></a></li>
                          
                        <ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-3 text-center">
              <div class="entry"><?php echo $entry_system_tools; ?></div>
              <div class="input">
                <form action="<?php echo $rate_import; ?>" method="post" enctype="multipart/form-data" id="import" role="form" class="inline">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <input type="file" name="<?php echo $extension; ?>_import" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_system_tools; ?>" class="form-control" />
                        </td>
                        <td style="width: 1%;"><a role="button" class="btn btn-oca" onclick="$('#import').submit();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_import; ?>"><i class="fa fa-upload"></i></a></td>
                        <td style="width: 1%;"><a role="button" class="btn btn-oca" href="<?php echo $rate_export; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_export; ?>"><i class="fa fa-download"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php if ($rate_errors) { ?>
          <div class="container-fluid" id="oca-notes">
            <?php if ($rate_errors) { ?>
              <?php foreach ($rate_errors as $error) { ?>
                <p class="bg-danger"><?php echo $error; ?></p>
              <?php } ?>
            <?php } ?>
            <span class="pull-right"><a onclick="$('#oca-notes').hide();"><?php echo $button_hide; ?></a></span>
          </div>
        <?php } ?>
          
        <div class="container-fluid" id="top-controls" style="<?php if (!$rates) { ?> display: none;<?php } ?>">
          <div class="row text-right">
            <button type="button" class="btn btn-oca" onclick="addRate();"><?php echo $button_rate_add; ?></button>&nbsp;
            <button type="button" class="btn btn-oca" onclick="saveAllRates();"><?php echo $button_save_all; ?></button>
          </div>
        </div>
        
        <?php if ($rates) { ?>
          <?php foreach ($rates as $rate) { ?>
            <div id="rate<?php echo $rate['rate_id']; ?>" class="container-fluid rate">
              <div class="row rate-header">
                <h2 class="pull-left" onclick="loadRate(<?php echo $rate['rate_id']; ?>);"><?php echo $rate['description']; ?></h2> 
                <span class="pull-right">
                  <a onclick="loadRate(<?php echo $rate['rate_id']; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_edit; ?>"><i class="fa fa-edit fa-lg"></i></a>
                  &nbsp;&nbsp;
                  <a onclick="copyRate(<?php echo $rate['rate_id']; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_copy; ?>"><i class="fa fa-files-o fa-lg"></i></a>
                  &nbsp;&nbsp;
                  <a onclick="if (confirm('<?php echo $text_confirm_delete; ?>')) { deleteRate(<?php echo $rate['rate_id']; ?>) }" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_delete; ?>"><i class="fa fa-trash-o fa-lg"></i></a>
                </span>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>

        <?php } ?>
        <div id="oca-foot"></div>
        <div id="bottom-controls" class="container-fluid">
          <div class="row text-right">
            <?php if ($demo) { ?><a role="button" class="btn btn-oca" href="<?php echo $demo; ?>" target="_blank"><?php echo $button_demo; ?></a>&nbsp;<?php } ?>
            <button type="button" class="btn btn-oca" onclick="addRate();"><?php echo $button_rate_add; ?></button>&nbsp;
            <button type="button" class="btn btn-oca" onclick="saveAllRates();"><?php echo $button_save_all; ?></button>&nbsp;
            <button type="button" class="btn btn-oca" onclick="if (confirm('<?php echo $text_confirm_delete_all; ?>')) { deleteAllRates() }"><?php echo $button_delete; ?></button>&nbsp;
            <button type="button" class="btn btn-oca" onclick="exit();" id="button-exit"><?php echo $button_exit; ?></button>
          </div>
        </div>
        <p class="text-center"><?php echo $text_footer; ?></p>
      </div>
    </div>
  </div>
</div>

<!-- Loading / Saving Screens -->
<div id="load" class="loading" style="display:none">
	<div class="background"></div>
	<div class="foreground">
		<p><?php echo $text_loading; ?></p>
		<span><i class="fa fa-spinner fa-spin fa-3x"></i></span>
	</div>
</div>

<div id="save" class="loading" style="display:none">
	<div class="background"></div>
	<div class="foreground">
		<p><?php echo $text_saving; ?></p>
		<span><i class="fa fa-spinner fa-spin fa-3x"></i></span>
	</div>
</div>

<!-- Modals -->
<div class="modal fade" id="modalSupport" tabindex="-1" role="dialog" aria-labelledby="modalSupportLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalSupportLabel"><?php echo $modal_support_header; ?></h4>
			</div>
			<div class="modal-body" id="modalSupportBody">
				<?php echo $modal_support_body; ?>
				<form role="form" id="modalSupportForm">
					<input type="email" name="email" class="form-control" placeholder="<?php echo $modal_support_email; ?>"><br />
					<input type="text" name="order_id" class="form-control" placeholder="<?php echo $modal_support_order_id; ?>"><br />
					<textarea name="description" class="form-control" placeholder="<?php echo $modal_support_description; ?>" rows="6"></textarea><br />
					<span id="modalSupportMessage"></span>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" id="modalSupportSubmit"><?php echo $text_submit; ?></button>
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalFeedbackLabel"><?php echo $modal_feedback_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_feedback_body; ?>
				<p>
					<ul class="unstyled">
						<?php if ($href_oca) { ?><li><a href="<?php echo $href_oca; ?>" target="_blank">OpenCart Addons</a></li><?php } ?>
						<?php if ($href_oc) { ?><li><a href="<?php echo $href_oc; ?>" target="_blank">OpenCart</a></li><?php } ?>
						<?php if ($href_med) { ?><li><a href="<?php echo $href_med; ?>" target="_blank">Mijosoft Extension Directory</a></li><?php } ?>
					</ul>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTutorial" tabindex="-1" role="dialog" aria-labelledby="modalTutorialLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalTutorialLabel"><?php echo $modal_tutorial_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_tutorial_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalPostalCodeRanges" tabindex="-1" role="dialog" aria-labelledby="modalPostalCodeRangesLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalPostalCodeRangesLabel"><?php echo $modal_postalcode_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_postalcode_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalCategorySettings" tabindex="-1" role="dialog" aria-labelledby="modalCategorySettingsLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalCategorySettingsLabel"><?php echo $modal_categories_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_categories_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalMultiRate" tabindex="-1" role="dialog" aria-labelledby="modalMultiRateLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalMultiRateLabel"><?php echo $modal_multirate_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_multirate_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRateSettings" tabindex="-1" role="dialog" aria-labelledby="modalRateSettngsLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRateSettngsLabel"><?php echo $modal_ratesettings_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_ratesettings_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRates" tabindex="-1" role="dialog" aria-labelledby="modalRatesLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRatesLabel"><?php echo $modal_rates_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_rates_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $text_close; ?></button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript"><!--
	var openRates = [];
	<?php if (!$rates) { ?>var tutorial = true;<?php } else { ?>var tutorial = false;<?php } ?>
//--></script>

<script type="text/javascript"><!--
	function saveGeneralSettings() {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/saveGeneralSettings&token=<?php echo $token; ?>',
			data: $('#general-settings input[type=\'text\'], #general-settings input[type=\'hidden\'], #general-settings input[type=\'radio\']:checked, #general-settings input[type=\'checkbox\']:checked, #general-settings select, #general-settings textarea'),
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#save').show();
			},
			complete: function() {
				$('#save').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();
				
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function addRate() {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/addRate&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html = '<div id="rate'+ json['rate_id'] +'" class="container-fluid rate"> '+ json['html'] +'</div>';
					$('#oca-foot').before(html);
							
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
					
					$('#tutorial').remove();
					if (tutorial) {
						$('#modalTutorial').modal({show: true});
						tutorial = false;
					}
					
					$('#top-controls').show();
					
					openRates.push(json['rate_id']);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function deleteRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/deleteRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#rate'+ rate_id).remove();
					
					openRates.splice($.inArray(json['rate_id'], openRates), 1);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function deleteAllRates() {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/deleteAllRates&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					location.reload();
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function copyRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/copyRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html = '<div id="rate'+ json['rate_id'] +'" class="container-fluid rate">'+ json['html'] +'</div>';
					$('#oca-foot').before(html);
					
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
		
					openRates.push(json['rate_id']);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function saveRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/saveRate&token=<?php echo $token; ?>',
			data: $('#rate'+ rate_id +' input[type=\'text\'], #rate'+ rate_id +' input[type=\'hidden\'], #rate'+ rate_id +' input[type=\'radio\']:checked, #rate'+ rate_id +' input[type=\'checkbox\']:checked, #rate'+ rate_id +' select, #rate'+ rate_id +' textarea'),
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('.rate-error').hide();
				$('#save').show();
			},
			complete: function() {
				$('#save').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();
							
				if (json['error']) {
					$('#' + json['rate_id'] + '-error').show();
					$.each(json['error'], function(key, value){
						$('#' + json['rate_id'] + '-error-' + key).html(value);
						$('#' + json['rate_id'] + '-error-' + key).show();
					});						
				}
				
				if (json['success']) {
					html  =  '<div class="row rate-header">';
					html +=    '<h2 class="pull-left" onclick="loadRate('+ json['rate_id'] +');">'+ json['description'] +'</h2>';
					html +=    '<span class="pull-right">';
					html +=      '<a onclick="loadRate('+ json['rate_id'] +');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_edit; ?>"><i class="fa fa-edit fa-lg"></i></a> ';
					html +=      '&nbsp;&nbsp; ';
					html +=      '<a onclick="copyRate('+ json['rate_id'] +');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_copy; ?>"><i class="fa fa-files-o fa-lg"></i></a> ';
					html +=      '&nbsp;&nbsp; ';
					html +=      '<a onclick="if (confirm(\'<?php echo $text_confirm_delete; ?>\')) { deleteRate('+ json['rate_id'] +') }" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_delete; ?>"><i class="fa fa-trash-o fa-lg"></i></a>';
					html +=    '</span>';
					html +=  '</div>';
					
					$('#rate'+ rate_id).html(html);
					
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
					
					openRates.splice($.inArray(json['rate_id'], openRates), 1);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function saveAllRates() {
		$.each(openRates, function(key, value) {
			saveRate(value);
		});
	}
//--></script>

<script type="text/javascript"><!--
	function loadRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/loadRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.success, .warning, .attention, .error').remove();				
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html = json['html'];
					$('#rate'+ rate_id).html(html);
		
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
					
					openRates.push(rate_id);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function closeRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/closeRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.success, .warning, .attention, .error').remove();			
				$('.rate-error').hide();			
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html  =  '<div class="row rate-header">';
					html +=    '<h2 class="pull-left" onclick="loadRate('+ json['rate_id'] +');">'+ json['description'] +'</h2>';
					html +=    '<span class="pull-right">';
					html +=      '<a onclick="loadRate('+ json['rate_id'] +');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_edit; ?>"><i class="fa fa-edit fa-lg"></i></a> ';
					html +=      '&nbsp;&nbsp; ';
					html +=      '<a onclick="copyRate('+ json['rate_id'] +');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_copy; ?>"><i class="fa fa-files-o fa-lg"></i></a> ';
					html +=      '&nbsp;&nbsp; ';
					html +=      '<a onclick="if (confirm(\'<?php echo $text_confirm_delete; ?>\')) { deleteRate('+ json['rate_id'] +') }" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_delete; ?>"><i class="fa fa-trash-o fa-lg"></i></a>';
					html +=    '</span>';
					html +=  '</div>';
					
					$('#rate'+ rate_id).html(html);
					
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
					
					openRates.splice($.inArray(json['rate_id'], openRates), 1);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function clearDebug() {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/clearDebug&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#load').show();
			},
			complete: function() {
				$('#load').hide();
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function exit() {
		saveGeneralSettings();
		
		if (openRates.length) {
			if (confirm('<?php echo $text_confirm_exit; ?>')) {
				location = '<?php echo str_replace('&amp;', '&', $cancel); ?>';
			}
		} else {
			location = '<?php echo str_replace('&amp;', '&', $cancel); ?>';
		}
	}
//--></script>

<script type="text/javascript"><!--
	$('#general-settings input').change(function() {
		saveGeneralSettings();
	});
	
	$('#general-settings select').change(function() {
		saveGeneralSettings();
	});
	
	$('[data-toggle="modal"]').modal({show: false});
	
	var tooltip_status = true;
	
	$(document).ready(tooltips());
	
	function tooltips() {
		/* MijoShop & AceShop */
		<?php if (defined('JPATH_MIJOSHOP_ADMIN') || defined('JPATH_ACESHOP_ADMIN')) { ?>
			$('.hasTooltip').tooltip({"html": true,"container": "body"});
			$('[data-toggle="tooltip"]').tooltip({"html": true,"container": "body"});
			$('[rel="tooltip"]').tooltip({"html": true,"container": "body"});
		<?php } else { ?>
			$('[data-toggle="tooltip"]').tooltip(tooltip_status);
			$('[rel="tooltip"]').tooltip(tooltip_status);
		<?php } ?>
	}
	
	$("select.chzn-done").removeAttr("style", "").removeClass("chzn-done").addClass("form-control").data("chosen", null).next().remove();
//--></script>

<script type="text/javascript"><!--
	$('#modalSupportSubmit').bind('click', function() {
		$.ajax({
			url: 'index.php?route=<?php echo $extensionType; ?>/<?php echo $extension; ?>/submitSupportRequest&token=<?php echo $token; ?>',
			data: $('#modalSupportForm input[type=\'email\'], #modalSupportForm input[type=\'text\'], #modalSupportForm textarea'),
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#modalSupportSubmit').before('<i class="loading-small fa fa-spinner fa-spin fa-2x"></i>');
			},
			complete: function() {
				$('.loading-small').remove();
			},
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#modalSupportMessage').html('<span style="font-weight: bold; color: #a94442; width: 100%; text-align: center;">' + json['error'] + '</span>');						
				}
				
				if (json['success']) {
					$('#modalSupportBody').html('<span style="font-weight: bold; color: #3c763d; width: 100%; text-align: center;">' + json['success'] + '</span>');
					$('#modalSupportSubmit').hide();
				}
			}
		});	
	});
//--></script>

<?php if ($version < 200) { ?>
	<script type="text/javascript"><!--
		function image_upload(field, thumb) {
			$('#dialog').remove();
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
			$('#dialog').dialog({
				title: '<?php echo $text_image_manager; ?>',
				close: function (event, ui) {
					if ($('#' + field).attr('value')) {
						$.ajax({
							url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
							type: 'POST',
							data: 'image=' + encodeURIComponent($('#' + field).attr('value')),
							dataType: 'text',
							success: function(text) {
								$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" style="height: 100px;" />');
							}
						});
					}
				},	
				bgiframe: false,
				width: 800,
				height: 400,
				resizable: false,
				modal: false
			});
		};
	//--></script> 
<?php } ?>
<?php echo $footer; ?> 