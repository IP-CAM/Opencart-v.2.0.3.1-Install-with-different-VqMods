<!doctype html> 
<!--
//==================================================//
// Product:	Advanced Shipping PRO                   //
// Author: 	Joel Reeds                              //
// Company: OpenCart Addons                         //
// Website: http://www.opencartaddons.com           //
// Contact: http://www.opencartaddons.com/contact   //
//==================================================//
-->
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
		div.modal {/*width: 680px;*/ background-color: transparent; border: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; border-radius: 0px; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; overflow: none;}
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
<?php } ?>
	
  /* Containers */
	body {color: #424242; font-size: 12px;}
	#system-settings {margin-bottom: 15px; border-bottom: 1px solid #eee;}
	#tutorial {margin-bottom: 15px; font-size: 20px;	font-weight: bold; text-align: center;}
	#support-box {padding-top: 15px; border-top: 1px solid #eee;}
  .tab-content {margin-top: 10px; margin-bottom: 10px;}
	.scrollbox {border: 1px solid #BCBCBC; width: auto; height: 30px; max-height: 30px; text-align: left; overflow-y: scroll; background: #fff; -webkit-transition: 0.5s ease-out 1s; -moz-transition: 0.5s ease-out 1s; -o-transition: 0.5s ease-out 1s; transition: 0.5s ease-out 1s;}
  .scrollbox:hover {height: 100%; min-height: 30px; max-height: 300px; -webkit-transition: 0s ease-out; -moz-transition: 0.5s ease-out; -o-transition: 0.5s ease-out; transition: 0.5s ease-out;}
	.scrollbox div {padding: 5px;}
	.input ul {list-style-type: none; padding-left: 0px; margin-left: 0px;}
	.rate-error {color: #a94442; font-weight: bold; padding: 5px; text-align: center;}
	.rate-error i {font-weight: normal !important;}
	.footer {font-size: 10px; font-weight: bold; background-color: #E9E9E9; border-top: 1px solid #BCBCBC; padding: 5px;}
	.optional {font-weight: normal; color: #3c763d;}
  #tab-rates {margin-right: 10px;}
	
	/* Modals */
	.modal-content {border-radius: 0px;}
	.modal-header {background-color: #3299BB; color: #FFF; padding: 10px; border-bottom: 0px;}
	.modal-header .close {color: #FFF; vertical-align: middle; margin: 0px;	opacity: 1;	transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}
	.modal-header .close:hover {opacity: .5;}
	.modal-title {font-weight: bold; color:#fff;}
	.modal-body ol>li, .modal-body ul>li {margin-bottom: 10px;}
	.modal-body .table {width: 100%;}
	.modal-body .table td {/*border: 1px solid #BCBCBC;*/ padding: 5px;}
	.modal-body .table td:first-child {width: 33%;}
	.modal-footer {border-top: 1px solid #BCBCBC; margin-top: 0px;}
	
	/* General */
	a, a:visited {color: #3299BB; cursor: pointer;}
	a:hover, a:focus {color: #3299BB; text-decoration: underline;}
	.panel-title {font-size: 30px; color: #3299BB;}
  .panel-title > a {font-size: 16px;}
	.odd {background-color: #E9E9E9 !important;}
	label {font-weight: normal; margin: 0px;}
	.input-group .form-control {z-index: 0 !important;}
  .input-group {width: 100%;}
	input[type='text'] {padding: 5px 5px;}
  textarea.form-control {height: 150px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}
  /*textarea.form-control:hover, textarea.form-control:focus {height: 200px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}*/
	.no-padding {padding-left: 0px !important; padding-right: 0px !important; padding-top: 0px !important; padding-bottom: 0px !important; padding: 0px !important;}
	.no-margin {margin-left: 0px !important; margin-right: 0px !important; margin-top: 0px !important; margin-bottom: 0px !important; margin: 0px !important;}
	.form-control {height: 30px; padding: 5px 8px; font-size: 13px; line-height: 1.4; background-color: #fff; border: 1px solid #d9d9d9; border-top-color: silver; border-radius: 1px; -webkit-box-shadow: none; box-shadow: none; -webkit-transition: none; -o-transition: none; transition: none;}
	.error {color: #f56b6b;}
	.alert-info {padding: 10px !important; margin: 10px !important;}
	h3 {font-size: 16px; margin-top: 0px; margin-bottom: 10px; color: #3299BB;}
	h4 {font-size: 14px; margin-bottom: 10px; color: #3299BB;}
	h5 {font-size: 12px; margin-bottom: 10px; color: #3299BB;}
  .form-group + .form-group {border-top: 0;}
  .tooltip-inner {width: 100%; min-width: 150px; max-width: 200px !important;}
  .input-group-addon {padding: 0px 5px;}
  .table thead td span[data-toggle="tooltip"]:after, label.control-label span:after {content: "";}
  
	/* Rates */
	.rate {margin-bottom: 15px;}
	.rate-header {background-image: none; background-color: #3299BB; color: #FFF; border-radius: 4px; padding: 10px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}
	.rate-header:hover {background-color: #424242;}
	.rate-header-nochange:hover {background-color: #3299BB !important;}
	.rate-header h2 {font-size: 16px; margin: 0px; cursor: pointer;}
	.rate-header h2 small {color: #FFF;}
	.rate-header img {height: 16px; vertical-align: middle;}
	.rate-header i {color: #FFF;}
	.rate-header .pull-right {margin-right: 10px;}
	.rate-content {border: 1px solid #BCBCBC;}
  .rate-column {padding-left: 0; padding-right: 0;}
  @media (min-width: 992px) { 
    .rate-column {display: table-cell; float: none; border-right: 1px solid #bcbcbc;}
    .rate-column:last-child {border-right: 0;}
  }
  .requirements tbody tr td {vertical-align: top !important;}
  .requirements tbody tr td:last-child {text-align: right !important;}
	
	/* Fields */
	.entry {background-color: #E9E9E9; font-weight: bold; /*border-top: 1px solid #BCBCBC; border-bottom: 1px solid #BCBCBC;*/}
	.entry, .input {font-size: 12px; padding: 5px;}
	
	/* Buttons */
	.btn:hover, .btn:focus {color: #FFF;}
	.btn-oca, .btn-oca:visited {background-color: #3299BB; color: #FFF; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out; text-shadow: none !important;}
	.btn-oca:hover {background-color: #424242;}
	.btn-oca i {color: #FFF;}
	
	/*Load Screen*/
	.loading-small {vertical-align: middle; padding: 5px;}
	.loading {position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%;}
	.loading .background {background-color: #424242; opacity: 0.65; width: 100%; height: 100%;}
	.loading .foreground {position: fixed; top: 50%; left: 50%; background-color: #FFF; border: 1px solid #BCBCBC; padding: 25px; color: #424242; font-size: 16px; font-weight: bold; text-align: center;}
	
	/* Tables */
	.rate-content .table {margin-bottom: 0px; font-size: 12px;}
	.rate-content .table thead tr th, .rate-content .table tbody tr td {border: 0px !important; text-align: center;}
	.rate-content .table tbody tr td:first-child {text-align: left; width: 33%;}
  .table tbody > tr > td {vertical-align: middle;}
  .table tbody > tr > td .col-sm-4 {padding-left: 5px; padding-right: 5px;}
  
	#tab-rates-controls {position: fixed; top: 50%; right: 0px; z-index: 999; background-color: #E9E9E9; border: 1px solid #BCBCBC; padding: 5px; -webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}
	#tab-rates-controls a {display: block; margin-bottom: 5px !important;}
	#tab-rates-controls a:last-of-type {display: block; margin-bottom: 0px;}
	#tab-rates-controls a span {display: none;}
	#tab-rates-controls:hover span {display: inline-block; padding-right: 7px; transition: 0.3s ease-in-out; -moz-transition: 0.3s ease-in-out; -webkit-transition: 0.3s ease-in-out;}

	.information {margin-bottom: 15px; border-bottom: 1px solid #eee;}
</style>

<?php if (isset($column_left)) { echo $column_left; } ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1 class="panel-title"><?php echo $text_name; ?><?php if ($demo) { ?><a href="<?php echo $demo; ?>" target="_blank" class="pull-right"><?php echo $button_demo; ?></a><?php } ?></h1>
    </div>
  </div>
  <div class="container-fluid">
    <div id="notification">
      <?php if ($success) { ?><div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
      <?php if ($error_warning) { ?><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
      <?php if ($demo) { ?><div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $text_demo; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
    </div>
    
    <div id="system-settings" class="row form-horizontal">
      <div class="col-lg-4">
        <?php echo $help_general; ?>
        <div class="col-sm-12 alert-info"><?php if ($ocapps_status) { echo $text_ocapps_true; } else { echo $text_ocapps_false; } ?></div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="system-status" class="col-sm-4 control-label"><?php echo $entry_status; ?></label>
          <div class="col-sm-8">
            <select name="<?php echo $extension; ?>_status" id="system-status" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_status; ?>">
              <?php if (${$extension . '_status'}) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="system-title" class="col-sm-4 control-label"><?php echo $entry_title; ?></label>
          <div class="col-sm-8">
            <?php foreach ($languages as $language) { ?>
              <div class="input-group">
                <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
                <input type="text" name="<?php echo $extension; ?>_title[<?php echo $language['code']; ?>]" value="<?php echo (isset(${$extension.'_title'}[$language['code']])) ? ${$extension.'_title'}[$language['code']] : ''; ?>" id="system-title" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_title; ?>" />
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group">
          <label for="system-sort-order" class="col-sm-4 control-label"><?php echo $entry_sort_order; ?></label>
          <div class="col-sm-8">
            <input type="text" name="<?php echo $extension; ?>_sort_order" id="system-sort-order" class="form-control save" value="<?php echo ${$extension . '_sort_order'}; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_sort_order; ?>" />
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <?php if ($ocapps_status) { ?>
          <div class="form-group">
            <label for="ocapps-status" class="col-sm-4 control-label"><?php echo $entry_ocapps_status; ?></label>
            <div class="col-sm-8">
              <select name="<?php echo $extension; ?>_ocapps_status" id="ocapps-status" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_ocapps_status; ?>">
                <?php if (${$extension . '_ocapps_status'}) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        <?php } else { ?>
          <input type="hidden" name="<?php echo $extension; ?>_ocapps_status" value="0" />
        <?php } ?>
        <div class="form-group">
          <label for="system-sort-quotes" class="col-sm-4 control-label"><?php echo $entry_sort_quotes; ?></label>
          <div class="col-sm-8">
            <select name="<?php echo $extension; ?>_sort_quotes" id="system-sort-quotes" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_sort_quotes; ?>">
              <?php foreach ($sort_quote as $param) { ?>
                <?php if ($param['id'] == ${$extension . '_sort_quotes'}) { ?>
                  <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="system-title-display" class="col-sm-4 control-label"><?php echo $entry_title_display; ?></label>
          <div class="col-sm-8">
            <select name="<?php echo $extension; ?>_title_display" id="system-title-display" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_title_display; ?>">
              <?php foreach ($title_display as $param) { ?>
                <?php if ($param['id'] == ${$extension . '_title_display'}) { ?>
                  <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                <?php } else { ?>
                  <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="system-display-value" class="col-sm-4 control-label"><?php echo $entry_display_value; ?></label>
          <div class="col-sm-8">
            <select name="<?php echo $extension; ?>_display_value" id="system-display-value" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_display_value; ?>">
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
      </div>
    </div>
    
    <ul class="nav nav-tabs container-fluid">
      <li class="active"><a href="#tab-rates" data-toggle="tab" onclick="showRatesControls();"><?php echo $tab_rate; ?></a></li>
      <li><a href="#tab-combinations" data-toggle="tab" onclick="hideRatesControls();"><?php echo $tab_combination; ?></a></li>
      <li><a href="#tab-tutorials" data-toggle="tab" onclick="hideRatesControls();"><?php echo $tab_tutorial; ?></a></li>
      <li><a href="#tab-support" data-toggle="tab" onclick="hideRatesControls();"><?php echo $tab_support; ?></a></li>
      <li><a href="#tab-debug" data-toggle="tab" onclick="hideRatesControls();"><?php echo $tab_debug; ?></a></li>
      <span class="pull-right">
        <button id="tooltip" class="btn btn-default"><span class="fa <?php if (${$extension . '_tooltip'}) { ?>fa-check text-success<?php } else { ?>fa-times text-danger<?php } ?>"></span> <?php echo $button_tooltip; ?></button>
        <input type="hidden" name="<?php echo $extension; ?>_tooltip" value="<?php echo ${$extension . '_tooltip'}; ?>" class="save" />
      </span>
    </ul>
    
    <div class="tab-content container-fluid">      
      <div id="tab-rates" class="tab-pane container-fluid active">
        <?php if ($rates) { ?>
          <?php foreach ($rates as $rate) { ?>
            <div id="rate<?php echo $rate['rate_id']; ?>" class="rate">
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
          <div id="tutorial" class="row">
            <a href="http://www.opencartaddons.com" target="_blank" title="OpenCart Addons"><img src="https://opencartaddons.com/image/extension/<?php echo $img_logo; ?>" alt="OpenCart Addons"></a>
            <p><?php echo $text_welcome; ?></p>
          </div>
        <?php } ?>
        <div id="oca-foot" class="row"></div>
      </div>
      
      <div id="tab-combinations" class="tab-pane container-fluid">
        <div class="row">
          <div class="col-sm-6"><?php echo $help_combinations; ?></div>
          <div class="col-sm-6">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-left"><?php echo $column_rate_group; ?></th>
                  <th class="text-left"><?php echo $column_calculation_method; ?></th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php $combination_row = 1; ?>
                <?php if ($combinations) { ?>
                  <?php foreach ($combinations as $combination) { ?>
                    <tr id="combination-<?php echo $combination_row; ?>">
                      <td><input type="text" name="<?php echo $extension; ?>_combinations[<?php echo $combination_row; ?>][rate_group]" class="form-control save" value="<?php echo $combination['rate_group']; ?>" /></td>
                      <td>
                        <select name="<?php echo $extension; ?>_combinations[<?php echo $combination_row; ?>][calculation_method]" class="form-control save">
                          <?php foreach ($calculation_method as $param) { ?>
                            <?php if ($param['id'] == $combination['calculation_method']) { ?>
                              <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </td>
                      <td style="text-align: right !important;"><button type="button" class="btn btn-danger" onclick="$('#combination-<?php echo $combination_row; ?>').remove(); autosave();" data-toggle="tooltip" data-placement="left" title="<?php //echo $button_combine_delete; ?>"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $combination_row++; ?>
                  <?php } ?>
                <?php } ?>
                <tr id="combination-footer">
                  <td colspan="3" style="text-align: right !important;"><button type="button" class="btn btn-oca" onclick="addCombination();" data-toggle="tooltip" data-placement="left" title="<?php //echo $button_combine_add; ?>"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="tab-tutorials" class="tab-pane container-fluid">
        <div class="row">
          <div class="col-sm-5">
            <h3><?php echo $modal_tutorial_header; ?></h3>
            <p><?php echo $modal_tutorial_body; ?></p>
            <h3><?php echo $modal_rate_type_header; ?></h3>
            <p><?php echo $modal_rate_type_body; ?></p>
            <h3><?php echo $modal_shipping_factor_header; ?></h3>
            <p><?php echo $modal_shipping_factor_body; ?></p>
            <h3><?php echo $modal_rates_header; ?></h3>
            <p><?php echo $modal_rates_body; ?></p>
          </div>
          <div class="col-sm-2">&nbsp;</div>
          <div class="col-sm-5">
            <h3><?php echo $modal_requirements_header; ?></h3>
            <p><?php echo $modal_requirements_body; ?></p>
            <h3><?php echo $modal_requirement_match_header; ?></h3>
            <p><?php echo $modal_requirement_match_body; ?></p>
            <h3><?php echo $modal_requirement_cost_header; ?></h3>
            <p><?php echo $modal_requirement_cost_body; ?></p>
            <h3><?php echo $modal_cart_requirements_header; ?></h3>
            <p><?php echo $modal_cart_requirements_body; ?></p>
            <h3><?php echo $modal_product_requirements_header; ?></h3>
            <p><?php echo $modal_product_requirements_body; ?></p>
            <h3><?php echo $modal_customer_requirements_header; ?></h3>
            <p><?php echo $modal_customer_requirements_body; ?></p>
            <h3><?php echo $modal_postalcode_header; ?></h3>
            <p><?php echo $modal_postalcode_body; ?></p>
            <h3><?php echo $modal_other_requirements_header; ?></h3>
            <p><?php echo $modal_other_requirements_body; ?></p>
          </div>
        </div>
      </div>
      
      <div id="tab-support" class="tab-pane container-fluid">
        <div class="row">
          <div class="col-sm-4"><?php echo $help_import; ?></div>
          <div class="col-sm-8">
            <form role="form" action="<?php echo $rate_import; ?>" method="post" enctype="multipart/form-data" id="import" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo $entry_import; ?></label>
                <div class="col-sm-6">
                  <input type="file" name="<?php echo $extension; ?>_import" class="form-control" />
                </div>
                <div class="col-sm-2 text-right">
                  <a role="button" class="btn btn-oca" onclick="$('#import').submit();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_import; ?>"><i class="fa fa-upload"></i></a>
                  <a role="button" class="btn btn-oca" href="<?php echo $rate_export; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_export; ?>"><i class="fa fa-download"></i></a>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row" id="support-box">
          <div class="col-sm-4">
            <?php echo $help_support; ?>
            <button type="button" class="btn btn-oca" data-toggle="modal" data-target="#modalFeedback"><?php echo $button_feedback; ?> <i class="fa fa-thumbs-up"></i></button>
            <a role="button" class="btn btn-oca" href="<?php echo $href_twitter; ?>" target="_blank"><?php echo $button_twitter; ?> <i class="fa fa-twitter"></i></a>
            <a role="button" class="btn btn-oca" href="<?php echo $href_facebook; ?>" target="_blank"><?php echo $button_facebook; ?> <i class="fa fa-facebook"></i></a>
          </div>
          <div class="col-sm-8" id="support">
            <form role="form" id="supportForm" class="form-horizontal">
              <div class="form-group">
                <label for="email" class="col-sm-4 control-label"><?php echo $entry_email; ?></label>
                <div class="col-sm-8">
                  <input type="email" name="email" id="email" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="order-id" class="col-sm-4 control-label"><?php echo $entry_order_id; ?></label>
                <div class="col-sm-8">
                  <input type="text" name="order_id" id="order-id" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="enquiry" class="col-sm-4 control-label"><?php echo $entry_enquiry; ?></label>
                <div class="col-sm-8">
                  <textarea name="enquiry" id="enquiry" class="form-control" style="height: 150px;"></textarea>
                </div>
              </div>
              <div class="col-sm-12 text-right">
                <button type="button" class="btn btn-oca" id="supportSubmit"><?php echo $button_submit; ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div id="tab-debug" class="tab-pane container-fluid">
       <div class="row form-horizontal">
          <div class="col-sm-4"><?php echo $help_debug; ?></div>
          <label for="debug" class="col-sm-2 control-label"><?php echo $entry_debug; ?></label>
          <div class="col-sm-4">
            <select name="<?php echo $extension; ?>_debug" id="debug" class="form-control save">
              <?php if (${$extension . '_debug'}) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-2">
            <div class="text-right">
              <a role="button" type="button" class="btn btn-oca" onclick="reloadDebug();" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_debug_reload; ?>"><i class="fa fa-refresh"></i></a>
              <a role="button" type="button" class="btn btn-oca" href="<?php echo $debug_download; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_debug_download; ?>"><i class="fa fa-download"></i></a>
              <a role="button" type="button" class="btn btn-danger" onclick="clearDebug();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_debug_clear; ?>"><i class="fa fa-eraser"></i></a>
            </div>
          </div>
          <div class="col-sm-12">
            <textarea wrap="off" readonly="readonly" id="debug-log" class="form-control" style="height: 350px;"><?php echo $debug_log; ?></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid text-center"><?php echo $text_footer; ?></div>
  </div>
</div>

<!-- Tab Controls - Rates -->
<div id="tab-rates-controls">
  <a href="http://www.opencartaddons.com" target="_blank" class="text-center"><img src="https://opencartaddons.com/image/extension/<?php echo $icon_logo; ?>" alt="OpenCart Addons" title="OpenCart Addons" />&nbsp;<span><img src="https://opencartaddons.com/image/extension/<?php echo $icon_name; ?>" alt="OpenCart Addons" title="OpenCart Addons" /></span></a>
  <a role="button" class="btn btn-oca" onclick="addRate();"><span><?php echo $button_rate_add; ?></span><i class="fa fa-plus-circle fa-lg"></i></a>
  <a role="button" class="btn btn-oca hidden-controls" onclick="saveAllRates();"><span><?php echo $button_save_all; ?></span><i class="fa fa-floppy-o fa-lg"></i></a>
  <a role="button" class="btn btn-oca hidden-controls" onclick="if (confirm('<?php echo $text_confirm_delete_all; ?>')) { deleteAllRates() }"><span><?php echo $button_delete; ?></span><i class="fa fa-trash-o fa-lg"></i></a>
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
<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
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
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTutorial" tabindex="-1" role="dialog" aria-labelledby="modalTutorialLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalTutorialLabel"><?php echo $modal_tutorial_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_tutorial_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRateType" tabindex="-1" role="dialog" aria-labelledby="modalRateTypeLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRateTypeLabel"><?php echo $modal_rate_type_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_rate_type_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalShippingFactor" tabindex="-1" role="dialog" aria-labelledby="modalShippingFactorLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalShippingFactorLabel"><?php echo $modal_shipping_factor_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_shipping_factor_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalFinalCost" tabindex="-1" role="dialog" aria-labelledby="modalFinalCostLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalFinalCostLabel"><?php echo $modal_final_cost_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_final_cost_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRates" tabindex="-1" role="dialog" aria-labelledby="modalRatesLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRatesLabel"><?php echo $modal_rates_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_rates_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRequirements" tabindex="-1" role="dialog" aria-labelledby="modalRequirementsLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRequirementsLabel"><?php echo $modal_requirements_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_requirements_body; ?>
				<h3><?php echo $modal_cart_requirements_header; ?></h3>
				<?php echo $modal_cart_requirements_body; ?>
        <h3><?php echo $modal_product_requirements_header; ?></h3>
				<?php echo $modal_product_requirements_body; ?>
        <h3><?php echo $modal_customer_requirements_header; ?></h3>
				<?php echo $modal_customer_requirements_body; ?>
        <h4><?php echo $modal_postalcode_header; ?></h4>
				<?php echo $modal_postalcode_body; ?>
        <h3><?php echo $modal_other_requirements_header; ?></h3>
				<?php echo $modal_other_requirements_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRequirementMatch" tabindex="-1" role="dialog" aria-labelledby="modalRequirementMatchLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRequirementMatchLabel"><?php echo $modal_requirement_match_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_requirement_match_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalRequirementCost" tabindex="-1" role="dialog" aria-labelledby="modalRequirementCostLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="modalRequirementCostLabel"><?php echo $modal_requirement_cost_header; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo $modal_requirement_cost_body; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-oca" data-dismiss="modal"><?php echo $button_close; ?></button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript"><!--
	var openRates = [];
	<?php if (!$rates) { ?>var tutorial = true;<?php } else { ?>var tutorial = false;<?php } ?>
//--></script>

<script type="text/javascript"><!--
	function autosave(field_name) {
    var field_array = 'input[name=\''+ field_name +'\'], select[name=\''+ field_name +'\'], textarea[name=\''+ field_name +'\']';
    
    $.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/save&token=<?php echo $token; ?>',
			data: $('.save'),
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$(field_array).parent().removeClass('has-error');
				$(field_array).parent().addClass('has-warning');
			},
			complete: function() {
				$(field_array).parent().removeClass('has-warning');
			},	
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();
				
				if (json['error']) {
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
          $(field_array).parent().addClass('has-error');
        } else {
          $(field_array).parent().addClass('has-success');
          setTimeout(function() { $(field_array).parent().removeClass('has-success'); }, 3000);
        }
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	var combination_row = <?php echo $combination_row; ?>;
  function addCombination() {
		html  = '<tr id="combination-'+ combination_row +'">';
    html += ' <td><input type="text" name="<?php echo $extension; ?>_combinations['+ combination_row +'][rate_group]" class="form-control save" value="" data-toggle="tooltip" data-placement="bottom" title="<?php //echo $tooltip_combination_rate_group; ?>" /></td>';
    html += ' <td><select name="<?php echo $extension; ?>_combinations['+ combination_row +'][calculation_method]" class="form-control save" data-toggle="tooltip" data-placement="bottom" title="<?php //echo $tooltip_combination_calculation_method; ?>">';
                <?php foreach ($calculation_method as $param) { ?>
    html += '     <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>';
                <?php } ?>
    html += ' </select></td>';
    html += ' <td style="text-align: right !important;"><a class="btn btn-danger" onclick="$(\'#combination-'+ combination_row +'\').remove(); autosave();"><i class="fa fa-minus-circle"></i></a></td>';
    html += '</tr>';
    
    $('#combination-footer').before(html);
    
    combination_row++;
    
    autosave();
    
    $("select.chzn-done").removeAttr("style", "").removeClass("chzn-done").addClass("form-control save").data("chosen", null).next().remove();
    $('.save').change(function() { autosave($(this).attr('name')); });
    tooltips();
	}
//--></script>

<script type="text/javascript"><!--
	function addRate() {
		$.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/addRate&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html = '<div id="rate'+ json['rate_id'] +'" class="rate"> '+ json['html'] +'</div>';
					$('#oca-foot').before(html);
							
					tooltips();
					$('[data-toggle="modal"]').modal({show: false});
					
					$('#tutorial').remove();
					if (tutorial) {
						$('#modalTutorial').modal({show: true});
						tutorial = false;
					}
					
					openRates.push(json['rate_id']);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function deleteRate(rate_id) {
		$.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/deleteRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/deleteAllRates&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/copyRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					html = '<div id="rate'+ json['rate_id'] +'" class="rate">'+ json['html'] +'</div>';
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
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/saveRate&token=<?php echo $token; ?>',
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
					$('#'+ json['rate_id'] +'-error').show();
					$.each(json['error'], function(key, value){
						if (key.indexOf('requirement') > -1) {
              $('#error-'+ key.replace('_', '-')).html(value);
              $('#error-'+ key.replace('_', '-')).show();
            } else {
              $('#'+ json['rate_id'] +'-error-'+ key.replace('_', '-')).html(value);
              $('#'+ json['rate_id'] +'-error-'+ key.replace('_', '-')).show();
            }
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
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/loadRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/closeRate&rate_id='+ rate_id +'&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
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

<script type="text/javascript"><!--//
  function addRequirement(rate_id) {
    var key = new Date().getTime().toString(16);
    html  = '<tr>';
    html += '<td id="requirements-'+ key +'-type"><select name="requirements['+ key +'][type]" class="form-control" onchange="getRequirement(\''+ key +'\');">';
    <?php foreach ($requirement_types as $group => $requirement_types) { ?>
      <?php if (!empty($requirement_types)) { ?>
        html += '<optgroup label="<?php echo ${'text_requirement_group_' . $group}; ?>">';
        <?php foreach ($requirement_types as $requirement_type) { ?>
          html += '<option value="<?php echo $requirement_type['id']; ?>"><?php echo $requirement_type['name']; ?></option>';
        <?php } ?>
        html += '</optgroup>';
      <?php } ?>
    <?php } ?>
    html += '</select></td>';
    html += '<td id="requirements-'+ key +'-operation"><select name="requirements['+ key +'][operation]" onchange="checkParameter(\''+ key +'\');" class="form-control"><option value=""></option></select></td>';
    html += '<td id="requirements-'+ key +'-value"><input type="hidden" name="requirements['+ key +'][value]" value="" /><input type="hidden" name="requirements['+ key +'][parameters]" value="" /></td>';
    html += '<td><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    
    $('#'+ rate_id +'-requirement-footer').before(html);
    
    getRequirement(key);
  }
//--></script>

<script type="text/javascript"><!--//
  function getRequirement(key) {
    var type = $('select[name=\'requirements['+ key +'][type]\'').val();
    
    $.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/requirement&type='+ type +'&key='+ key +'&token=<?php echo $token; ?>',
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {},
			complete: function() {},	
			success: function(json) {
				$('.success, .warning, .attention, .error').remove();			
				$('.rate-error').hide();			
							
				if (json['success']) {
          var previous_operation  = $('select[name=\'requirements['+ key +'][operation]\'').val();
          //var previous_value      = ($('select[name=\'requirements['+ key +'][value]\'').val() ? $('select[name=\'requirements['+ key +'][value]\'').val() : $('input[name=\'requirements['+ key +'][value]\'').val());
          var previous_value = '';
          
          $('select[name=\'requirements['+ key +'][operation]\'').empty();
          $.each(json['operations'], function(id, name) {
            if (previous_operation == id) {
              $('select[name=\'requirements['+ key +'][operation]\'').append('<option value="'+ id +'" selected="selected">'+ name +'</option>');
            } else {
              $('select[name=\'requirements['+ key +'][operation]\'').append('<option value="'+ id +'">'+ name +'</option>');
            }
          });
          $('select[name=\'requirements['+ key +'][operation]\'').focus();
          
          html = '';
          if (json['values']) {
            if (type == 'product_category') {
              html += '<div class="scrollbox"';
              if (json['value_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['value_tooltip'] +'"'; }
              html += '>';
              var div_class = 'odd';
              $.each(json['values'], function(id, name) {
                div_class = (div_class == 'even') ? 'odd' : 'even';
                html += '<div class="'+ div_class +'"><input type="checkbox" name="requirements['+ key +'][value][]" id="requirement-'+ key +'-'+ id.trim() +'" value="'+ id.trim() +'"><label for="requirement-'+ key +'-'+ id.trim() +'">'+ name +'</label></div>';
              });
              html += '</div>';
            } else {
              html += '<select name="requirements['+ key +'][value]" class="form-control"';
              if (json['value_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['value_tooltip'] +'"'; }
              html += '>';
              $.each(json['values'], function(id, name) {
                if (previous_value == id.trim()) {
                  html += '<option value="'+ id.trim() +'" selected="selected">'+ name +'</option>';
                } else {
                  html += '<option value="'+ id.trim() +'">'+ name +'</option>';
                }
              });
              html += '</select>';
            }
          } else if (type == 'date') {
            html += '<input type="text" name="requirements['+ key +'][value]" class="form-control date" value="'+ previous_value +'"';
            if (json['value_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['value_tooltip'] +'"'; }
            html += '/>';  
          } else if (type == 'time') {
            html += '<input type="text" name="requirements['+ key +'][value]" class="form-control time" value="'+ previous_value +'"';
            if (json['value_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['value_tooltip'] +'"'; }
            html += '/>';  
          } else {
            html += '<input type="text" name="requirements['+ key +'][value]" class="form-control" value="'+ previous_value +'"';
            if (json['value_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['value_tooltip'] +'"'; }
            html += '/>';
          }
          
          html += '<span id="error-requirement-'+ key +'" class="rate-error" style="display: none;"></span>';
          
          if (json['parameters']) {
            $.each(json['parameters'], function(index, parameter) {
              html += '<select name="requirements['+ key +'][parameter]['+ index +']" id="requirements-'+ key +'-parameter" class="form-control"';
              if (json['parameter_tooltip']) { html += ' data-toggle="tooltip" data-placement="top" title="'+ json['parameter_tooltip'] +'"'; }
              html += '>';
              $.each(parameter, function(id, name) {
                html += '<option value="'+ id +'">'+ name +'</option>';
              });
              html += '</select>';
            });
          } else {
            html += '<input type="hidden" name="requirements['+ key +'][parameter]" class="form-control" value="" />';
          }
          
          $('#requirements-'+ key +'-value').html(html);
          
          $('.date').datetimepicker({format: 'Y-m-d', timepicker: false, allowBlank: true, scrollInput: false});
          $('.time').datetimepicker({format: 'H:i', datepicker: false, allowBlank: true, scrollInput: false});
          
          tooltips();
          
          $("select.chzn-done").removeAttr("style", "").removeClass("chzn-done").addClass("form-control save").data("chosen", null).next().remove();
        }
      }
    });
  };
//--></script>

<script type="text/javascript"><!--//
  function checkParameter(key) {
    var operation = $('select[name=\'requirements['+ key +'][operation]\'').val();
    
    if (operation == 'add' || operation == 'sub') {
      $('#requirements-'+ key +'-parameter').hide();
    } else {
      $('#requirements-'+ key +'-parameter').show();
    }
  }
//--></script>

<script type="text/javascript"><!--
	function clearDebug() {
		$.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/clearDebug&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('#debug-log').val('');
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	function reloadDebug() {
		$.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/reloadDebug&token=<?php echo $token; ?>',
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
					$('#notification').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}
				
				if (json['success']) {
					$('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('#debug-log').val(json['debug_log']);
				}
			}
		});	
	}
//--></script>

<script type="text/javascript"><!--
	$("select.chzn-done").removeAttr("style", "").removeClass("chzn-done").addClass("form-control save").data("chosen", null).next().remove();
	$('.save').change(function() { autosave($(this).attr('name')); });
	$('.save').keyup(function(e) { if (e.keyCode == 13) { autosave($(this).attr('name')); } });
	$('[data-toggle="modal"]').modal({show: false});
//--></script>

<script type="text/javascript"><!--
	function hideRatesControls() {
    $('#tab-rates-controls').hide();
  }
  
  function showRatesControls() {
    <?php if ($version >= 200) { ?>
    $('#tab-rates-controls').show();
    <?php } else { ?>
    $('#tab-rates-controls').show('slide', {direction: 'right'}, 500);
    <?php } ?>
  }
//--></script>

<script type="text/javascript"><!--	
  var tooltip_status = <?php if (${$extension . '_tooltip'}) { ?>true<?php } else { ?>false<?php } ?>;
  function tooltips() {
    <?php if (defined('JPATH_MIJOSHOP_ADMIN') || defined('JPATH_ACESHOP_ADMIN')) { ?>
      /* MijoShop & AceShop */
      if (tooltip_status) {
        $('.hasTooltip').tooltip({"html": true,"container": "body", "trigger": "hover"});
        $('[data-toggle="tooltip"]').tooltip({"html": true,"container": "body", "trigger": "hover"});
        $('[rel="tooltip"]').tooltip({"html": true,"container": "body", "trigger": "hover"});
      } else {
        $('.hasTooltip').tooltip({"html": false,"container": "body", "trigger": "hover"});
        $('[data-toggle="tooltip"]').tooltip({"html": false,"container": "body", "trigger": "hover"});
        $('[rel="tooltip"]').tooltip({"html": false,"container": "body", "trigger": "hover"});
      }
    <?php } else { ?>
      if (tooltip_status) {
        $('[data-toggle="tooltip"]').tooltip({'trigger': 'hover'});
        $('[data-toggle="tooltip"]').tooltip('enable');
        $('[rel="tooltip"]').tooltip({'trigger': 'hover'});
        $('[rel="tooltip"]').tooltip('enable');
      } else {
        $('[data-toggle="tooltip"]').tooltip('disable');
        $('[rel="tooltip"]').tooltip('disable');
      }
    <?php } ?>
  }

	$('#tooltip').bind('click', function() {
		if (tooltip_status) {
      tooltip_status = false;
      $('#tooltip').html('<span class="fa fa-times text-danger"></span> <?php echo $button_tooltip; ?>');
      $('input[name=\'<?php echo $extension; ?>_tooltip\']').val(0);
    } else {
      tooltip_status = true;
      $('#tooltip').html('<span class="fa fa-check text-success"></span> <?php echo $button_tooltip; ?>');
      $('input[name=\'<?php echo $extension; ?>_tooltip\']').val(1);
    }
    
    autosave('<?php echo $extension; ?>_tooltip');
    
    tooltips();
	});
  
  $(document).ready(tooltips());
//--></script>

<script type="text/javascript"><!--
	$('#supportSubmit').bind('click', function() {
		$.ajax({
			url: 'index.php?route=<?php echo $type; ?>/<?php echo $extension; ?>/submitSupportRequest&token=<?php echo $token; ?>',
			data: $('#supportForm input[type=\'email\'], #supportForm input[type=\'text\'], #supportForm textarea'),
			type: 'post',
			dataType: 'json',		
			beforeSend: function() {
				$('#supportSubmit').before('<i class="loading-small fa fa-spinner fa-spin fa-2x"></i>');
			},
			complete: function() {
				$('.loading-small').remove();
			},
			success: function(json) {
				$('.alert-success, .alert-warning, .alert-attention, .alert-error').remove();			
							
				if (json['error']) {
					$('#support').prepend('<span class="alert alert-danger text-center col-sm-12">'+ json['error'] +'</span>');						
				}
				
				if (json['success']) {
					$('#support').html('<span class="alert alert-success text-center col-sm-12">'+ json['success'] +'</span>');
					$('#supportSubmit').hide();
				}
			}
		});	
	});
//--></script>

<?php if ($version < 200) { ?>
	<script type="text/javascript"><!--
		function image_upload(field, thumb) {
			$('#dialog').remove();
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field='+ encodeURIComponent(field) +'" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
			$('#dialog').dialog({
				title: '<?php echo $text_image_manager; ?>',
				close: function (event, ui) {
					if ($('#'+ field).attr('value')) {
						$.ajax({
							url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image='+ encodeURIComponent($('#'+ field).attr('value')),
							type: 'POST',
							data: 'image='+ encodeURIComponent($('#'+ field).attr('value')),
							dataType: 'text',
							success: function(text) {
								$('#'+ thumb).replaceWith('<img src="'+ text +'" alt="" id="'+ thumb +'" style="height: 100px;" />');
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