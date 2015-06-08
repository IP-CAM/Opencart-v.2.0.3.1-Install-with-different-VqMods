<?php echo $header; ?>
<?php echo $column_left; ?>

<!--content --> 
<div id="content">

<!-- page header -->   
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right msg">
            	<?php if ($success) { ?>
    			<span class="alert alert-success" style="margin:0 20px 0 0;"><i class="fa fa-check-circle"></i> <?php echo $success; ?></span>
    			<?php } ?>
                <button type="button" data-toggle="tooltip" title="<?php echo $text_delete_selected; ?>" data-placement="left" class="btn btn-danger" onclick="confirm('<?php echo $warning_vqmod_delete; ?>') ? removeVqmods() : false;"><i class="fa fa-trash-o"></i></button>
            </div>

	  		<h1 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title_vqmods; ?></h1>
      		<ul class="breadcrumb">
        		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
        		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        		<?php } ?>
      		</ul>
        </div>
    </div>
<!-- page header --> 

<!-- container-fluid -->
    <div class="container-fluid">
        <?php if($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-body">
<!-- Content Loader -->
 				<div id="content_loader" rel="index.php?route=tool/vqmod_manager_aepro&token=<?php echo $token; ?>">
<!-- Content Loader -->

                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-vqmod">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-scripts"><?php echo $tab_scripts; ?></a></li>
                        <li><a data-toggle="tab" href="#tab-settings"><?php echo $tab_settings; ?></a></li>
                        <li<?php if ($data['log']) { ?> class="highlight-error"<?php } ?>><a data-toggle="tab" href="#tab-error"><?php echo $tab_error_log; ?></a></li>
                        <li><a data-toggle="tab" href="#tab-about"><?php echo  $tab_about; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <?php if ($vqmod_is_installed == true) { ?>
                        
                        <div id="tab-scripts" class="tab-pane active">
							<div class="table-responsive">
                                <table class="table table-bordered ae-table-hover ae-table-striped ae-list">
                                    <thead>
                                        <tr>
<!-- Checkbox Column Header -->
                  							<th style="width: 1px;" class="text-center" id="cbox_checked_all"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
<!-- Checkbox Column Header -->
                                            <th class="text-left"><?php echo $column_id; ?></th>
                                    		<th class="text-left"><?php echo $column_size; ?></th>
                                            <th class="text-center"><?php echo $column_version; ?></th>
                                    		<th class="text-center"><?php echo $column_vqmver; ?></th>
                                    		<th class="text-center"><?php echo $column_author; ?></th>
                                    		<th class="text-center" width="100"><?php echo $column_status; ?></th>
                                    		<th class="text-center" width="150"><?php echo $column_install; ?></th>
                                            <th class="text-center"><?php echo $column_action; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($vqmods) { ?>
                                        <?php foreach ($vqmods as $vqmod) { ?>
                                        <tr>
<!-- Checkbox Column -->
                  							<td class="text-center cbox_checked">
                                            <?php if (in_array($vqmod['file_name'], $selected)) { ?>
                    							<input type="checkbox" name="selected[]" value="<?php echo $vqmod['file_name']; ?>" checked="checked" />
                                            <?php } else { ?>
                                            	<input type="checkbox" name="selected[]" value="<?php echo $vqmod['file_name']; ?>" />
                                            <?php } ?>
                                            </td>
<!-- Checkbox Column -->
                                            <td class="vqnws text-left"><strong><?php echo $vqmod['file_name']; ?></strong><br />
                                            <div class="vqdescription"><?php echo $vqmod['id']; ?><br /><?php echo $vqmod['invalid_xml']; ?></div>                                           
                                            </td>
                                            <td class="text-left"><?php echo $vqmod['file_size']; ?></td>
                                            <td class="text-center"><?php echo $vqmod['version']; ?></td>
                                            <td class="text-center"><?php echo $vqmod['vqmver']; ?></td>
                                            <td class="text-center"><?php echo $vqmod['author']; ?></td>
                                            <td class="text-center"><?php echo $vqmod['status'] ?></td>
                                            <td class="text-center">
                                            <?php foreach ($vqmod['action'] as $action) { 
                                                if($vqmod['installed'] == 'Enabled'){?>
                                                <a title="<?php echo $action['text']; ?>" class="btn btn-danger" data-toggle="tooltip" href="<?php echo $action['href']; ?>"><i class="fa fa-minus-circle"></i></a>
                                                <?php } else { ?>
                                                 <a title="<?php echo $action['text']; ?>" class="btn btn-success" data-toggle="tooltip" href="<?php echo $action['href']; ?>"><i class="fa fa-plus-circle" ></i></a>
                                            <?php }} ?>
                                            </td>
                                            <td class="vqnws text-center">
                                                <a href="<?php echo $vqmod['edit'] ?>" data-toggle="tooltip" title="<?php echo $text_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;
                                                <a href="<?php echo $vqmod['download'] ?>" data-toggle="tooltip" title="<?php echo $text_download; ?>" class="btn btn-warning"><i class="fa fa-download"></i></a>&nbsp;
                                                <a href="<?php echo $vqmod['delete'] ?>" data-toggle="tooltip" title="<?php echo $text_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <tr>
                                            <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                
                                <table class="table table-bordered ae-list">
                                    <tr>
                                        <td class="text-left" width="200"><?php echo $entry_upload; ?></td>
                                        <td class="text-left" width="400"><input data-toggle="tooltip" title="<?php echo $entry_upload; ?>" type="file" name="vqmod_file" class="filestyle" /></td>
                                        <td class="text-left">&nbsp;<button type="submit" class="btn btn-primary" onclick="$('#form-vqmod').attr('action', '<?php echo $upload_vqmod; ?>'); $('#form-vqmod').submit();"><i class="fa fa-upload"></i> <?php echo $text_upload; ?></button></td>
                                    </tr>
                                </table>                            
                            </div>
                		</div>                        
                        
                        <div id="tab-settings" class="tab-pane">
                        	<div class="table-responsive"> 
                                <table class="table table-bordered ae-table-striped ae-list">
                                    <tr>
                                        <td class="text-left"><?php echo $entry_vqcache; ?><br /><span class="vqhelp"><?php echo $text_vqcache_help; ?></span></td>
                                        <td class="text-left">
                                            <select multiple="multiple" size="7" id="vqcache">
                                                <?php foreach ($vqcache as $vqcache_file) { ?>
                                                <option><?php echo $vqcache_file; ?></option>
                                                <?php } ?>
                                            </select><br />
                                            <a href="<?php echo $clear_vqcache; ?>" class="btn btn-danger" data-toggle="tooltip"  title="<?php echo $button_clear; ?>"><span><i class="fa fa-trash-o"><?php echo ' '.$button_clear; ?></i></span></a>
                                            <?php if ($ziparchive) { ?>
                                            <a href="<?php echo $download_vqcache; ?>" class="btn btn-danger" data-toggle="tooltip"  title="<?php echo $button_vqcache_dump; ?>"><span><i class="fa fa-trash-o"><?php echo ' ' .$button_vqcache_dump; ?></i></span></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_backup; ?></td>
                                        <?php if ($ziparchive) { ?>
                                        <td class="text-left"><a data-toggle="tooltip" title="<?php echo $button_backup; ?>" href="<?php echo $download_scripts; ?>" class="btn btn-primary"><span><i class="fa fa-save"><?php echo ' ' .$button_backup; ?></i></span></a></td>
                                        <?php } else { ?>
                                        <td class="text-left"><?php echo $error_ziparchive; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_vqmod_path; ?></td>
                                        <td class="text-left"><?php echo $vqmod_path; ?></td>
                                    </tr>
                                    <?php if ($vqmod_vars) { ?>
                                    <?php foreach ($vqmod_vars as $vqmod_var) { ?>
                                    <tr>
                                        <td class="text-left"><?php echo $vqmod_var['setting']; ?></td>
                                        <td class="text-left"><?php echo $vqmod_var['value']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                </table>                            
                            </div>
                        </div>                      
 
                        <div id="tab-error" class="tab-pane">
                             <div class="table-responsive">
                                 <table class="table table-bordered ae-table-striped ae-list">
                                    <tr>
                                        <td class="text-left"><textarea rows="20" cols="90" id="error-log"><?php echo $log; ?></textarea>
                                            <div class="right"><?php if ($ziparchive) { ?><a data-toggle="tooltip" title="<?php echo $button_download_log; ?>" href="<?php echo $download_log; ?>" class="btn btn-primary"><span><i class="fa fa-save"><?php echo ' ' .$button_download_log; ?></i></span></a><?php } ?> <a data-toggle="tooltip" title="<?php echo $button_clear; ?>" href="<?php echo $clear_log; ?>" class="btn btn-danger"><span><i class="fa fa-trash-o"><?php echo ' ' .$button_clear; ?></i></span></a></div></td>
                                    </tr>
                                </table>                             
                             </div>
                        </div> 

                        <div id="tab-about" class="tab-pane">
                             <div class="table-responsive">
                                <table class="table table-bordered ae-table-hover ae-table-striped ae-list">
                                    <tr>
                                        <td class="text-left"><?php echo $entry_ext_version; ?></td>
                                        <td class="text-left"><?php echo $vqmod_manager_version; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_author; ?></td>
                                        <td class="text-left"><?php echo $vqmod_manager_author; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_website; ?></td>
                                        <td class="text-left"> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_ext_store; ?></td>
                                        <td class="text-left"> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_forum; ?></td>
                                        <td class="text-left"><a class="" target="_blank"></a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_license; ?></td>
                                        <td class="text-left"><a class="about" href="http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode" target="_blank"><?php echo $vqmod_manager_license; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_attribution; ?></td>
                                        <td class="text-left"><?php echo $text_attribution; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <?php } else { ?>
                		<span><?php echo $vqmod_installation_error; ?></span>
                		<?php } ?>
            		</div>
				</form>
<!-- Content Loader -->
				</div>
 <!-- Content Loader -->       
        	</div>
        </div>
	</div>
<!-- container-fluid -->
    
</div> 
<!--content --> 

<script type="text/javascript">
var thisurl = $("#content_loader").attr("rel");
function removeVqmods() {
	$(".alert, .alert2").remove();
	$('[data-toggle=\'tooltip\']').tooltip('hide');
    $("#overlay").remove();
    var postData = $('input[name*=\'selected\']:checked').serialize();
	var ajaxUrl = 'index.php?route=tool/vqmod_manager_aepro/vqmod_delete_multi&token=<?php echo $token; ?>';
	$.ajax({
		url: ajaxUrl,
		type: 'post',
		data: postData,
		beforeSend: function() {
			saveOverlay();
		},
		success: function(response) {
			var errortext = response.match(/<div\s+class="alert-danger">[\S\s]*?<\/div>/gi);
			if (!errortext) {
				$(".page-header .container-fluid .pull-right").prepend('<span class="alert2 alert-success2 pull-left"><i class="fa fa-check-circle"></i> <?php echo $success_delete_multi; ?></span>');				
				$(".alert-success2").hide(0).delay(10).fadeIn(500);
   				$(".alert-success2").show(0).delay(5000).fadeOut(2000);
				$("#content_loader").load(thisurl + " #content_loader > *", function() {
					$(":file").filestyle();
					$("#overlay").remove();
				});
			} else {
				$("#overlay").remove();
				errortext = errortext[0].replace(/(<\/?[^>]+>)/gi, "");
				$(".page-header .container-fluid .pull-right").prepend('<span class="alert2 alert-danger2"><i class="fa fa-exclamation-circle"></i>  ' + errortext + '</span>');
			}
		}
	});
}

$(document).ready(function () {
	// Confirm Delete
	$('a').click(function () {
		if ($(this).attr('href') != null && $(this).attr('href').indexOf('delete', 1) != -1) {
			if (!confirm('<?php echo $warning_vqmod_delete; ?>')) {
				return false;
			}
		}
	});

	// Confirm vqmod_opencart.xml Uninstall
	$('a').click(function () {
		if ($(this).attr('href') != null && $(this).attr('href').indexOf('vqmod_opencart', 1) != -1 && $(this).attr('href').indexOf('uninstall', 1) != -1) {
			if (!confirm('<?php echo $warning_required_uninstall; ?>')) {
            	return false;
        	}
		}
	});

	// Confirm vqmod_opencart.xml Delete
	$('a').click(function () {
		if ($(this).attr('href') != null && $(this).attr('href').indexOf('vqmod_opencart', 1) != -1 && $(this).attr('href').indexOf('delete', 1) != -1) {
        	if (!confirm('<?php echo $warning_required_delete; ?>')) {
            	return false;
        	}
    	}
	});
});
</script>

<script type="text/javascript"><!--
$('#tabs a:first').tab('show');
//--></script>
<?php echo $footer; ?>  