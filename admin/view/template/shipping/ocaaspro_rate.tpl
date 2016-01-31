<div class="row rate-header" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
	<h2 class="pull-left" onclick="saveRate(<?php echo $rate_id; ?>);"><?php echo $data['description']; ?></h2>
	<span class="pull-right">
		<a onclick="saveRate(<?php echo $rate_id; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_save; ?>"><i class="fa fa-floppy-o fa-lg"></i></a>
		&nbsp;&nbsp;
		<a onclick="closeRate(<?php echo $rate_id; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_close; ?>"><i class="fa fa-times fa-lg"></i></a>
		&nbsp;&nbsp;
		<a onclick="if (confirm('<?php echo $text_confirm_delete; ?>')) { deleteRate(<?php echo $rate_id; ?>) }" date-toggle="tooltip" data-placement="bottom" title="<?php echo $button_rate_delete; ?>"><i class="fa fa-trash-o fa-lg"></i></a>
	</span>
</div>
<div class="row rate-content">
  <div class="col-sm-12 rate-error" id="<?php echo $rate_id; ?>-error" style="display: none;"><?php echo $error_rate; ?></div>
  <div class="col-sm-12 no-padding">
    <input type="hidden" name="rate_id" value="<?php echo $rate_id; ?>" />
    <div class="rate-column col-lg-3 text-center">
      <div class="entry"><?php echo $header_general; ?></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td><?php echo $entry_description; ?></td>
              <td><input type="text" name="description" class="form-control" value="<?php echo $data['description']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_description; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_rate_status; ?></td>
              <td>
                <select name="status" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_rate_status; ?>">
                  <?php if ($data['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" class="form-control" value="<?php echo $data['sort_order']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_rate_sort_order; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_group; ?></td>
              <td><input type="text" name="group" value="<?php echo $data['group']; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_group; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_tax; ?></td>
              <td>
                <select name="tax_class_id" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_tax; ?>">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                    <?php if ($tax_class['tax_class_id'] == $data['tax_class_id']) { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_total_type; ?></td>
              <td>
                <select name="total_type" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_total_type; ?>">
                  <?php foreach ($total_type as $param) { ?>
                    <?php if ($param['id'] == $data['total_type']) { ?>
                    <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $header_display; ?></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td><?php echo $entry_name; ?></td>
              <td>
                <?php foreach ($languages as $language) { ?>
                  <div class="input-group">
                    <span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
                    <input type="text" name="name[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['name'][$language['code']])) ? $data['name'][$language['code']] : ''; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_name; ?>" />
                  </div>
                <?php } ?>
              </td>
            </tr>
            <?php if ($instruction_status) { ?>
              <tr>
                <td><?php echo $entry_instruction; ?></td>
                <td>
                  <?php foreach ($languages as $language) { ?>
                    <div class="input-group">
                      <span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
                      <input type="text" name="instruction[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['instruction'][$language['code']])) ? $data['instruction'][$language['code']] : ''; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_instruction; ?>" />
                    </div>
                  <?php } ?>
                </td>
              </tr>
            <?php } else { ?>
            <?php foreach ($languages as $language) { ?>
              <input type="hidden" name="instruction[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['instruction'][$language['code']])) ? $data['instruction'][$language['code']] : ''; ?>" />
              <?php } ?>
            <?php } ?>
            <?php if ($image_status) { ?>
              <tr>
                <td><?php echo $entry_image; ?></td>
                <td>
                  <?php if ($version >= 200) { ?>
                  <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
                  <input type="hidden" name="image" value="<?php echo $data['image']; ?>" id="input-image-<?php echo $rate_id; ?>" />
                  <?php } else { ?>
                  <img src="<?php echo $thumb; ?>" alt="" id="thumb-<?php echo $rate_id; ?>" style="height: 50px;" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_image; ?>" /><br />
                  <input type="hidden" name="image" value="<?php echo $data['image']; ?>" id="image-<?php echo $rate_id; ?>" />
                  <a onclick="image_upload('image-<?php echo $rate_id; ?>', 'thumb-<?php echo $rate_id; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-<?php echo $rate_id; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image-<?php echo $rate_id; ?>').attr('value', '');"><?php echo $text_clear; ?></a>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_image_size; ?></td>
                <td>
                  <div class="col-sm-6"><input type="text" name="image_width" class="form-control" value="<?php echo $data['image_width']; ?>" placeholder="<?php echo $text_width; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_image_width; ?>" /></div>
                  <div class="col-sm-6"><input type="text" name="image_height" class="form-control" value="<?php echo $data['image_height']; ?>" placeholder="<?php echo $text_height; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_image_height; ?>" /></div>
                </td>
              </tr>
            <?php } else { ?>
              <input type="hidden" name="image" value="<?php echo $data['image']; ?>" />
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_stores; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_stores; ?>">
          <?php $class = 'even'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['stores']) && in_array(0, $data['stores'])) { ?>
              <input type="checkbox" name="stores[]" id="store-<?php echo $rate_id; ?>-0" value="0" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="stores[]" id="store-<?php echo $rate_id; ?>-0" value="0" />
            <?php } ?>
            <label for="store-<?php echo $rate_id; ?>-0"><?php echo $default_store; ?></label>
          </div>
          <?php foreach ($stores as $store) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['stores']) && in_array($store['store_id'], $data['stores'])) { ?>
                <input type="checkbox" name="stores[]" id="store-<?php echo $rate_id; ?>-<?php echo $store['store_id']; ?>" value="<?php echo $store['store_id']; ?>" checked="checked" />
              <?php } else { ?>
                <input type="checkbox" name="stores[]" id="store-<?php echo $rate_id; ?>-<?php echo $store['store_id']; ?>" value="<?php echo $store['store_id']; ?>" />
              <?php } ?>
              <label for="store-<?php echo $rate_id; ?>-<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></label>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> / <a href="<?php echo $link_store; ?>" target="_blank"><?php echo $text_add_new; ?></a>
        <br /><span id="<?php echo $rate_id; ?>-error-stores" class="rate-error" style="display: none;"></span>
      </div>
      <div class="entry"><?php echo $entry_customer_groups; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_customer_groups; ?>">
          <?php $class = 'even'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['customer_groups']) && in_array(-1, $data['customer_groups'])) { ?>
              <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>--1" value="-1" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>--1" value="-1" />
            <?php } ?>
            <label for="customer-group-<?php echo $rate_id; ?>--1"><i><?php echo $text_all_customers; ?></i></label>
          </div>
          <?php $class = 'odd'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['customer_groups']) && in_array(0, $data['customer_groups'])) { ?>
              <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>-0" value="0" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>-0" value="0" />
            <?php } ?>
            <label for="customer-group-<?php echo $rate_id; ?>-0"><?php echo $text_guest_checkout; ?></label>
          </div>
          <?php foreach ($customer_groups as $customer_group) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['customer_groups']) && in_array($customer_group['customer_group_id'], $data['customer_groups'])) { ?>
                <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>-<?php echo $customer_group['customer_group_id']; ?>" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
              <?php } else { ?>
                <input type="checkbox" name="customer_groups[]" id="customer-group-<?php echo $rate_id; ?>-<?php echo $customer_group['customer_group_id']; ?>" value="<?php echo $customer_group['customer_group_id']; ?>" />
              <?php } ?>
              <label for="customer-group-<?php echo $rate_id; ?>-<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> / <a href="<?php echo $link_customer_group; ?>" target="_blank"><?php echo $text_add_new; ?></a>
        <br /><span id="<?php echo $rate_id; ?>-error-customer-groups" class="rate-error" style="display: none;"></span>
      </div>
      <div class="entry"><?php echo $entry_geo_zones; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_geo_zones; ?>">		
          <?php $class = 'even'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['geo_zones']) && in_array(0, $data['geo_zones'])) { ?>
              <input type="checkbox" name="geo_zones[]" id="geo-zone-<?php echo $rate_id; ?>-0" value="0" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="geo_zones[]" id="geo-zone-<?php echo $rate_id; ?>-0" value="0" />
            <?php } ?>
            <label for="geo-zone-<?php echo $rate_id; ?>-0"><i><?php echo $text_all_zones; ?></i></label>
          </div>
          <?php foreach ($geo_zones as $geo_zone) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['geo_zones']) && in_array($geo_zone['geo_zone_id'], $data['geo_zones'])) { ?>
                <input type="checkbox" name="geo_zones[]" id="geo-zone-<?php echo $rate_id; ?>-<?php echo $geo_zone['geo_zone_id']; ?>" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
              <?php } else { ?>
                <input type="checkbox" name="geo_zones[]" id="geo-zone-<?php echo $rate_id; ?>-<?php echo $geo_zone['geo_zone_id']; ?>" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
              <?php } ?>
              <label for="geo-zone-<?php echo $rate_id; ?>-<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></label>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> / <a href="<?php echo $link_geo_zone; ?>" target="_blank"><?php echo $text_add_new; ?></a> 
        <br /><span id="<?php echo $rate_id; ?>-error-geo-zones" class="rate-error" style="display: none;"></span>
      </div>
    </div>
    <div class="rate-column col-lg-3 text-center">
      <div class="entry"><?php echo $header_rate; ?></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td><?php echo $entry_rate_type; ?></td>
              <td>
                <div class="input-group">
                  <select name="rate_type" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_rate_type; ?>">
                  <?php foreach ($rate_types as $key => $value) { ?>
                    <?php if (!empty($value)) { ?>
                      <optgroup label="<?php echo ${'text_rate_group_' . $key}; ?>">
                      <?php foreach ($value as $param) { ?>
                        <?php if ($param['id'] == $data['rate_type']) { ?>
                          <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                        <?php } else { ?>
                          <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                      </optgroup>
                    <?php } ?>
                  <?php } ?>
                  </select>
                  <span class="input-group-addon"><a role="button" data-toggle="modal" data-target="#modalRateType" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>"><i class="fa fa-info-circle"></i></a></span>
                </div>
              </td>
            </tr>
            <tr id="shipping-factor<?php echo $rate_id; ?>" class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_shipping_factor; ?></td>
              <td>
                <div class="input-group">
                  <input type="text" name="shipping_factor" value="<?php echo $data['shipping_factor']; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_shipping_factor; ?>" />
                  <span class="input-group-addon"><a role="button" data-toggle="modal" data-target="#modalShippingFactor" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>"><i class="fa fa-info-circle"></i></a></span>
                </div>
                <span id="<?php echo $rate_id; ?>-error-shipping-factor" class="rate-error" style="display: none;"></span>
              </td>
            </tr>
            <tr id="origin<?php echo $rate_id; ?>" class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_origin; ?></td>
              <td>
                <input type="text" name="origin" value="<?php echo $data['origin']; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_origin; ?>" />
                <span id="<?php echo $rate_id; ?>-error-origin" class="rate-error" style="display: none;"></span>
              </td>
            </tr>
            <tr class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_final_cost; ?></td>
              <td>
                <div class="input-group">
                  <select name="final_cost" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_final_cost; ?>">
                    <?php foreach ($final_cost as $param) { ?>
                      <?php if ($param['id'] == $data['final_cost']) { ?>
                        <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <span class="input-group-addon"><a role="button" data-toggle="modal" data-target="#modalFinalCost" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>"><i class="fa fa-info-circle"></i></a></span>
                </div>
              </td>
            </tr>
            <tr class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_split; ?></td>
              <td>
                <select name="split" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_split; ?>">
                  <?php if ($data['split']) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class="rate-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_rate_currency; ?></td>
              <td>
                <select name="currency" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_rate_currency; ?>">
                  <?php foreach ($currencies as $currency) { ?>
                  <?php if ($currency['code'] == $data['currency']) { ?>
                    <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['title']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class="shipping-settings<?php echo $rate_id; ?>">
              <td><?php echo $entry_shipping_method; ?></td>
              <td>
                <input type="text" name="shipping_method" value="<?php echo $data['shipping_method']; ?>" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_shipping_method; ?>" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_rates; ?> <a role="button" data-toggle="modal" data-target="#modalRates" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle"></i></a></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr class="rate-settings<?php echo $rate_id; ?>">
              <td colspan="2">
                <textarea name="rates" class="form-control" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_rates; ?>"><?php echo $data['rates']; ?></textarea>
                <span id="<?php echo $rate_id; ?>-error-rates" class="rate-error" style="display: none;"></span>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_cost; ?></td>
              <td>
                <div class="col-sm-4"><input type="text" name="cost[min]" class="form-control" value="<?php echo $data['cost']['min']; ?>" placeholder="<?php echo $text_min; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_cost_min; ?>" /></div>
                <div class="col-sm-4"><input type="text" name="cost[max]" class="form-control" value="<?php echo $data['cost']['max']; ?>" placeholder="<?php echo $text_max; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_cost_max; ?>" /></div>
                <div class="col-sm-4"><input type="text" name="cost[add]" class="form-control" value="<?php echo $data['cost']['add']; ?>" placeholder="<?php echo $text_add; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $tooltip_cost_add; ?>" /></div>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_freight_fee; ?></td>
              <td><input type="text" name="freight_fee" class="form-control" value="<?php echo $data['freight_fee']; ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip_freight_fee; ?>" /></td>
            </tr>             
          </tbody>
        </table>													
      </div>
    </div>
    <div class="rate-column col-lg-6 text-center">
      <div class="entry"><?php echo $header_requirements; ?> <a role="button" data-toggle="modal" data-target="#modalRequirements" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle"></i></a></div>
      <div class="input">
        <table class="table table-hover requirements">
          <tbody>
            <tr>
              <td colspan="4">
                <div class="input-group">
                  <select name="requirement_match" class="form-control" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip_requirement_match; ?>">
                    <?php foreach ($requirement_match as $param) { ?>
                      <?php if ($param['id'] == $data['requirement_match']) { ?>
                      <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <span class="input-group-addon"><a role="button" data-toggle="modal" data-target="#modalRequirementMatch" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>"><i class="fa fa-info-circle"></i></a></span>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="4">
                <div class="input-group">
                  <select name="requirement_cost" class="form-control" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip_requirement_cost; ?>">
                    <?php foreach ($requirement_cost as $param) { ?>
                      <?php if ($param['id'] == $data['requirement_cost']) { ?>
                      <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                  <span class="input-group-addon"><a role="button" data-toggle="modal" data-target="#modalRequirementCost" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>"><i class="fa fa-info-circle"></i></a></span>
                </div>
              </td>
            </tr>
            <?php foreach ($data['requirements'] as $key => $value) { ?>
              <tr>
                <td id="requirements-<?php echo $key; ?>-type">
                  <select name="requirements[<?php echo $key; ?>][type]" class="form-control" onchange="getRequirement('<?php echo $key; ?>')">
                  <?php foreach ($requirement_types as $group => $types) { ?>
                    <?php if (!empty($types)) { ?>
                      <optgroup label="<?php echo ${'text_requirement_group_' . $group}; ?>">
                      <?php foreach ($types as $param) { ?>
                        <?php if ($param['id'] == $value['type']) { ?>
                          <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                        <?php } else { ?>
                          <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                      </optgroup>
                    <?php } ?>
                  <?php } ?>
                  </select>
                </td>
                <td id="requirements-<?php echo $key; ?>-operation">
                  <select name="requirements[<?php echo $key; ?>][operation]" onchange="checkParameter('<?php echo $key; ?>')" class="form-control">
                  <?php foreach ($operations[$value['type']] as $param) { ?>
                    <?php if ($param['id'] == $value['operation']) { ?>
                    <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                  </select>
                </td>
                <td id="requirements-<?php echo $key; ?>-value">
                  <?php if (!empty($values[$value['type']])) { ?>
                    <?php if ($value['type'] == 'product_category') { ?>
                      <div class="scrollbox" <?php if (isset(${'tooltip_' . $value['type']})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type']}; ?>"<?php } ?>>
                      <?php $class = 'odd'; ?>
                      <?php foreach ($values[$value['type']] as $param) { ?>
                        <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
                        <div class="<?php echo $class; ?>"><input type="checkbox" name="requirements[<?php echo $key; ?>][value][]" id="requirement-<?php echo $key; ?>-<?php echo $param['id']; ?>" value="<?php echo $param['id']; ?>" <?php if (!empty($value['value']) && in_array($param['id'], $value['value'])) { ?>checked="checked"<?php } ?>><label for="requirement-<?php echo $key; ?>-<?php echo $param['id']; ?>"><?php echo $param['name']; ?></label></div>
                      <?php } ?>
                      </div>
                    <?php } else { ?>
                      <select name="requirements[<?php echo $key; ?>][value]" class="form-control" <?php if (isset(${'tooltip_' . $value['type']})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type']}; ?>"<?php } ?>>
                      <?php foreach ($values[$value['type']] as $param) { ?>
                        <?php if ($param['id'] == $value['value']) { ?>
                        <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  <?php } elseif ($value['type'] == 'date') { ?>
                    <input type="text" name="requirements[<?php echo $key; ?>][value]" class="form-control date" value="<?php echo $value['value']; ?>" <?php if (isset(${'tooltip_' . $value['type']})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type']}; ?>"<?php } ?> />
                  <?php } elseif ($value['type'] == 'time') { ?>
                    <input type="text" name="requirements[<?php echo $key; ?>][value]" class="form-control time" value="<?php echo $value['value']; ?>" <?php if (isset(${'tooltip_' . $value['type']})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type']}; ?>"<?php } ?> />
                  <?php } else { ?>
                    <input type="text" name="requirements[<?php echo $key; ?>][value]" class="form-control" value="<?php echo $value['value']; ?>" <?php if (isset(${'tooltip_' . $value['type']})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type']}; ?>"<?php } ?> />
                  <?php } ?>
                  <span id="error-requirement-<?php echo $key; ?>" class="rate-error" style="display: none;"></span>
                  <?php if (!empty($parameters[$value['type']])) { ?>
                    <?php foreach ($parameters[$value['type']] as $parameter_type => $parameter) { ?>
                      <select name="requirements[<?php echo $key; ?>][parameter][<?php echo $parameter_type; ?>]" <?php if ($value['operation'] == 'add' || $value['operation'] == 'sub') { ?>style="display: none;"<?php } ?> id="requirements-<?php echo $key; ?>-parameter" class="form-control" <?php if (isset(${'tooltip_' . $value['type'] . '_' . $parameter_type})) { ?>data-toggle="tooltip" data-placement="top" title="<?php echo ${'tooltip_' . $value['type'] . '_' . $parameter_type}; ?>"<?php } ?>>
                      <?php foreach ($parameter as $param) { ?>
                        <?php if ($param['id'] == $value['parameter'][$parameter_type]) { ?>
                        <option value="<?php echo $param['id']; ?>" selected="selected"><?php echo $param['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $param['id']; ?>"><?php echo $param['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                      </select>
                    <?php } ?>
                  <?php } else { ?>
                    <input type="hidden" name="requirements[<?php echo $key; ?>][parameter]" value="" />
                  <?php } ?>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
            <?php } ?>
            <tr id="<?php echo $rate_id; ?>-requirement-footer"><td colspan="3">&nbsp;</td><td><button type="button" onclick="addRequirement(<?php echo $rate_id; ?>);" class="btn btn-oca"><i class="fa fa-plus-circle"></i></button></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-12 footer text-center"><?php echo $footer; ?></div>
</div>

<script type="text/javascript"><!--
	$('.date').datetimepicker({format: 'Y-m-d', timepicker: false, allowBlank: true, scrollInput: false});
	$('.time').datetimepicker({format: 'H:i', datepicker: false, allowBlank: true, scrollInput: false});
  
  <?php if (!empty($rate_types['other'])) { ?>
	<?php $params = array(); ?>
  <?php foreach ($rate_types['other'] as $rate_type) { $params[] = $rate_type['id']; } ?>
  var rate_group_other = ["<?php echo implode('","', $params); ?>"];
  $(document).ready(function() { if ($.inArray("<?php echo $data['rate_type']; ?>", rate_group_other) !== -1) { $('.rate-settings<?php echo $rate_id; ?>').hide(); $('.shipping-settings<?php echo $rate_id; ?>').show(); } else { $('.rate-settings<?php echo $rate_id; ?>').show(); $('.shipping-settings<?php echo $rate_id; ?>').hide(); } });
  <?php } ?>
  
  <?php if (strpos($data['rate_type'], 'dim_weight') === false) { ?>$('#shipping-factor<?php echo $rate_id; ?>').hide();<?php } ?>   
  <?php if (strpos($data['rate_type'], 'cart_distance') === false) { ?>$('#origin<?php echo $rate_id; ?>').hide();<?php } ?>   
  
  $('select[name=\'rate_type\'').change(function() {
    if ($.inArray($(this).val(), rate_group_other) !== -1) { 
      $('.rate-settings<?php echo $rate_id; ?>').hide(); 
      $('.shipping-settings<?php echo $rate_id; ?>').show(); 
    } else { 
      $('.rate-settings<?php echo $rate_id; ?>').show(); 
      $('.shipping-settings<?php echo $rate_id; ?>').hide();
      if ($(this).val() == 'cart_dim_weight' || $(this).val() == 'product_dim_weight') { $('#shipping-factor<?php echo $rate_id; ?>').show(); } else { $('#shipping-factor<?php echo $rate_id; ?>').hide(); }
      if ($(this).val() == 'cart_distance') { $('#origin').show(); } else { $('#origin<?php echo $rate_id; ?>').hide(); }
    }
  });
//--></script>