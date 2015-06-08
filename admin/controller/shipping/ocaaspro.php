<?php
//==//
class ControllerShippingOCAASPRO extends Controller { 
	private $error 						= array();
	private $version 					= '4.4.1';
	private $extension 					= 'ocaaspro';
	private $type 						= 'shipping';
	private $db_table					= 'advanced_shipping_pro';
	private $email						= 'NIL';
	private $href_oca					= '';
	private $href_oc					= '';
	private $href_med					= '';
	private $href_facebook				= '';
	private $href_twitter				= '';
		
	public function index() { 
		$this->checkInstall();
		
		$update = $this->checkUpdates();
		if ($update['status']) {
			$this->session->data['success'] = $update['log'];
		}
		
		$this->load->model('oca/' . $this->extension);
		$this->load->model('localisation/language');	
		
		$data = array();
		$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
		
		$data['mijoshop'] 	= false;
		$data['aceshop'] 	= false;
		$data['joomla'] 	= 0;
		
		//Check If MijoShop
		if (defined('JPATH_MIJOSHOP_ADMIN')) {
			$data['mijoshop'] = true;
			
			//get the array containing all the script declarations
			$document = JFactory::getDocument(); 
			$headData = $document->getHeadData();
			$scripts = $headData['scripts'];

			//remove your script, i.e. mootools
			unset($scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
			unset($scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
			$headData['scripts'] = $scripts;
			$document->setHeadData($headData);
			
			if (Mijoshop::get('base')->is30()) {
				$data['joomla'] = 300;
			} elseif (Mijoshop::get('base')->is32()) {
				$data['joomla'] = 320;
			} else {
				$data['joomla'] = 200;
			}
		//Check If AceShop
		} elseif (defined('JPATH_ACESHOP_ADMIN')) {
			$data['aceshop'] = true;
			
			//get the array containing all the script declarations
			$document = JFactory::getDocument(); 
			$headData = $document->getHeadData();
			$scripts = $headData['scripts'];

			//remove your script, i.e. mootools
			unset($scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
			unset($scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
			$headData['scripts'] = $scripts;
			$document->setHeadData($headData);
			
			if (AceShop::get('base')->is15()) {
				$data['joomla'] = 150;
			} elseif (AceShop::get('base')->is3x()) {
				$data['joomla'] = 300;
			} else {
				$data['joomla'] = 200;
			}
		}
		
		$this->document->addStyle('view/javascript/oca/datetimepicker/jquery.datetimepicker.css');
		$this->document->addScript('view/javascript/oca/datetimepicker/jquery.datetimepicker.js');
		
		$data['img_logo'] 		= $this->img_logo;
		$data['icon_logo'] 		= $this->icon_logo;
		
		$data['extension'] 		= $this->extension;
		$data['extensionType'] 	= $this->type;
		$data['version'] 		= $this->getVersion();
			
		$data['text_footer'] 	= sprintf($data['text_footer'], $this->version);
		
		$data['href_oca']		= $this->href_oca;
		$data['href_oc']		= $this->href_oc;
		$data['href_med']		= $this->href_med;
		$data['href_facebook']	= $this->href_facebook;
		$data['href_twitter']	= $this->href_twitter;
		
		$data['demo'] 			= (isset($this->request->server['HTTP_HOST']) && $this->request->server['HTTP_HOST'] == 'demo.opencartaddons.com') ? $this->href_oca : false;
		
		$data['debug_download']	= $this->getLink($this->type, $this->extension . '/downloadDebug&format=raw');
		$data['debug_clear']	= $this->getLink($this->type, $this->extension . '/clearDebug&format=raw');
		
		$data['rate_import']	= $this->getLink($this->type, $this->extension);
		$data['rate_export']	= $this->getLink($this->type, $this->extension . '/exportRates&format=raw');
		
		if (isset($this->request->files[$this->extension . '_import']) && is_uploaded_file($this->request->files[$this->extension . '_import']['tmp_name'])) {
			$this->importRates($this->request->files[$this->extension . '_import']['tmp_name']);
		} elseif (isset($this->request->post[$this->extension . '_export'])) {
			$this->exportRates();
		}
		
		$data['success']		= isset($this->session->data['success']) ? $this->session->data['success'] : '';
		$data['error_warning'] 	= isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['rate_errors'] 	= isset($this->session->data['rate_errors']) ? $this->session->data['rate_errors'] : array();
		
		unset($this->session->data['success']);
		unset($this->session->data['rate_errors']);
		
  		$breadcrumbs = array();
   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->getLink('common', 'home'),
      		'separator' => false
   		);
   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_' . $this->type),
			'href'      => $this->getLink('extension', $this->type),
      		'separator' => '::'
   		);		
   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_name'),
			'href'      => $this->getLink($this->type, $this->extension),
      		'separator' => "::"
   		);
		
		$fields = array('status', 'title', 'sort_order', 'sort_quotes', 'title_display', 'display_value', 'debug');
		foreach ($fields as $field) {
			$key = $this->extension . '_' . $field;
			$value = isset($this->request->post[$key]) ? $this->request->post[$key] : $this->config->get($key);
			if ($value) {
				$data[$key] = $this->getField($value);
			} else {
				$data[$key] = '';
			}
		}
		
		$options = array('sort_quotes', 'title_displays');
		foreach ($options as $option) {
			$x = 0;
			$data[$option] = array();
			while (isset($data[$option . '_' . $x])) {
				$data[$option][] = array(
					'id'	=> $x,
					'name'	=> $data[$option . '_' . $x]
				);
				$x++;
			}
		}

		$data['rates']	= array();
		$rates			= $this->model_oca_ocaaspro->getRates();
		if ($rates) {
			foreach ($rates as $rate) {
				$data['rates'][] = array(
					'rate_id'		=> $rate['rate_id'],
					'description'	=> substr($rate['description'], 0, 150),
				);
			}
		}
		
		$data['languages'] 	= $this->model_localisation_language->getLanguages();
		
		$data['token']  	= $this->session->data['token'];
		$data['action'] 	= $this->getLink($this->type, $this->extension);
		$data['cancel'] 	= $this->getLink('extension', $this->type);

		if ($this->getVersion() >= 200) {
			$this->document->setTitle($data['text_name']);
			$data['breadcrumbs'] 	= $breadcrumbs;
			$data['header'] 		= $this->load->controller('common/header');
			$data['column_left'] 	= $this->load->controller('common/column_left');
			$data['footer'] 		= $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view($this->type . '/' . $this->extension . '.tpl', $data));
		} else {
			$this->data = array_merge($this->data, $data);
			$this->document->setTitle($this->data['text_name']);
			$this->data['breadcrumbs'] 	= $breadcrumbs;
			$this->template 			= $this->type . '/' . $this->extension . '.tpl';
			$this->children 			= array(
				'common/header',
				'common/footer',
			);
			$this->response->setOutput($this->render());
		}
	}
	
