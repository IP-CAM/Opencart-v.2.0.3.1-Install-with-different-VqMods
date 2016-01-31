<?php
//==============================================//
// Product:	Advanced Shipping PRO              	//
// Author: 	Joel Reeds                        	//
// Company: OpenCart Addons                  	//
// Website: http://opencartaddons.com        	//
// Contact: http://opencartaddons.com/contact  	//
//==============================================//

class ModelOCAOCAASPRO extends Model { 
	private $error 			= array();
	private $extension 		= 'ocaaspro';	
	private $db_table		= 'advanced_shipping_pro';
	
	public function addRate($data) {
		foreach ($this->settings() as $key => $value) {
			$data[$key] = isset($data[$key]) ? $data[$key] : $value;
		}			
		
		$this->db->query("INSERT INTO " . DB_PREFIX . $this->db_table . " SET description = '" . $this->db->escape(substr($data['description'], 0, 100)) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', `group` = '" . $this->db->escape($data['group']) . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', total_type = '" . (int)$data['total_type'] . "', name = '" . $this->db->escape(json_encode($data['name'])) . "', instruction = '" . $this->db->escape(json_encode($data['instruction'])) . "', image = '" . $this->db->escape($data['image']) . "', image_width = '" . (int)$data['image_width'] . "', image_height = '" . (int)$data['image_height'] . "', stores = '" . $this->db->escape(json_encode($data['stores'])) . "', customer_groups = '" . $this->db->escape(json_encode($data['customer_groups'])) . "', geo_zones = '" . $this->db->escape(json_encode($data['geo_zones'])) . "', rate_type = '" . $this->db->escape($data['rate_type']) . "', final_cost = '" . (int)$data['final_cost'] . "', split = '" . (int)$data['split'] . "', shipping_factor = '" . (float)$data['shipping_factor'] . "', origin = '" . $this->db->escape($data['origin']) . "', geocode_lat = '" . (float)$data['geocode_lat'] . "', geocode_lng = '" . (float)$data['geocode_lng'] . "', shipping_method = '" . $this->db->escape($data['shipping_method']) . "', currency = '" . $this->db->escape($data['currency']) . "', rates = '" . $this->db->escape($data['rates']) . "', cost = '" . $this->db->escape(json_encode($data['cost'])) . "', freight_fee = '" . $this->db->escape($data['freight_fee']) . "', requirement_match = '" . $this->db->escape($data['requirement_match']) . "', requirement_cost = '" . $this->db->escape($data['requirement_cost']) . "', requirements = '" . $this->db->escape(json_encode($data['requirements'])) . "', date_added = NOW(), date_modified = NOW(), administrator = '" . $this->db->escape($this->user->getUserName()) . "'");
		
		return $this->db->getLastId();
	}
	
	public function editRate($rate_id, $data) {
		foreach ($this->settings() as $key => $value) {
			$data[$key] = isset($data[$key]) ? $data[$key] : $value;
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . $this->db_table . " SET description = '" . $this->db->escape(substr($data['description'], 0, 100)) . "', status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', `group` = '" . $this->db->escape($data['group']) . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', total_type = '" . (int)$data['total_type'] . "', name = '" . $this->db->escape(json_encode($data['name'])) . "', instruction = '" . $this->db->escape(json_encode($data['instruction'])) . "', image = '" . $this->db->escape($data['image']) . "', image_width = '" . (int)$data['image_width'] . "', image_height = '" . (int)$data['image_height'] . "', stores = '" . $this->db->escape(json_encode($data['stores'])) . "', customer_groups = '" . $this->db->escape(json_encode($data['customer_groups'])) . "', geo_zones = '" . $this->db->escape(json_encode($data['geo_zones'])) . "', rate_type = '" . $this->db->escape($data['rate_type']) . "', final_cost = '" . (int)$data['final_cost'] . "', split = '" . (int)$data['split'] . "', shipping_factor = '" . (float)$data['shipping_factor'] . "', origin = '" . $this->db->escape($data['origin']) . "', geocode_lat = '" . (float)$data['geocode_lat'] . "', geocode_lng = '" . (float)$data['geocode_lng'] . "', shipping_method = '" . $this->db->escape($data['shipping_method']) . "', currency = '" . $this->db->escape($data['currency']) . "', rates = '" . $this->db->escape($data['rates']) . "', cost = '" . $this->db->escape(json_encode($data['cost'])) . "', freight_fee = '" . $this->db->escape($data['freight_fee']) . "', requirement_match = '" . $this->db->escape($data['requirement_match']) . "', requirement_cost = '" . $this->db->escape($data['requirement_cost']) . "', requirements = '" . $this->db->escape(json_encode($data['requirements'])) . "', date_modified = NOW(), administrator = '" . $this->db->escape($this->user->getUserName()) . "' WHERE rate_id = '" . (int)$rate_id . "'");
	}
	
	public function copyRate($rate_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . $this->db_table . " WHERE rate_id = '" . (int)$rate_id . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			foreach ($query->row as $key => $value) {
				$data[$key] = $this->value($value);
			}
			$data['rate_id'] = $this->addRate($data);
			
			return $data;
		}
	}
	
