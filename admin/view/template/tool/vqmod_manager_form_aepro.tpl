<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
    	<?php if ($success) { ?>
    	<span class="alert alert-success pull-left" style="margin:0 20px 0 0; padding:8px 10px;"><i class="fa fa-check-circle"></i> <?php echo $success; ?></span>
    	<?php } ?>
        <button type="button" onclick="vqSaveContinue();" data-toggle="tooltip" title="<?php echo $text_save_continue; ?>" class="btn btn-success"><?php echo $button_save_continue; ?></button>&nbsp;
        <a href="<?php echo $return; ?>" data-toggle="tooltip" title="<?php echo $text_cancel_return; ?>" class="btn btn-danger"><?php echo $button_cancel_return; ?></a>  
      </div>
      <h1><?php echo $heading_title_vqmods; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit_vqmod; ?></h3>
      </div>
      <div class="panel-body clearfix">
        <form action="" method="post" enctype="multipart/form-data" id="form-vqmod-edit" class="form-horizontal">       
          <div class="form-group required">
            <div class="col-sm-12">
            <label class="control-label" for="input-text"><?php echo $column_xml; ?></label>
            <pre id="xml_code" style="width:98% !important; height:480px; position:relative; margin:0 1%; font-size:1.1em;"><?php echo htmlentities($vqmod_xml); ?></pre>
              <?php if ($error_xml) { ?>
              <span class="text-danger">
              <?php echo $error_xml; ?></span>
              <?php } ?>
            </div>
          </div>
        	<input type="hidden" id="save_continue" name="save_continue" value="1" />
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
	var path = "view/javascript/code_editor";
	var editorconfig = ace.require("ace/config");
	editorconfig.set("workerPath", path);
	var xml_editor = ace.edit("xml_code");
	xml_editor.setTheme("ace/theme/cobalt");
	xml_editor.getSession().setMode("ace/mode/xml");
function vqSaveContinue(){
		var xml_code = xml_editor.getValue();
		$('#xml_code').after('<text'+'area name="vqmod_file" style="display:none" cols="60" rows="15" id="inputcode" class="form-control">'+xml_code+'</text'+'area>');
		$('#form-vqmod-edit').attr('action', '<?php echo $save_continue; ?>');
		$('#form-vqmod-edit').submit();
}
//--></script> 
<?php echo $footer; ?>