	private function getVersion() {
		if (defined('VERSION') && VERSION < 1.5) {
			$oc = 140;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.0') === 0) {
			$oc = 150;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.1') === 0) {
			$oc = 151;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.2') === 0) {
			$oc = 152;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.3') === 0) {
			$oc = 153;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.4') === 0) {
			$oc = 154;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.5') === 0) {
			$oc = 155;
		} elseif (defined('VERSION') && strpos(VERSION, '1.5.6') === 0) {
			$oc = 156;
		} elseif (defined('VERSION') && strpos(VERSION, '2.0') === 0) {
			$oc = 200;
		} else {
			$oc = '';
		}
		if (defined('VERSION') && VERSION >= 1.5 && !$oc) {
			$oc = 152;
		}
		if (defined('JPATH_MIJOSHOP_ADMIN') && strpos(Mijoshop::get('base')->getMijoshopVersion(), '3.') === 0) {
			$oc = 200;
		}
		return $oc;
	}
	
	private function getLink($a, $b) {
		$route = $a . '/' . $b;
		return $this->url->link($route, 'token=' . $this->session->data['token'], 'SSL');
	}
	
	private function getField($value) {
		if (is_string($value) && strpos($value, 'a:') === 0) {
			$value = unserialize($value);
		}
		return $value;
	}
	
