<div class="row rate-header">
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
    <div class="col-md-3 text-center">
      <div class="entry"><?php echo $entry_description; ?></div>
      <div class="input">
        <input type="text" name="description" class="form-control" value="<?php echo $data['description']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_description; ?>" />
      </div>
      <div class="entry"><?php echo $entry_rate_status; ?></div>
      <div class="input">
        <select name="status" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_rate_status; ?>">
          <?php if ($data['status']) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
          <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
          <?php } ?>
        </select>
      </div>
      <?php if ($image_status) { ?>
        <div class="entry"><?php echo $entry_image; ?></div>
        <div class="input">
          <?php if ($version >= 200) { ?>
            <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $no_image; ?>" /></a>
            <input type="hidden" name="image" value="<?php echo $data['image']; ?>" id="input-image-<?php echo $rate_id; ?>" />
          <?php } else { ?>
            <img src="<?php echo $thumb; ?>" alt="" id="thumb-<?php echo $rate_id; ?>" style="height: 50px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_image; ?>" /><br />
            <input type="hidden" name="image" value="<?php echo $data['image']; ?>" id="image-<?php echo $rate_id; ?>" />
            <a onclick="image_upload('image-<?php echo $rate_id; ?>', 'thumb-<?php echo $rate_id; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb-<?php echo $rate_id; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image-<?php echo $rate_id; ?>').attr('value', '');"><?php echo $text_clear; ?></a>
          <?php } ?>
        </div>
        <div class="entry"><?php echo $entry_image_size; ?></div>
        <div class="input">
          <table class="table table-hover">
            <thead>
              <tr>
                <th><?php echo $text_width; ?></th>
                <th><?php echo $text_height; ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" name="image_width" class="form-control" value="<?php echo $data['image_width']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_image_width; ?>" /></td>
                <td><input type="text" name="image_height" class="form-control" value="<?php echo $data['image_height']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_image_height; ?>" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <input type="hidden" name="image" value="<?php echo $data['image']; ?>" />
      <?php } ?>
      <div class="entry"><?php echo $entry_name; ?></div>
      <div class="input">
        <?php foreach ($languages as $language) { ?>
          <div class="input-group input-group-sm">
            <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
            <input type="text" name="name[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['name'][$language['code']])) ? $data['name'][$language['code']] : ''; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_name; ?>" />
          </div>
        <?php } ?>
      </div>
      <?php if ($instruction_status) { ?>
        <div class="entry"><?php echo $entry_instruction; ?></div>
        <div class="input">
          <?php foreach ($languages as $language) { ?>
            <div class="input-group input-group-sm">
              <span class="input-group-addon" data-toggle="tooltip" data-placement="bottom" title="<?php echo $language['name']; ?>"><?php echo strtoupper($language['code']); ?></span>
              <input type="text" name="instruction[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['instruction'][$language['code']])) ? $data['instruction'][$language['code']] : ''; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_instruction; ?>" />
            </div>
          <?php } ?>
        </div>
      <?php } else { ?>
      <?php foreach ($languages as $language) { ?>
        <input type="hidden" name="instruction[<?php echo $language['code']; ?>]" value="<?php echo (isset($data['instruction'][$language['code']])) ? $data['instruction'][$language['code']] : ''; ?>" />
        <?php } ?>
      <?php } ?>
      <div class="entry"><?php echo $entry_rate_sort_order; ?></div>
      <div class="input">
        <input type="text" name="sort_order" class="form-control" value="<?php echo $data['sort_order']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_rate_sort_order; ?>" />
      </div>
      <div class="entry"><?php echo $entry_tax; ?></div>
      <div class="input">
        <select name="tax_class_id" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_tax; ?>">
          <option value="0"><?php echo $text_none; ?></option>
          <?php foreach ($tax_classes as $tax_class) { ?>
            <?php if ($tax_class['tax_class_id'] == $data['tax_class_id']) { ?>
              <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
	  <div class="entry"><?php echo $entry_time; ?></div>
      <div class="input">
        <table class="table table-hover">
          <thead>
            <tr>
              <th><?php echo $text_start; ?></th>
              <th><?php echo $text_end; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="time[start]" class="form-control" value="<?php echo $data['time']['start']; ?>" id="time-start-<?php echo $rate_id; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_time_start; ?>" /></td>
              <td><input type="text" name="time[end]" class="form-control" value="<?php echo $data['time']['end']; ?>" id="time-end-<?php echo $rate_id; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_time_end; ?>" /></td>
            </tr>
          </tbody>
        </table>
        <?php echo $text_time; ?>
      </div>
      <div class="entry"><?php echo $entry_dates; ?></div>
      <div class="input">
        <table class="table table-hover">
          <thead>
            <tr>
              <th><?php echo $text_start; ?></th>
              <th><?php echo $text_end; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="date[start]" class="form-control" value="<?php echo $data['date']['start']; ?>" id="date-start-<?php echo $rate_id; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_dates_start; ?>" /></td>
              <td><input type="text" name="date[end]" class="form-control" value="<?php echo $data['date']['end']; ?>" id="date-end-<?php echo $rate_id; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_dates_end; ?>" /></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <div class="entry"><?php echo $entry_days; ?></div>
      <div class="input">
        <div class="scrollbox text-left" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_days; ?>">
          <?php $class = 'odd'; ?>
          <?php foreach ($days as $day) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['days']) && in_array($day['id'], $data['days'])) { ?>
                <input type="checkbox" name="days[]" id="day-<?php echo $rate_id; ?>-<?php echo $day['id']; ?>" value="<?php echo $day['id']; ?>" checked="checked" />
                <label for="day-<?php echo $rate_id; ?>-<?php echo $day['id']; ?>"><?php echo $day['name']; ?></label>
              <?php } else { ?>
                <input type="checkbox" name="days[]" id="day-<?php echo $rate_id; ?>-<?php echo $day['id']; ?>"value="<?php echo $day['id']; ?>" />
                <label for="day-<?php echo $rate_id; ?>-<?php echo $day['id']; ?>"><?php echo $day['name']; ?></label>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
        <br /><span id="<?php echo $rate_id; ?>-error-days" class="rate-error" style="display: none;"></span>
      </div>
	  <div class="entry"><?php echo $entry_stores; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_stores; ?>">
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
        <div class="scrollbox" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_customer_groups; ?>">
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
        <br /><span id="<?php echo $rate_id; ?>-error-customer_groups" class="rate-error" style="display: none;"></span>
      </div>
      <div class="entry"><?php echo $entry_geo_zones; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_geo_zones; ?>">		
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
        <br /><span id="<?php echo $rate_id; ?>-error-geo_zones" class="rate-error" style="display: none;"></span>
      </div>
      <div class="entry"><?php echo $entry_postal_codes; ?> <a role="button" data-toggle="modal" data-target="#modalPostalCodeRanges" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle fa-lg"></i></a></div>
      <div class="input">
        <select name="postcode_type" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_postal_codes_type; ?>">
          <?php foreach ($postal_code_types as $postal_code_type) { ?>
            <?php if ($postal_code_type['id'] == $data['postcode_type']) { ?>
              <option value="<?php echo $postal_code_type['id']; ?>" selected="selected"><?php echo $postal_code_type['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $postal_code_type['id']; ?>"><?php echo $postal_code_type['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
      <div class="input">
        <select name="postcode_method" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_postal_codes_method; ?>">
          <?php if ($data['postcode_method']) { ?>
            <option value="1" selected="selected"><?php echo $text_postal_codes_allow; ?></option>
            <option value="0"><?php echo $text_postal_codes_deny; ?></option>
          <?php } else { ?>
            <option value="1"><?php echo $text_postal_codes_allow; ?></option>
            <option value="0" selected="selected"><?php echo $text_postal_codes_deny; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="input">
        <textarea name="postcode_ranges" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_postal_codes_ranges; ?>" rows="4"><?php echo $data['postcode_ranges']; ?></textarea>
		<span id="<?php echo $rate_id; ?>-error-postcode_ranges" class="rate-error" style="display: none;"></span>
		<span id="<?php echo $rate_id; ?>-error-postcode" class="rate-error" style="display: none;"></span>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <div class="entry"><?php echo $entry_cart_values; ?></div>
      <div class="input">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>&nbsp;</td>
              <th><?php echo $text_min; ?></th>
              <th><?php echo $text_max; ?></th>
              <th><?php echo $text_add; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $entry_quantity; ?></td>
              <td><input type="text" name="cart_quantity[min]" class="form-control" value="<?php echo $data['cart_quantity']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_quantity_min; ?>" /></td>
              <td><input type="text" name="cart_quantity[max]" class="form-control" value="<?php echo $data['cart_quantity']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_quantity_max; ?>" /></td>
              <td><input type="text" name="cart_quantity[add]" class="form-control" value="<?php echo $data['cart_quantity']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_quantity_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_total; ?></td>
              <td><input type="text" name="cart_total[min]" class="form-control" value="<?php echo $data['cart_total']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_total_min; ?>" /></td>
              <td><input type="text" name="cart_total[max]" class="form-control" value="<?php echo $data['cart_total']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_total_max; ?>" /></td>
              <td><input type="text" name="cart_total[add]" class="form-control" value="<?php echo $data['cart_total']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_total_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_weight; ?></td>
              <td><input type="text" name="cart_weight[min]" class="form-control" value="<?php echo $data['cart_weight']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_weight_min; ?>" /></td>
              <td><input type="text" name="cart_weight[max]" class="form-control" value="<?php echo $data['cart_weight']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_weight_max; ?>" /></td>
              <td><input type="text" name="cart_weight[add]" class="form-control" value="<?php echo $data['cart_weight']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_weight_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_volume; ?></td>
              <td><input type="text" name="cart_volume[min]" class="form-control" value="<?php echo $data['cart_volume']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_volume_min; ?>" /></td>
              <td><input type="text" name="cart_volume[max]" class="form-control" value="<?php echo $data['cart_volume']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_volume_max; ?>" /></td>
              <td><input type="text" name="cart_volume[add]" class="form-control" value="<?php echo $data['cart_volume']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_volume_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_distance; ?></td>
              <td><input type="text" name="cart_distance[min]" class="form-control" value="<?php echo $data['cart_distance']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_distance_min; ?>" /></td>
              <td><input type="text" name="cart_distance[max]" class="form-control" value="<?php echo $data['cart_distance']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_distance_max; ?>" /></td>
              <td><input type="text" name="cart_distance[add]" class="form-control" value="<?php echo $data['cart_distance']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_distance_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_length; ?></td>
              <td><input type="text" name="cart_length[min]" class="form-control" value="<?php echo $data['cart_length']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_length_min; ?>" /></td>
              <td><input type="text" name="cart_length[max]" class="form-control" value="<?php echo $data['cart_length']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_length_max; ?>" /></td>
              <td><input type="text" name="cart_length[add]" class="form-control" value="<?php echo $data['cart_length']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_length_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_width; ?></td>
              <td><input type="text" name="cart_width[min]" class="form-control" value="<?php echo $data['cart_width']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_width_min; ?>" /></td>
              <td><input type="text" name="cart_width[max]" class="form-control" value="<?php echo $data['cart_width']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_width_max; ?>" /></td>
              <td><input type="text" name="cart_width[add]" class="form-control" value="<?php echo $data['cart_width']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_width_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_height; ?></td>
              <td><input type="text" name="cart_height[min]" class="form-control" value="<?php echo $data['cart_height']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_height_min; ?>" /></td>
              <td><input type="text" name="cart_height[max]" class="form-control" value="<?php echo $data['cart_height']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_height_max; ?>" /></td>
              <td><input type="text" name="cart_height[add]" class="form-control" value="<?php echo $data['cart_height']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_height_add; ?>" /></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_product_dimensions; ?></div>
      <div class="input">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>&nbsp;</th>
              <th><?php echo $text_min; ?></th>
              <th><?php echo $text_max; ?></th>
              <th><?php echo $text_add; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $entry_length; ?></td>
              <td><input type="text" name="product_length[min]" class="form-control" value="<?php echo $data['product_length']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_length_min; ?>" /></td>
              <td><input type="text" name="product_length[max]" class="form-control" value="<?php echo $data['product_length']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_length_max; ?>" /></td>
              <td><input type="text" name="product_length[add]" class="form-control" value="<?php echo $data['product_length']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_length_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_width; ?></td>
              <td><input type="text" name="product_width[min]" class="form-control" value="<?php echo $data['product_width']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_width_min; ?>" /></td>
              <td><input type="text" name="product_width[max]" class="form-control" value="<?php echo $data['product_width']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_width_max; ?>" /></td>
              <td><input type="text" name="product_width[add]" class="form-control" value="<?php echo $data['product_width']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_width_add; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_height; ?></td>
              <td><input type="text" name="product_height[min]" class="form-control" value="<?php echo $data['product_height']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_height_min; ?>" /></td>
              <td><input type="text" name="product_height[max]" class="form-control" value="<?php echo $data['product_height']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_height_max; ?>" /></td>
              <td><input type="text" name="product_height[add]" class="form-control" value="<?php echo $data['product_height']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_product_height_add; ?>" /></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_category_settings; ?> <a role="button" data-toggle="modal" data-target="#modalCategorySettings" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle fa-lg"></i></a></div>
      <div class="input">
        <b><?php echo $entry_category_setting; ?></b><br/>
        <select name="category_match" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_category_setting; ?>">
          <?php foreach ($category_settings as $category_setting) { ?>
            <?php if ($category_setting['id'] == $data['category_match']) { ?>
              <option value="<?php echo $category_setting['id']; ?>" selected="selected"><?php echo $category_setting['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $category_setting['id']; ?>"><?php echo $category_setting['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select><br/>
        <b><?php echo $entry_cost_setting; ?></b><br/>
        <select name="category_cost" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_cost_setting; ?>">
          <?php foreach ($cost_settings as $cost_setting) { ?>
            <?php if ($cost_setting['id'] == $data['category_cost']) { ?>
              <option value="<?php echo $cost_setting['id']; ?>" selected="selected"><?php echo $cost_setting['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $cost_setting['id']; ?>"><?php echo $cost_setting['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select><br/>
        <b><?php echo $entry_categories; ?></b><br/>
        <div class="scrollbox" style="height:150px;" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_categories; ?>">
          <?php $class = 'even'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['categories']) && in_array(0, $data['categories'])) { ?>
              <input type="checkbox" name="categories[]" id="category-<?php echo $rate_id; ?>-0" value="0" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="categories[]" id="category-<?php echo $rate_id; ?>-0" value="0" />
            <?php } ?>
            <label for="category-<?php echo $rate_id; ?>-0"><i><?php echo $text_all_categories; ?></i></label>
          </div>
          <?php foreach ($categories as $category) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['categories']) && in_array($category['category_id'], $data['categories'])) { ?>
                <input type="checkbox" name="categories[]" id="category-<?php echo $rate_id; ?>-<?php echo $category['category_id']; ?>" value="<?php echo $category['category_id']; ?>" checked="checked" />
              <?php } else { ?>
                <input type="checkbox" name="categories[]" id="category-<?php echo $rate_id; ?>-<?php echo $category['category_id']; ?>" value="<?php echo $category['category_id']; ?>" />
              <?php } ?>
              <label for="category-<?php echo $rate_id; ?>-<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></label>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> / <a href="<?php echo $link_category; ?>" target="_blank"><?php echo $text_add_new; ?></a>
        <br /><span id="<?php echo $rate_id; ?>-error-categories" class="rate-error" style="display: none;"></span>
      </div>
    </div>
    <div class="col-md-3 text-center">
	  <div class="entry"><?php echo $entry_currencies; ?></div>
      <div class="input">
        <div class="scrollbox" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_currencies; ?>">		
          <?php $class = 'even'; ?>
          <div class="<?php echo $class; ?>">
            <?php if (!empty($data['currencies']) && in_array('0', $data['currencies'])) { ?>
              <input type="checkbox" name="currencies[]" id="currencies-<?php echo $rate_id; ?>-0" value="0" checked="checked" />
            <?php } else { ?>
              <input type="checkbox" name="currencies[]" id="currencies-<?php echo $rate_id; ?>-0" value="0" />
            <?php } ?>
            <label for="currencies-<?php echo $rate_id; ?>-0"><i><?php echo $text_all_currencies; ?></i></label>
          </div>
          <?php foreach ($currencies as $currency) { ?>
            <?php $class = ($class == 'even') ? 'odd' : 'even'; ?>
            <div class="<?php echo $class; ?>">
              <?php if (!empty($data['currencies']) && in_array($currency['code'], $data['currencies'])) { ?>
                <input type="checkbox" name="currencies[]" id="currencies-<?php echo $rate_id; ?>-<?php echo $currency['code']; ?>" value="<?php echo $currency['code']; ?>" checked="checked" />
              <?php } else { ?>
                <input type="checkbox" name="currencies[]" id="currencies-<?php echo $rate_id; ?>-<?php echo $currency['code']; ?>" value="<?php echo $currency['code']; ?>" />
              <?php } ?>
              <label for="currencies-<?php echo $rate_id; ?>-<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></label>
            </div>
          <?php } ?>
        </div>
        <a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a> / <a href="<?php echo $link_currency; ?>" target="_blank"><?php echo $text_add_new; ?></a> 
        <br /><span id="<?php echo $rate_id; ?>-error-currencies" class="rate-error" style="display: none;"></span>
      </div>
      <div class="entry"><?php echo $entry_multirate; ?> <a role="button" data-toggle="modal" data-target="#modalMultiRate" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle fa-lg"></i></a></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td><?php echo $entry_multirate_group; ?></td>
              <td><input type="text" name="group" value="<?php echo $data['group']; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_multirate_group; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_multirate_method; ?></td>
              <td>
                <select name="multirate" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_multirate_method; ?>">
                  <?php foreach ($multirates as $multirate) { ?>
                    <?php if ($multirate['id'] == $data['multirate']) { ?>
                      <option value="<?php echo $multirate['id']; ?>" selected="selected"><?php echo $multirate['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $multirate['id']; ?>"><?php echo $multirate['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_total_type; ?></div>
      <div class="input">
        <select name="total_type" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_total_type; ?>">
          <?php foreach ($total_types as $total_type) { ?>
            <?php if ($total_type['id'] == $data['total_type']) { ?>
              <option value="<?php echo $total_type['id']; ?>" selected="selected"><?php echo $total_type['name']; ?></option>
            <?php } else { ?>
              <option value="<?php echo $total_type['id']; ?>"><?php echo $total_type['name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
      <div class="entry"><?php echo $entry_rate_settings; ?> <a role="button" data-toggle="modal" data-target="#modalRateSettings" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle fa-lg"></i></a></div>
      <div class="input">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td><?php echo $entry_rate_type; ?></td>
              <td>
                <select name="rate_type" class="form-control" onchange="$(this).val() == '4' ? $('#shipping_factor<?php echo $rate_id; ?>').fadeIn('slow') : $('#shipping_factor<?php echo $rate_id; ?>').hide(); $(this).val() == '5' ? $('#origin<?php echo $rate_id; ?>').fadeIn('slow') : $('#origin<?php echo $rate_id; ?>').hide();" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_rate_type; ?>">
                  <?php foreach ($rate_types as $rate_type) { ?>
                    <?php if ($rate_type['id'] == $data['rate_type']) { ?>
                      <option value="<?php echo $rate_type['id']; ?>" selected="selected"><?php echo $rate_type['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $rate_type['id']; ?>"><?php echo $rate_type['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select> 
              </td>
            </tr>
            <tr id="shipping_factor<?php echo $rate_id; ?>" <?php if (isset($data['rate_type']) && $data['rate_type'] !== '4') { echo 'style="display: none;"'; } ?>>
              <td><?php echo $entry_shipping_factor; ?></td>
              <td>
                <input type="text" name="shipping_factor" value="<?php echo $data['shipping_factor']; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_shipping_factor; ?>" />
                <span id="<?php echo $rate_id; ?>-error-shipping_factor" class="rate-error" style="display: none;"></span>
              </td>
            </tr>
            <tr id="origin<?php echo $rate_id; ?>" <?php if (isset($data['rate_type']) && $data['rate_type'] !== '5') { echo 'style="display: none;"'; } ?>>
              <td><?php echo $entry_origin; ?></td>
              <td>
                <input type="text" name="origin" value="<?php echo $data['origin']; ?>" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_origin; ?>" />
                <span id="<?php echo $rate_id; ?>-error-origin" class="rate-error" style="display: none;"></span>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_final_cost; ?></td>
              <td>
                <select name="final_cost" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_final_cost; ?>">
                  <?php foreach ($final_costs as $final_cost) { ?>
                    <?php if ($final_cost['id'] == $data['final_cost']) { ?>
                      <option value="<?php echo $final_cost['id']; ?>" selected="selected"><?php echo $final_cost['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $final_cost['id']; ?>"><?php echo $final_cost['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_split; ?></td>
              <td>
                <select name="split" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_split; ?>">
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
			<tr>
			  <td><?php echo $entry_currency; ?></td>
              <td>
                <select name="currency" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_currency; ?>">
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
          </tbody>
        </table>													
      </div>
      <div class="entry"><?php echo $entry_rates; ?> <a role="button" data-toggle="modal" data-target="#modalRates" rel="tooltip" data-placement="bottom" title="<?php echo $text_example; ?>" class="pull-right"><i class="fa fa-info-circle fa-lg"></i></a></div>
      <div class="input">
        <textarea name="rates" class="form-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_rates; ?>" rows="6"><?php echo $data['rates']; ?></textarea>
        <span id="<?php echo $rate_id; ?>-error-rates" class="rate-error" style="display: none;"></span> 
      </div>
      <div class="entry"><?php echo $entry_shipping_cost; ?></div>
      <div class="input">
        <table class="table table-hover">
          <thead>
            <tr>
              <th><?php echo $text_min; ?></th>
              <th><?php echo $text_max; ?></th>
              <th><?php echo $text_add; ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="cost[min]" class="form-control" value="<?php echo $data['cost']['min']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_cost_min; ?>" /></td>
              <td><input type="text" name="cost[max]" class="form-control" value="<?php echo $data['cost']['max']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_cost_max; ?>" /></td>
              <td><input type="text" name="cost[add]" class="form-control" value="<?php echo $data['cost']['add']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_cost_add; ?>" /></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="entry"><?php echo $entry_freight_fee; ?></div>
      <div class="input">
        <input type="text" name="freight_fee" class="form-control" value="<?php echo $data['freight_fee']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $help_freight_fee; ?>" />
      </div>
    </div>
  </div>
  <div class="col-sm-12 footer text-center"><?php echo $footer; ?></div>
</div>

<script type="text/javascript"><!--
	$('#date-start-<?php echo $rate_id; ?>').datetimepicker({format: 'Y-m-d', timepicker: false, allowBlank: true});
	$('#date-end-<?php echo $rate_id; ?>').datetimepicker({format: 'Y-m-d', timepicker: false, allowBlank: true});
	$('#time-start-<?php echo $rate_id; ?>').datetimepicker({format: 'H:i', datepicker: false, allowBlank: true});
	$('#time-end-<?php echo $rate_id; ?>').datetimepicker({format: 'H:i', datepicker: false, allowBlank: true});
//--></script>