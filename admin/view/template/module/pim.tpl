<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ppexpress" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a> <a href="<?php echo $search; ?>" data-toggle="tooltip" title="<?php echo $button_search; ?>" class="btn btn-info"><i class="fa fa-search"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if (isset($error['error_warning'])) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error['error_warning']; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Module settings</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-multiimage" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-server" data-toggle="tab"><?php echo $tab_server; ?></a></li>
            <li><a href="#tab-front" data-toggle="tab"><?php echo $tab_front; ?></a></li>  
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="tab-pane active" id="tab-api-details">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-2">
                  <select name="pim_status" id="input-status" class="form-control">
                    <?php if ($pim_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_miu_patch; ?></label>
                <div class="col-sm-2">
                  <select name="pim_miu" id="input-status" class="form-control">
                    <?php if ($pim_miu) { ?>
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
            <div class="tab-pane" id="tab-server">
              <div class="tab-pane active" id="tab-api-details">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_delete_def_image; ?></label>
                <div class="col-sm-4">
                  <select name="pim_deletedef" id="input-status" class="form-control">
                  <option value="0" <?php if (!$pim_deletedef){ echo " selected";}?>><?php echo $text_no;?></option>
                  <option value="1" <?php if ($pim_deletedef){ echo " selected";}?>><?php echo $text_yes;?></option>
                  </select>
                </div>
              </div>                  
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_copyOverwrite; ?></label>
                <div class="col-sm-4">
                  <select name="pim_copyOverwrite" id="input-status" class="form-control">
                  <?php if ($pim_copyOverwrite) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>          
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_uploadOverwrite; ?></label>
                <div class="col-sm-4">
                  <select name="pim_uploadOverwrite" id="input-status" class="form-control">
                  <?php if ($pim_uploadOverwrite) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>                  
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_uploadMaxSize; ?></label>
                <div class="col-sm-2">
                   <input type="text" class="form-control" name="pim_uploadMaxSize" value="<?php echo $pim_uploadMaxSize; ?>" size="4" />
                </div>
                <div class="col-sm-2"><select name="pim_uploadMaxType" id="input-status" class="form-control">
                  <option value="M" <?php if ($pim_uploadMaxType == 'M' || !$pim_uploadMaxType) { echo " selected";}?>>MegaBytes (MB)</option>
                  <option value="K" <?php if ($pim_uploadMaxType == 'K') { echo " selected";}?>>KiloBytes (KB)</option>
                  </select>
                </div>                
              </div>                                              
            </div>
          </div>            
          <div class="tab-pane" id="tab-front">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_language; ?></label>
                <div class="col-sm-4">
                  <select name="pim_language"  class="form-control">
                  <option value=""> EN </option>
                  <?php foreach ($langs as $l) {?>
                      <option value="<?php echo $l;?>" <?php if ($l==$pim_language){ echo " selected";}?>><?php echo strtoupper($l);?></option>
                  <?php } ?>
                </select>
                </div>
              </div>  
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_dimensions; ?></label>
                <div class="col-sm-6">
                   <div class="col-sm-3">
                  <input type="text" class="form-control" name="pim_width" value="<?php echo $pim_width; ?>" size="4" /> </div> <div class="col-sm-1">x</div> <div class="col-sm-3"><input type="text" class="form-control" name="pim_height" value="<?php echo $pim_height; ?>" size="4" /></div>
                </div>
              </div>                                      
          </div>
                     
            </div>
          </div> 
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 