	public function install() {
		$this->checkInstall();
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` MODIFY COLUMN shipping_method text NOT NULL");
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE " . DB_PREFIX . $this->db_table . "");
	}
	
	public function checkInstall() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . $this->db_table . "` (
			`rate_id` int(11) NOT NULL AUTO_INCREMENT,
			`description` text NOT NULL,
			`status` tinyint(1) NOT NULL DEFAULT 0,
			`image` text NOT NULL,
			`image_width` int(3) NOT NULL,
			`image_height` int(3) NOT NULL,
			`name` text NOT NULL,
			`instruction` text NOT NULL,
			`group` varchar(3) NOT NULL,
			`multirate` tinyint(1) NOT NULL,
			`sort_order` int(3) NOT NULL,
			`tax_class_id` int(11) NOT NULL,
			`total_type` tinyint(1) NOT NULL,
			`currency` varchar(10) NOT NULL,
			`days` text NOT NULL,
			`time` text NOT NULL,
			`date` text NOT NULL,
			`stores` text NOT NULL,
			`customer_groups` text NOT NULL,
			`geo_zones` text NOT NULL,
			`currencies` text NOT NULL,
			`postcode_type` tinyint(1) NOT NULL,
			`postcode_method` tinyint(1) NOT NULL,
			`postcode_ranges` longtext NOT NULL,
			`cart_quantity` text NOT NULL,
			`cart_total` text NOT NULL,
			`cart_weight` text NOT NULL,
			`cart_volume` text NOT NULL,
			`cart_distance` text NOT NULL,
			`cart_length` text NOT NULL,
			`cart_width` text NOT NULL,
			`cart_height` text NOT NULL,
			`product_length` text NOT NULL,
			`product_width` text NOT NULL,
			`product_height` text NOT NULL,
			`category_match` int(11) NOT NULL,
			`category_cost` int(11) NOT NULL,
			`categories` text NOT NULL,
			`rate_type` tinyint(1) NOT NULL,
			`final_cost` tinyint(1) NOT NULL,
			`split` tinyint(1) NOT NULL,
			`shipping_factor` decimal(15,3) NOT NULL,
			`origin` text NOT NULL,
			`geocode_lat` decimal(20,8) NOT NULL,
			`geocode_lng` decimal(20,8) NOT NULL,
			`rates` text NOT NULL,
			`cost` text NOT NULL,
			`freight_fee` varchar(15) NOT NULL,
			`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			`administrator` varchar(50) NOT NULL,
			PRIMARY KEY (`rate_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
	}
	
	public function checkUpdates() {
		$status 		= false;
		$log 			= 'Success: The following updates have been completed:<br />';
		$custom_table	= $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . $this->db_table. "`");
		$custom_columns	= array();
		foreach ($custom_table->rows as $result) { 
		  $custom_columns[] = $result['Field']; 
		}
		
		$order_table	= $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order`");
		$order_columns	= array();
		foreach ($order_table->rows as $result) { 
		  $order_columns[$result['Field']] = $result; 
		}
		
		if ($custom_columns) {
			//v1.5.0
			if (!in_array('instruction', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `instruction` TEXT NOT NULL AFTER name");
				$status	= true;
				$log   .= '[v1.5.0] Instruction column added<br />';
			}
			
			//v1.7.0
			if (!in_array('split', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `split` TINYINT(1) NOT NULL AFTER final_cost");
				$status	= true;
				$log   .= '[v1.7.0] Split column added<br />';
			}
			
			//v1.9.0
			if (!in_array('image', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image` TEXT NOT NULL AFTER status");
				$status	= true;
				$log   .= '[v1.9.0] Image column added<br />';
			}
			if (in_array('customer_address', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN customer_address");
				$status	= true;
				$log   .= '[v1.9.0] Customer_Address column removed<br />';
			}
			if (in_array('payment_methods', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN payment_methods");
				$status	= true;
				$log   .= '[v1.9.0] Payment_Methods column removed<br />';
			}
			if (in_array('shipping_methods', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN shipping_methods");
				$status	= true;
				$log   .= '[v1.9.0] Shipping_Methods column removed<br />';
			}
			if (in_array('exclusions', $custom_columns)) {
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
			if (!in_array('group', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `group` VARCHAR(3) NOT NULL AFTER instruction");
				$status	= true;
				$log   .= '[v2.2.0] Group column added<br />';
			}
			
			//v3.0.0
			if (!in_array('date_added', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `date_added` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER freight_fee");
				$status	= true;
				$log   .= '[v3.0.0] Date_Added column added<br />';
			}
			if (!in_array('date_modified', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `date_modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER date_added");
				$status	= true;
				$log   .= '[v3.0.0] Date_Modified column added<br />';
			}
			if (!in_array('administrator', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `administrator` VARCHAR(50) NOT NULL AFTER date_modified");
				$status	= true;
				$log   .= '[v3.0.0] Date_Modified column added<br />';
			}
			
			//v3.4.0
			if (!in_array('cart_distance', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `cart_distance` TEXT NOT NULL AFTER cart_volume");
								
				$cart_distance_value = array('min'=>'', 'max'=>'', 'add'=>'');
				$value = serialize($cart_distance_value);
				$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `cart_distance` = '" . $this->db->escape($value) . "' WHERE 1");
				
				$status	= true;
				$log   .= '[v3.4.0] Cart_Distance column added<br />';
			}
			if (!in_array('geocode_lat', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `geocode_lat` DECIMAL(20,8) NOT NULL AFTER shipping_factor");
				$status	= true;
				$log   .= '[v3.4.0] GeoCode_Lat column added<br />';
			}
			if (!in_array('geocode_lng', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `geocode_lng` DECIMAL(20,8) NOT NULL AFTER geocode_lat");
				$status	= true;
				$log   .= '[v3.4.0] GeoCode_Lng column added<br />';
			}
			
			//v3.5.0
			if (in_array('postal_code', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN `postal_code`");
				$status	= true;
				$log   .= '[v3.5.0] Postal_Code column removed<br />';
			} elseif (!in_array('origin', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `origin` TEXT NOT NULL AFTER shipping_factor");
				$status	= true;
				$log   .= '[v3.5.0] Origin column added<br />';
			}
			if (in_array('geocode_key', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` DROP COLUMN geocode_key");
				$status	= true;
				$log   .= '[v3.5.0] GeoCode_Key column removed<br />';
			}
			
			//v4.1.0
			if (!in_array('image_width', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image_width` INT(3) NOT NULL AFTER image");
				$status	= true;
				$log   .= '[v4.1.0] Image_Width column added<br />';
			}
			if (!in_array('image_height', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `image_height` INT(3) NOT NULL AFTER image_width");
				$status	= true;
				$log   .= '[v4.1.0] Image_Height column added<br />';
			}
			
			//v4.2.0
			if (!in_array('currency', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `currency` VARCHAR(15) NOT NULL AFTER total_type");
				$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `currency` = '" . $this->db->escape($this->config->get('config_currency')) . "' WHERE 1");
				$status	= true;
				$log   .= '[v4.2.0] Currency column added<br />';
				$log   .= '[v4.2.0] All rates set to default currency<br />';
			}
			
			//v4.3.0
			if (!in_array('currencies', $custom_columns)) {
				$this->db->query("ALTER TABLE `" . DB_PREFIX . $this->db_table . "` ADD `currencies` TEXT NOT NULL AFTER geo_zones");
				$this->load->model('localisation/currency');
				$this->db->query("UPDATE `" . DB_PREFIX . $this->db_table . "` SET `currencies` = '" . $this->db->escape(serialize(array('0'))) . "' WHERE 1");
				$status	= true;
				$log   .= '[v4.3.0] Currencies column added<br />';
				$log   .= '[v4.3.0] All rates populated with All Currencies selected<br />';
			}
		}
		
		return array(
			'status'	=> $status,
			'log'		=> $log
		);
	}
	
	public function saveGeneralSettings() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				$this->load->model('setting/setting');
				$json = array();
				$post_data = $this->request->post;
				if ($this->getVersion() <= 150) {
					foreach ($post_data as $key => $value) {
						if (is_array($value)) {
							$post_data[$key] = serialize($value);
						}
					}
				}
				$this->model_setting_setting->editSetting($this->extension, $post_data);	
				$json['success'] = $this->language->get('text_success_general_save');
			} else {
				$json['error'] = $this->language->get('error_post');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	public function addRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$rate_id 	= $this->model_oca_ocaaspro->addRate($this->getDefaultSettings());
			$rate_info	= $this->model_oca_ocaaspro->getRate($rate_id);
			if ($rate_info) {
				$data = array();
				foreach ($rate_info as $key => $value) {
					$data[$key] = $this->getField($value);
				}
					
				$html = $this->getTemplate($rate_id, $data);
				if ($html) {
					$json['success']		= true;
					$json['rate_id']		= $rate_id;
					$json['description']	= $data['description'];
					$json['html'] 			= $html;
				} else {
					$json['error'] = $this->language->get('error_rate_template');
				}
			} else {
				$json['error'] = $this->language->get('error_rate_copy');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->cache->delete($this->type . $this->extension);
		$this->response->setOutput(json_encode($json));
	}
	
	public function deleteRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$rate_id = isset($this->request->get['rate_id']) ? $this->request->get['rate_id'] : 0;
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$this->model_oca_ocaaspro->deleteRate($rate_id);
			$json['success'] = true;
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->cache->delete($this->type . $this->extension);
		$this->response->setOutput(json_encode($json));
	}
	
	public function deleteAllRates() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$this->model_oca_ocaaspro->deleteAllRates();
			$json['success'] = true;
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->cache->delete($this->type . $this->extension);
		$this->response->setOutput(json_encode($json));
	}
	
	public function saveRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$rate_id 			= isset($this->request->post['rate_id']) ? $this->request->post['rate_id'] : 0;
		$json['rate_id']	= $rate_id;
		$this->load->language($this->type . '/' . $this->extension);
		if ($this->validate()) {
			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				$data = $this->request->post;
				$rate_errors = $this->validateRate($data);
				if (!$rate_errors) {
					if ($data['rate_type'] == 5 && $data['origin']) {
						$geocode = $this->getGeoCode($data['origin']);
						$data['geocode_lat'] = $geocode['lat'];
						$data['geocode_lng'] = $geocode['lng'];
					}
					$this->load->model('oca/' . $this->extension);
					$this->model_oca_ocaaspro->editRate($rate_id, $data);
					$json['success'] 		= true;
					$json['description']	= substr($data['description'], 0, 100);
				} else {
					foreach ($rate_errors as $key => $value) {
						$json['error'][$key] = $value;
					}
				}
			} else {
				$json['error']['general'] = $this->language->get('error_post');
			}
		} else {
			$json['error']['general'] = $this->language->get('error_permission');
		}
		$this->cache->delete($this->type . $this->extension);
		$this->response->setOutput(json_encode($json));	
	}
	
	public function copyRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$rate_id = isset($this->request->get['rate_id']) ? $this->request->get['rate_id'] : 0;
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$rate_info = $this->model_oca_ocaaspro->copyRate($rate_id);
			
			if ($rate_info) {
				$data = array();
				foreach ($rate_info as $key => $value) {
					$data[$key] = $this->getField($value);
				}
					
				$html = $this->getTemplate($data['rate_id'], $data);
				if ($html) {
					$json['success'] 		= true;
					$json['rate_id']		= $data['rate_id'];
					$json['description']	= $data['description'];
					$json['html'] 			= $html;
				} else {
					$json['error'] = $this->language->get('error_rate_template');
				}
			} else {
				$json['error'] = $this->language->get('error_rate_get');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->cache->delete($this->type . $this->extension);
		$this->response->setOutput(json_encode($json));
	}
	
	public function loadRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$rate_id = isset($this->request->get['rate_id']) ? $this->request->get['rate_id'] : 0;
		$this->load->model('oca/' . $this->extension);
		$rate_info = $this->model_oca_ocaaspro->getRate($rate_id);
		
		if ($rate_info) {
			$data = array();
			foreach ($rate_info as $key => $value) {
				$data[$key] = $this->getField($value);
			}
				
			$html = $this->getTemplate($rate_id, $data);
			if ($html) {
				$json['success'] 		= true;
				$json['rate_id']		= $rate_id;
				$json['description']	= $data['description'];
				$json['html'] 			= $html;
			} else {
				$json['error'] = $this->language->get('error_rate_template');
			}
		} else {
			$json['error'] = $this->language->get('error_rate_get');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	public function closeRate() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$rate_id = isset($this->request->get['rate_id']) ? $this->request->get['rate_id'] : 0;
		$this->load->model('oca/' . $this->extension);
		$rate_info = $this->model_oca_ocaaspro->getRate($rate_id);
		
		if ($rate_info) {
			$data = array();
			foreach ($rate_info as $key => $value) {
				$data[$key] = $this->getField($value);
			}
				
			$html = $this->getTemplate($rate_id, $data);
			if ($html) {
				$json['success'] 		= true;
				$json['rate_id']		= $rate_id;
				$json['description']	= $data['description'];
			} else {
				$json['error'] = $this->language->get('error_rate_template');
			}
		} else {
			$json['error'] = $this->language->get('error_rate_get');
		}
		$this->response->setOutput(json_encode($json));	
	}
	
	private function getTemplate($rate_id, $rate_info) {
		if ($rate_id && $rate_info) {			
			$data = array();
			
			$this->load->language($this->type . '/' . $this->extension);
			$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
			
			$this->load->model('localisation/language');
			$this->load->model('localisation/tax_class');
			$this->load->model('localisation/currency');
			$this->load->model('setting/store');
			$this->load->model('sale/customer_group');
			$this->load->model('localisation/geo_zone');
			$this->load->model('catalog/category');
			$this->load->model('tool/image');
			
			$data['version']				= $this->getVersion();
			$data['image_status']			= $this->statusImage;
			$data['instruction_status']		= $this->statusInstruction;
			
			$data['img_base_path'] = '';
			
			//MijoShop Support
			if (defined('JPATH_MIJOSHOP_ADMIN')) {
				$data['img_base_path'] = MijoShop::getClass()->getFullUrl() . 'components/com_mijoshop/opencart/admin/';
			//AceShop Support
			} elseif (defined('JPATH_ACESHOP_ADMI')) {
				$data['img_base_path'] = AceShop::getClass()->getFullUrl() . 'components/com_aceshop/opencart/admin/';
			}
			
			if ($this->getVersion() >= 200) {
				$data['link_store'] 			= $this->getLink('setting', 'store/add');
				$data['link_geo_zone'] 			= $this->getLink('localisation', 'geo_zone/add');
				$data['link_currency'] 			= $this->getLink('localisation', 'currency/add');
				$data['link_customer_group'] 	= $this->getLink('sale', 'customer_group/add');
				$data['link_category'] 			= $this->getLink('catalog', 'category/add');		
			} else {
				$data['link_store'] 			= $this->getLink('setting', 'store/insert');
				$data['link_geo_zone'] 			= $this->getLink('localisation', 'geo_zone/insert');
				$data['link_currency'] 			= $this->getLink('localisation', 'currency/insert');
				$data['link_customer_group'] 	= $this->getLink('sale', 'customer_group/insert');
				$data['link_category'] 			= $this->getLink('catalog', 'category/insert');		
			}
			
			$options = array('total_types', 'rate_types', 'multirates', 'cost_settings', 'category_settings', 'final_costs', 'postal_code_types', 'days');
			foreach ($options as $option) {
				$x = 0;
				$data[$option] = array();
				while (isset($data[$option . '_' . $x])) {
					$data[$option][] = array(
						'id'	=> $x,
						'name'	=> $data[$option . '_' . $x]
					);
					$x++;
				}
			}
			
			$data['default_store']				= $this->config->get('config_name');
			
			$data['languages'] 					= $this->model_localisation_language->getLanguages();
			$data['tax_classes'] 				= $this->model_localisation_tax_class->getTaxClasses();
			$data['currencies'] 				= $this->model_localisation_currency->getCurrencies();
			$data['stores'] 					= $this->model_setting_store->getStores();
			$data['customer_groups'] 			= $this->model_sale_customer_group->getCustomerGroups();
			$data['geo_zones'] 					= $this->model_localisation_geo_zone->getGeoZones();
			$data['categories'] 				= $this->model_catalog_category->getCategories(0);
			
			foreach ($rate_info as $key => $value) {
				$data['data'][$key] = $this->getField($value);
			}			
			
			$data['rate_id'] 					= $rate_id;
				
			$data['entry_weight'] 				= sprintf($data['entry_weight'], $this->getWeight());
			$data['entry_shipping_factor'] 		= sprintf($data['entry_shipping_factor'], $this->getLength(), $this->getWeight());
			$data['entry_volume'] 				= sprintf($data['entry_volume'], $this->getLength());
			$data['entry_length'] 				= sprintf($data['entry_length'], $this->getLength());
			$data['entry_width'] 				= sprintf($data['entry_width'], $this->getLength());
			$data['entry_height'] 				= sprintf($data['entry_height'], $this->getLength());
			$data['entry_quantity']				= sprintf($data['entry_quantity'], '#');
			$data['entry_total'] 				= sprintf($data['entry_total'], $this->getCurrency($rate_info['currency']));
			
			if ($this->getVersion() >= 200) {
				$no_image = 'no_image.png';
			} else {
				$no_image = 'no_image.jpg';
			}
			
			if ($data['data']['image'] && file_exists(DIR_IMAGE . $data['data']['image'])) {
				$data['thumb'] 	= $this->model_tool_image->resize($data['data']['image'], 100, 100);
			} else {
				$data['thumb'] 	= $this->model_tool_image->resize($no_image, 100, 100);
			}
			$data['no_image'] 	= $this->model_tool_image->resize($no_image, 100, 100);
			
			$data['footer'] = sprintf($data['text_rate_footer'], $data['data']['rate_id'], date($data['date_format_short'], strtotime($data['data']['date_added'])), date($data['date_format_short'], strtotime($data['data']['date_modified'])), $data['data']['administrator']);
			
			if ($this->getVersion() >= 200) {
				$html = $this->load->view($this->type . '/' . $this->extension . '_rate.tpl', $data);
			} else {
				$template = new Template();
				$template->data = array_merge($template->data, $data);
				$html = $template->fetch($this->type . '/' . $this->extension . '_rate.tpl');
			}
			
			return $html;
		} else {
			return false;
		}
	}
	
	private function getWeight() {
		$this->load->model('localisation/weight_class');
		if ($this->config->get('config_weight_class_id')) {
			$weight_class = $this->model_localisation_weight_class->getWeightClass($this->config->get('config_weight_class_id'));
			$weight_units = isset($weight_class['unit']) ? $weight_class['unit'] : $this->config->get('config_weight_class_id');
		} else {
			$weight_class = $this->model_localisation_weight_class->getWeightClass($this->config->get('config_weight_class'));
			$weight_units = isset($weight_class['unit']) ? $weight_class['unit'] : $this->config->get('config_weight_class');
		}
		return $weight_units;
	}
	
	private function getLength() {
		$this->load->model('localisation/length_class');
		if ($this->config->get('config_length_class_id')) {
			$length_class = $this->model_localisation_length_class->getLengthClass($this->config->get('config_length_class_id')); 
			$length_units = isset($length_class['unit']) ? $length_class['unit'] : $this->config->get('config_length_class_id');
		} else { 
			$length_class = $this->model_localisation_length_class->getLengthClass($this->config->get('config_length_class'));
			$length_units = isset($length_class['unit']) ? $length_class['unit'] : $this->config->get('config_length_class');
		}
		return $length_units;
	}
	
	private function getCurrency($currency) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE code = '" . $this->db->escape($currency) . "'");
		$currency_symbol = !empty($query->row['symbol_left']) ? $query->row['symbol_left'] : $query->row['symbol_right'];
		return $currency_symbol;
	}
	
	private function validateRate($value) {		
		$rate_errors = array();
		
		$postcode_formulas 	= array();
		$postcode_formulas[] = '/^([0-9a-zA-Z]+)$/';
		$postcode_formulas[] = '/^([0-9a-zA-Z]+):([0-9a-zA-Z]+)$/';
		
		$uk_formats	= array();		
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{2}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{3}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{2}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2})$/';
		
		$rate_formulas 	= array();
		$rate_formulas[] = '/^([0-9.]+|~):([0-9.%]+)$/';
		$rate_formulas[] = '/^([0-9.]+|~):([0-9.%]+)\+([0-9.%]+)$/';
		$rate_formulas[] = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)$/';
		$rate_formulas[] = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)\+([0-9.%]+)$/';
				
		if (!isset($value['days'])) {
			$rate_errors['days'] = sprintf($this->language->get('error_rate_days'));
		}
		if (!isset($value['stores'])) {
			$rate_errors['stores'] = sprintf($this->language->get('error_rate_stores'));
		}
		if (!isset($value['customer_groups'])) {
			$rate_errors['customer_groups'] = sprintf($this->language->get('error_rate_customer_groups'));
		}
		if (!isset($value['geo_zones'])) {
			$rate_errors['geo_zones'] = sprintf($this->language->get('error_rate_geo_zones'));
		}
		if (!isset($value['currencies'])) {
			$rate_errors['currencies'] = sprintf($this->language->get('error_rate_currencies'));
		}
		if (!isset($value['categories'])) {
			$rate_errors['categories'] = sprintf($this->language->get('error_rate_categories'));
		}
		if ($value['rate_type'] == 4 && !$value['shipping_factor']) {
			$rate_errors['shipping_factor'] = sprintf($this->language->get('error_rate_shipping_factor'));
		}
		if ($value['rate_type'] == 5 && !$value['origin']) {
			$rate_errors['origin'] = sprintf($this->language->get('error_rate_origin'));
		}
		if ($value['postcode_ranges']) {
			$postcode_ranges = explode(',', $value['postcode_ranges']);
			foreach ($postcode_ranges as $postcode_range) {
				$postcode_range_status = false;
				$postcode_range = trim($postcode_range);
				foreach ($postcode_formulas as $formula) {
					if (preg_match($formula, $postcode_range)) {
						$postcode_range_status = true;
						if ($value['postcode_type'] == 0) {
							$postcode_status = false;
							$postcodes = explode(':', $postcode_range);
							$postcodes[0] = trim($postcodes[0]);
							foreach ($uk_formats as $format) {
								if (preg_match($format, $postcodes[0])) {
									$postcode_status = true;
								}
							}
							if (!$postcode_status) {
								$rate_errors['postcode'] = sprintf($this->language->get('error_rate_postcode_formatting'), $postcodes[0]);
								break;
							} else {
								$postcode_status = false;
								$postcodes[1] = trim($postcodes[1]);
								foreach ($uk_formats as $format) {
									if (preg_match($format, $postcodes[1])) {
										$postcode_status = true;
									}
								}
								if (!$postcode_status) {
									$rate_errors['postcode'] = sprintf($this->language->get('error_rate_postcode_formatting'), $postcodes[1]);
									break;
								}
							}
						}
					}
				}
				if (!$postcode_range_status) {
					$rate_errors['postcode_ranges'] = sprintf($this->language->get('error_rate_postcode_range_formatting'), $postcode_range);
					break;
				}
			}
		}
		if (!$value['rates']) {
			$rate_errors['rates'] = sprintf($this->language->get('error_rate_rates'));
		} else {
			$rates = explode(',', $value['rates']);
			foreach ($rates as $rate) {
				$rate_status = false;
				$rate = trim($rate);
				foreach ($rate_formulas as $formula) {
					if (preg_match($formula, $rate)) {
						$rate_status = true;
					}
				}
				if (!$rate_status) {
					$rate_errors['rates'] = sprintf($this->language->get('error_rate_rates_formatting'), $rate);
					break;
				}
			}
		}
		return $rate_errors;	
	}
	
	private function getDefaultSettings() {
		$this->load->model('localisation/language');
		$this->load->model('setting/store');
		$this->load->model('sale/customer_group');
		$this->load->model('localisation/geo_zone');
		$this->load->model('catalog/category');
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$this->load->model('oca/' . $this->extension);
		$data = $this->model_oca_ocaaspro->getFields();
		
		$data['description'] = $this->language->get('text_name');
		
		foreach ($this->model_setting_store->getStores() as $store) {
			$data['stores'][] = (int)$store['store_id'];
		}
		
		foreach ($this->model_sale_customer_group->getCustomerGroups() as $customer_group) {
			$data['customer_groups'][] = (int)$customer_group['customer_group_id'];
		}
		
		foreach ($this->model_localisation_geo_zone->getGeoZones() as $geo_zone) {
			$data['geo_zones'][] = (int)$geo_zone['geo_zone_id'];
		}
		
		foreach ($this->model_localisation_language->getLanguages() as $language) {
			$data['name'][$language['code']] = $this->language->get('text_name');
		}
		
		foreach ($this->model_localisation_language->getLanguages() as $language) {
			$data['instruction'][$language['code']] = '';
		}
		
		return $data;
	}
	
	private function getCSVInfo() {
		$instructions 	= array();
		$instructions[] = 'DO NOT ADD OR REMOVE ANY COLUMNS. ADDING OR REMOVING COLUMNS MAY PREVENT RATES FROM IMPORTING CORRECTLY!';
		$instructions[] = 'SEPARATE RATE NAMES BY LANGUAGE CODE USING "|".';
		$instructions[] = 'VALUES FOR FIELDS MARKED WITH [start|end] OR [min|max|add] MUST BE SEPARATED USING "|".';
		
		$row_offset 	= 3;
		$col_offset 	= 0;
		
		$fields 		= array();
		$this->load->model('oca/' . $this->extension);
		$data = $this->model_oca_ocaaspro->getFields();
		foreach ($data as $key => $value) {
			$fields[] = $key;
		}
		
		$suffix = $this->getCSVSuffix();
		
		$modify_headers = array(
			'name'				=> $suffix['language'],
			'instruction'		=> $suffix['language'],
			'days'				=> $suffix['array'],
			'time'				=> $suffix['startend'],
			'date'				=> $suffix['startend'],
			'stores'			=> $suffix['array'],
			'customer_groups' 	=> $suffix['array'],
			'geo_zones'			=> $suffix['array'],
			'currencies'		=> $suffix['array'],
			'cart_quantity'		=> $suffix['minmaxadd'],
			'cart_total'		=> $suffix['minmaxadd'],
			'cart_weight'		=> $suffix['minmaxadd'],
			'cart_volume'		=> $suffix['minmaxadd'],
			'cart_distance'		=> $suffix['minmaxadd'],
			'cart_length'		=> $suffix['minmaxadd'],
			'cart_width'		=> $suffix['minmaxadd'],
			'cart_height'		=> $suffix['minmaxadd'],
			'product_length'	=> $suffix['minmaxadd'],
			'product_width'		=> $suffix['minmaxadd'],
			'product_height'	=> $suffix['minmaxadd'],
			'categories'		=> $suffix['array'],
			'cost'				=> $suffix['minmaxadd']
		);
		
		$headers = array();	
		foreach ($fields as $field) {
			$headers[] = isset($modify_headers[$field]) ? $field . ' ' . $modify_headers[$field] : $field;
		}
		
		return array(
			'instructions'	=> $instructions,
			'headers'		=> $headers,
			'fields'		=> $fields,
			'row_offset'	=> $row_offset,
			'col_offset'	=> $col_offset,
		);
	}
	
	private function getCSVSuffix() {
		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		
		$x = 1;
		$text_language = '[';
		foreach ($languages as $language) {
			$text_language .= ($x > 1) ? '|' . $language['code'] : $language['code'];
			$x++;
		}
		$text_language .= ']';
		
		$text_array	= '[array]';
		$text_startend	= '[start|end]';
		$text_minmaxadd	= '[min|max|add]';
		
		return array(
			'language'	=> $text_language,
			'array'		=> $text_array,
			'startend'	=> $text_startend,
			'minmaxadd'	=> $text_minmaxadd
		);
	}
	
	public function importRates($file) {
		if ($this->validate() && $file) {
			$this->load->model('oca/' . $this->extension);
			
			$this->load->language($this->type . '/' . $this->extension);
			
			$changes = array(
				'added'		=> 0,
				'updated'	=> 0
			);
			
			$csv_info 	= $this->getCSVInfo();
			$csv_suffix	= $this->getCSVSuffix();
			
			$row = 0;
			if (($handle = fopen($file, "r")) !== false) {			
				while (($data = fgetcsv($handle, 4000, ",")) !== false) {
					if ($row > $csv_info['row_offset']) {
						$col = $csv_info['col_offset'];
						foreach ($fields as $field) {
							if (strpos($field, 'name') !== false || strpos($field, 'instruction') !== false) {
								$values = explode('|', $data[$col++]);
								$key	= explode('[', $field);
								$key	= trim($key[0]);
								$x = 0;
								foreach ($language_codes as $language_code) {
									$rate_info[$key][$language_code] = isset($values[$x]) ? $values[$x] : '';
									$x++;
								}
							} elseif (strpos($field, $csv_suffix['array']) !== false) {
								$value = $data[$col++];
								$values = (strpos($value, '|') !== false) ? explode('|', $value) : array($value);
								$key	= explode('[', $field);
								$key	= trim($key[0]);
								$rate_info[$key] = $values;
							} elseif (strpos($field, $csv_suffix['startend']) !== false) {
								$values = explode('|', $data[$col++]);
								$key	= explode('[', $field);
								$key	= trim($key[0]);
								$rate_info[$key]['start'] 	= isset($values[0]) ? $values[0] : '';
								$rate_info[$key]['end'] 	= isset($values[1]) ? $values[1] : '';
							} elseif (strpos($field, $csv_suffix['minmaxadd']) !== false) {
								$values = explode('|', $data[$col++]);
								$key	= explode('[', $field);
								$key	= trim($key[0]);
								$rate_info[$key]['min'] 	= isset($values[0]) ? $values[0] : '';
								$rate_info[$key]['max'] 	= isset($values[1]) ? $values[1] : '';
								$rate_info[$key]['add'] 	= isset($values[2]) ? $values[2] : '';
							} else {
								$value 	= $data[$col++];
								$key	= trim($field);
								$rate_info[$key] = (strpos($value, '|') !== false) ? explode('|', $value) : $value;
							}
						}
						
						foreach ($this->getDefaultSettings() as $key => $value) {
							$rate_info[$key] = isset($rate_info[$key]) ? $rate_info[$key] : $value;
						}
						
						if ($rate_info['rate_id'] && $this->model_oca_ocaaspro->getRate($rate_info['rate_id'])) {
							$this->model_oca_ocaaspro->editRate($rate_info['rate_id'], $rate_info);
							$changes['updated']++;
						} else {
							$this->model_oca_ocaaspro->addRate($rate_info);
							$changes['added']++;
						}
						
						$row++;	
					} elseif ($row == $csv_info['row_offset']) {
						$fields = array();
						$fields = array_merge($data);
						
						foreach ($fields as $field) {
							if (strpos($field, 'name') !== false || strpos($field, 'instruction') !== false) {
								preg_match('/\[([A-Za-z0-9\|]+)\]/', $field, $language_codes);
								$language_codes = str_replace(array('[',']'), '', $language_codes);
								if (isset($language_codes[0])) {
									$language_codes = explode('|', $language_codes[0]);
									break;
								}
							}
						}
						
						$row++;	
					} else {
						$row++;
					}
				}
			}
			$this->session->data['success'] = sprintf($this->language->get('success_import'), $changes['added'], $changes['updated']);
		}
	}
	
	public function exportRates() {
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$rates = $this->model_oca_ocaaspro->getRates();
			
			if ($rates) {
				$this->response->addheader('Pragma: public');
				$this->response->addheader('Expires: 0');
				$this->response->addheader('Content-Description: File Transfer');
				$this->response->addheader('Content-Type: text/csv');
				$this->response->addheader('Content-Disposition: attachment; filename=' . date('Y-m-d_H-i-s', time()).'_' . $this->extension . '.csv');
				$this->response->addheader('Content-Transfer-Encoding: binary');
				
				$csv_info = $this->getCSVInfo();
				
				$output = '';
				
				foreach ($csv_info['instructions'] as $instruction) {
					$output .= '"' . str_replace('"', '""', $instruction) . '"';
					$output .= "\n";
				}
				
				$x = 1;
				foreach ($csv_info['headers'] as $header) {
					$output	.= ($x > 1) ? ',"' . str_replace('"', '""', $header) . '"' : '"' . str_replace('"', '""', $header) . '"';
					$x++;
				}
				$output .= "\n";
			
				foreach ($rates as $rate) {
					$rate_info = $this->model_oca_ocaaspro->getRate($rate['rate_id']);
					
					foreach ($rate_info as $key => $value) {
						$field_value = str_replace(array("\r", "\n"), "", $this->getField($value));
						$data[$key] = (is_array($field_value)) ? implode('|', $field_value) : $field_value;
					}
					
					if ($rate_info) {
						$x = 1;
						foreach ($csv_info['fields'] as $field) {
							$output	.= ($x > 1) ? ',"' . str_replace('"', '""', $data[$field]) . '"' : '"' . str_replace('"', '""', $data[$field]) . '"';
							$x++;
						}
						$output .= "\n";
					}
				}
				
				$this->response->setOutput($output);	
			}
		}
	}
	
	public function downloadDebug() {
		if ($this->validate()) {
			$file = DIR_LOGS . $this->extension . '.txt';
		
			if (file_exists($file)) {
				$this->response->addheader('Pragma: public');
				$this->response->addheader('Expires: 0');
				$this->response->addheader('Content-Description: File Transfer');
				$this->response->addheader('Content-Type: text/csv');
				$this->response->addheader('Content-Disposition: attachment; filename=' . $this->extension . '.txt');
				$this->response->addheader('Content-Transfer-Encoding: binary');
				$output = file_get_contents($file);
				if (!$output) {
					$output = 'Debug Log Is Empty';
				}
				$this->response->setOutput($output);	
			}
		}
	}
	
	public function clearDebug() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			$file = DIR_LOGS . $this->extension . '.txt';
			file_put_contents($file, '');
			$json['success'] = $this->language->get('success_clear');
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	public function submitSupportRequest() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate() && isset($this->request->post)) {
			if ($this->request->post['email'] && $this->request->post['order_id'] && $this->request->post['description']) {
				$text  = "Extension: " . $this->language->get('text_name') . "\n";
				$text .= "Website: " . HTTP_CATALOG . "\n";
				$text .= "Email: " . $this->request->post['email'] . "\n";
				$text .= "Order ID: " . $this->request->post['order_id'] . "\n";
				$text .= "\n";
				$text .= "Support Question: \n";
				$text .= $this->request->post['description'];
								
				$mail = new Mail(); 
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->hostname = $this->config->get('config_smtp_host');
				$mail->username = $this->config->get('config_smtp_username');
				$mail->password = $this->config->get('config_smtp_password');
				$mail->port = $this->config->get('config_smtp_port');
				$mail->timeout = $this->config->get('config_smtp_timeout');			
				$mail->setFrom($this->request->post['email']);
				$mail->setSender($this->config->get('config_name'));
				$mail->setSubject($this->language->get('text_name') . ' Support Request');
				$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
				$mail->setTo($this->email);
				$mail->send();
			
				$json['success'] = $this->language->get('modal_support_success');
			} else {
				$json['error'] = $this->language->get('modal_support_error');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	private function getGeoCode($origin) {
		$url = 'https://maps.googleapis.com/maps/api/geocode/xml?address=' . $origin . '&sensor=false';
		$response = simplexml_load_file($url);
		if ($response->status == 'OK') {
			return array(
				'lat'	=> $response->result->geometry->location->lat,
				'lng'	=> $response->result->geometry->location->lng
			);
		} else {
			return false;
		}
	}
	
	private function validate() {		
		if (!$this->user->hasPermission('modify', $this->type . '/' . $this->extension)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	private $img_logo	= 'oca_pro_logo.png';
	private $icon_logo	= 'oca_icon_pro_logo.png';
	
	private $statusImage		= true;
	private $statusInstruction	= true;
}
?>