	public function deleteRate($rate_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . $this->db_table . " WHERE rate_id = '" . (int)$rate_id . "'");
	}
	
	public function deleteAllRates() {
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . $this->db_table . "");
	}
	
	public function getRate($rate_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . $this->db_table . " WHERE rate_id = '" . (int)$rate_id . "'");
		
		return $query->row;
	}
	
	public function getRates() {
		$query = $this->db->query("SELECT rate_id,description FROM " . DB_PREFIX . $this->db_table . " ORDER BY sort_order, rate_id ASC");
		
		return $query->rows;
	}
	
	private function value($value) {
		return $value = (!is_array($value) && is_array(json_decode($value, true))) ? json_decode($value, true) : $value;
	}
	
	public function settings() {
		return array(
			'rate_id'			=> 0,
			'description'		=> '',
			'status'			=> 0,
			'sort_order'		=> 1,
			'group'				=> '',
			'tax_class_id'		=> 0,
			'total_type'		=> 0,
			'name'				=> array(),
			'instruction'		=> array(),
			'image'				=> '',
			'image_width'		=> 50,
			'image_height'		=> 50,
			'stores'			=> array(0),
			'customer_groups'	=> array(-1,0),
			'geo_zones'			=> array(0),
			'rate_type'			=> 'cart_quantity',
			'final_cost'		=> 0,
			'split'				=> 0,
			'shipping_factor'	=> 5000,
			'origin'			=> '',
			'geocode_lat'		=> 0,
			'geocode_lng'		=> 0,
			'shipping_method'	=> '',
			'currency'			=> $this->config->get('config_currency'),
			'rates'				=> '',
			'cost'				=> array('min'=>'', 'max'=>'', 'add'=>''),
			'freight_fee'		=> '',
			'requirement_match'	=> 'any',
			'requirement_cost'	=> 'every',
			'requirements'		=> array(),
			'date_added'		=> '0000-00-00 00:00:00',
			'date_modified'		=> '0000-00-00 00:00:00',
			'administrator'		=> ''
		);
	}
	
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . $this->db_table . "` (
			`rate_id` int(11) NOT NULL AUTO_INCREMENT,
			`description` text NOT NULL,
			`status` tinyint(1) NOT NULL DEFAULT 0,
			`sort_order` int(3) NOT NULL,
			`group` text NOT NULL,
			`tax_class_id` int(11) NOT NULL,
			`total_type` tinyint(1) NOT NULL,
			`name` text NOT NULL,
			`instruction` text NOT NULL,
			`image` text NOT NULL,
			`image_width` int(3) NOT NULL,
			`image_height` int(3) NOT NULL,
			`stores` text NOT NULL,
			`customer_groups` text NOT NULL,
			`geo_zones` text NOT NULL,
			`rate_type` varchar(50) NOT NULL,
			`final_cost` tinyint(1) NOT NULL,
			`split` tinyint(1) NOT NULL,
			`shipping_factor` decimal(15,3) NOT NULL,
			`origin` text NOT NULL,
			`geocode_lat` decimal(20,8) NOT NULL,
			`geocode_lng` decimal(20,8) NOT NULL,
			`shipping_method` varchar(50) NOT NULL,
			`currency` varchar(10) NOT NULL,
			`rates` text NOT NULL,
			`cost` text NOT NULL,
			`freight_fee` varchar(15) NOT NULL,
			`requirement_match` varchar(10) NOT NULL,
			`requirement_cost` varchar(10) NOT NULL,
			`requirements` longtext NOT NULL,
			`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`administrator` varchar(50) NOT NULL,
			PRIMARY KEY (`rate_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
		
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` MODIFY COLUMN shipping_method text NOT NULL");
	}
	
	public function update() {
		$status 		= false;
		$log 			= 'Success: The following updates have been completed:<br />';
		$custom_table	= $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . $this->db_table. "`");
		$custom_columns	= array();
		foreach ($custom_table->rows as $result) { 
		  $custom_columns[$result['Field']] = $result; 
		}
		
		$order_table	= $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order`");
		$order_columns	= array();
		foreach ($order_table->rows as $result) { 
		  $order_columns[$result['Field']] = $result; 
		}
		
		if ($custom_columns) {
			//v1.5.0
			if (!isset($custom_columns['instruction'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `instruction` TEXT NOT NULL AFTER name");
				$status	= true;
				$log   .= '[v1.5.0] Instruction column added<br />';
			}
			
			//v1.7.0
			if (!isset($custom_columns['split'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `split` TINYINT(1) NOT NULL AFTER final_cost");
				$status	= true;
				$log   .= '[v1.7.0] Split column added<br />';
			}
			
			//v1.9.0
			if (!isset($custom_columns['image'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image` TEXT NOT NULL AFTER status");
				$status	= true;
				$log   .= '[v1.9.0] Image column added<br />';
			}
			if (isset($custom_columns['customer_address'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN customer_address");
				$status	= true;
				$log   .= '[v1.9.0] Customer_Address column removed<br />';
			}
			if (isset($custom_columns['payment_methods'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN payment_methods");
				$status	= true;
				$log   .= '[v1.9.0] Payment_Methods column removed<br />';
			}
			if (isset($custom_columns['shipping_methods'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN shipping_methods");
				$status	= true;
				$log   .= '[v1.9.0] Shipping_Methods column removed<br />';
			}
			if (isset($custom_columns['exclusions'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN exclusions");
				$status	= true;
				$log   .= '[v1.9.0] Exclusions column removed<br />';
			}
			
			//v2.0.0
			if ($order_columns['shipping_method']['Type'] == 'varchar(128)') {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` MODIFY COLUMN shipping_method TEXT NOT NULL");
				$status	= true;
				$log   .= '[v2.0.0] Column shipping_method in table order changed to text<br />';
			}
			
			//v2.2.0
			if (!isset($custom_columns['group'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `group` VARCHAR(3) NOT NULL AFTER instruction");
				$status	= true;
				$log   .= '[v2.2.0] Group column added<br />';
			}
			
			//v3.0.0
			if (!isset($custom_columns['date_added'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `date_added` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER freight_fee");
				$status	= true;
				$log   .= '[v3.0.0] Date_Added column added<br />';
			}
			if (!isset($custom_columns['date_modified'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `date_modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER date_added");
				$status	= true;
				$log   .= '[v3.0.0] Date_Modified column added<br />';
			}
			if (!isset($custom_columns['administrator'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `administrator` VARCHAR(50) NOT NULL AFTER date_modified");
				$status	= true;
				$log   .= '[v3.0.0] Date_Modified column added<br />';
			}
			
			//v3.4.0
			if (!isset($custom_columns['geocode_lat'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `geocode_lat` DECIMAL(20,8) NOT NULL AFTER shipping_factor");
				$status	= true;
				$log   .= '[v3.4.0] GeoCode_Lat column added<br />';
			}
			if (!isset($custom_columns['geocode_lng'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `geocode_lng` DECIMAL(20,8) NOT NULL AFTER geocode_lat");
				$status	= true;
				$log   .= '[v3.4.0] GeoCode_Lng column added<br />';
			}
			
			//v3.5.0
			if (isset($custom_columns['postal_code'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN `postal_code`");
				$status	= true;
				$log   .= '[v3.5.0] Postal_Code column removed<br />';
			} elseif (!isset($custom_columns['origin'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `origin` TEXT NOT NULL AFTER shipping_factor");
				$status	= true;
				$log   .= '[v3.5.0] Origin column added<br />';
			}
			if (isset($custom_columns['geocode_key'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN geocode_key");
				$status	= true;
				$log   .= '[v3.5.0] GeoCode_Key column removed<br />';
			}
			
			//v4.1.0
			if (!isset($custom_columns['image_width'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image_width` INT(3) NOT NULL AFTER image");
				$status	= true;
				$log   .= '[v4.1.0] Image_Width column added<br />';
			}
			if (!isset($custom_columns['image_height'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image_height` INT(3) NOT NULL AFTER image_width");
				$status	= true;
				$log   .= '[v4.1.0] Image_Height column added<br />';
			}
			
			//v4.2.0
			if (!isset($custom_columns['currency'])) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `currency` VARCHAR(15) NOT NULL AFTER total_type");
				$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `currency` = '" . $this->db->escape($this->config->get('config_currency')) . "' WHERE 1");
				$status	= true;
				$log   .= '[v4.2.0] Currency column added<br />';
				$log   .= '[v4.2.0] All rates set to default currency<br />';
			}
			
			//v4.5.0
			if (isset($custom_columns['multirate'])) {
				$temp_combination_data = array();
				foreach ($this->getRates() as $rate) {
					$rate_info = $this->getRate($rate['rate_id']);
					if ($rate_info['multirate'] >= 1) {
						if (isset($temp_combination_data[$rate_info['group']]) && !in_array($rate_info['multirate'], $temp_combination_data[$rate_info['group']])) {
							$temp_combination_data[$rate_info['group']][] = $rate_info['multirate'];
						} elseif (!isset($temp_combination_data[$rate_info['group']])) {
							$temp_combination_data[$rate_info['group']] = array($rate_info['multirate']);
						}
					} else {
						$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `group` = '' WHERE rate_id = '" . (int)$rate['rate_id'] . "'");
					}
				}
				$combination_data = array();
				foreach ($temp_combination_data as $key => $value) {
					foreach ($value as $x) {
						$combination_data[] = array(
							'rate_group'		=> $key,
							'calculation_method'=> $x-1
						);
					}
				}
				
				$this->load->model('setting/setting');
				$this->model_setting_setting->editSetting($this->extension, array($this->extension . '_combinations' => $combination_data));
				
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN `multirate`");
				
				$status	= true;
				$log   .= '[v4.5.0] Combinations setup<br />';
				$log   .= '[v4.5.0] Multirate column removed<br />';
				$log   .= '[v4.5.0] Group column modified<br />';
			}
			
			//v6.0.0
			if (!isset($custom_columns['requirements'])) {
				$status	= true;
				
				$key = date('Ymdhis');
				$this->db->query("CREATE TABLE `" . DB_PREFIX . $this->db_table . "_backup" . $key . "` LIKE `" . DB_PREFIX . $this->db_table . "`");
				$this->db->query("INSERT `" . DB_PREFIX . $this->db_table . "_backup" . $key . "` SELECT * FROM `" . DB_PREFIX . $this->db_table . "`");
				
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` MODIFY COLUMN rate_type varchar(50) NOT NULL");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `shipping_method` VARCHAR(50) NOT NULL AFTER geocode_lng");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `requirement_match` VARCHAR(10) NOT NULL AFTER freight_fee");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `requirement_cost` VARCHAR(10) NOT NULL AFTER requirement_match");
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `requirements` LONGTEXT NOT NULL AFTER requirement_cost");
				
				foreach ($this->getRates() as $rate) {
					$rate_info = $this->getRate($rate['rate_id']);
					$requirements = array();
					$data = array();
					foreach ($rate_info as $key => $value) { $data[$key] = (is_string($value) && preg_match('/^(a:[0-9]+)/', $value)) ? unserialize($value) : $value; }
					if (count($data['days']) < 7) { foreach ($data['days'] as $param) { $requirements[uniqid(rand())] = array('type' => 'day', 'operation' => 'eq', 'value' => $param+1, 'parameter' => ''); } }
					if (!empty($data['currencies']) && !in_array('0', $data['currencies'])) { foreach ($data['currencies'] as $param) { $requirements[uniqid(rand())] = array('type' => 'currency', 'operation' => 'eq', 'value' => $param, 'parameter' => ''); } }
					if (!empty($data['postcode_ranges'])) {	$requirements[uniqid(rand())] = array('type' => 'customer_postcode', 'operation' => ($data['postcode_method'] ? 'eq' : 'neq'), 'value' => $data['postcode_ranges'], 'parameter' => array('type' => ($data['postcode_type'] ? 'other' : 'uk'))); }
					if (!in_array(0, $data['categories'])) { $categories = array(); foreach ($data['categories'] as $param) { $categories[] = $param; } $requirements[uniqid(rand())] = array('type' => 'product_category', 'operation' => 'eq', 'value' => $categories, 'parameter' => array('match' => 'any')); }
					$params = array('time', 'date', 'cart_quantity', 'cart_total', 'cart_weight', 'cart_volume', 'cart_distance');
					foreach ($params as $param) {
						if (!empty($data[$param]['min'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'gte', 'value' => $data[$param]['min'], 'parameter' => array('match' => 'any')); }
						if (!empty($data[$param]['max'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'lte', 'value' => $data[$param]['max'], 'parameter' => array('match' => 'any')); }
						if (!empty($data[$param]['add'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'add', 'value' => $data[$param]['add'], 'parameter' => array('match' => 'any')); }
						if (!empty($data[$param]['start'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'gte', 'value' => $data[$param]['start'], 'parameter' => ''); }
						if (!empty($data[$param]['end'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'lte', 'value' => $data[$param]['end'], 'parameter' => ''); }
					}
					$params = array('cart_length', 'cart_width', 'cart_height', 'product_length', 'product_width', 'product_height');
					foreach ($params as $param) {
						if (!empty($data[$param]['min'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'gte', 'value' => $data[$param]['min'], 'parameter' => array('match' => 'any')); }
						if (!empty($data[$param]['max'])) { $requirements[uniqid(rand())] 	= array('type' => $param, 'operation' => 'lte', 'value' => $data[$param]['max'], 'parameter' => array('match' => 'any')); }
					}
					$rate_type = str_replace(array(0, 1, 2, 3, 4, 5), array('cart_quantity', 'cart_total', 'cart_weight', 'cart_volume', 'cart_dim_weight', 'cart_distance'), $data['rate_type']);
					$requirement_cost = str_replace(array(0, 1, 2), array('every', 'all', 'none'), $data['category_cost']);
					$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `rate_type` = '" . $this->db->escape($rate_type) . "', `name` = '" . $this->db->escape(json_encode($data['name'])) . "', `instruction` = '" . $this->db->escape(json_encode($data['instruction'])) . "', `stores` = '" . $this->db->escape(json_encode($data['stores'])) . "', `customer_groups` = '" . $this->db->escape(json_encode($data['customer_groups'])) . "', `geo_zones` = '" . $this->db->escape(json_encode($data['geo_zones'])) . "', `cost` = '" . $this->db->escape(json_encode($data['cost'])) . "', `requirement_match` = 'all', `requirement_cost` = '" . $this->db->escape($requirement_cost) . "', `requirements` = '" . $this->db->escape(json_encode($requirements)) . "' WHERE rate_id = '" . (int)$rate['rate_id'] . "'");
				}
				
				$log   .= '[v6.0.0] Serialized values converted to json_encode<br />';
				$log   .= '[v6.0.0] Column requirement_match column added<br />';
				$log   .= '[v6.0.0] Column requirement_cost column added<br />';
				$log   .= '[v6.0.0] Column requirements added<br />';
				$log   .= '[v6.0.0] Column requirements populated with existing settings<br />';
				$log   .= '[v6.0.0] Column shipping_method added<br />';
				$log   .= '[v6.0.0] Column rate_type changed to varchar<br />';
				
				$params = array('time', 'date', 'days', 'postcode_type', 'postcode_method', 'postcode_ranges', 'cart_quantity', 'cart_total', 'cart_weight', 'cart_volume', 'cart_distance', 'cart_length', 'cart_width', 'cart_height', 'product_length', 'product_width', 'product_height', 'category_match', 'category_cost', 'categories', 'currencies');
				foreach ($params as $param) {
					if (isset($custom_columns[$param])) {
						$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN " . $param);
						$log   .= '[v6.0.0] Column ' . $param . ' removed<br />';
					}
				}
			}
		}
		
		return array(
			'status'	=> $status,
			'log'		=> $log
		);
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE " . DB_PREFIX . $this->db_table . "");
	}
}
?>