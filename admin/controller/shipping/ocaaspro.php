<?php
//==============================================//
// Product:	Advanced Shipping PRO              	//
// Author: 	Joel Reeds                        	//
// Company: OpenCart Addons                  	//
// Website: http://opencartaddons.com        	//
// Contact: http://opencartaddons.com/contact  	//
//==============================================//

class ControllerShippingOCAASPRO extends Controller { 
	private $error 						= array();
	private $version 					= '6.0.5';
	private $extension 					= 'ocaaspro';
	private $type 						= 'shipping';
	private $db_table					= 'advanced_shipping_pro';
	private $email						= 'contact@#.com';
	private $href_oca					= 'http://#';
	private $href_oc					= 'http://#';
	private $href_med					= 'http://#';
	private $href_facebook				= 'https://www.facebook.com/#';
	private $href_twitter				= 'https://twitter.com/#';
		
	public function index() { 
		$this->load->model('oca/' . $this->extension);
		
		$update = $this->{'model_oca_' . $this->extension}->update();
		if ($update['status']) {
			$this->session->data['success'] = $update['log'];
			if ($this->version() >= 200) {
				$this->response->redirect($this->link($this->type, $this->extension));
			} else {
				$this->redirect($this->link($this->type, $this->extension));
			}
		}
		
		$this->load->model('localisation/language');	
		
		$data = array();
		$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
		
		$this->buildRequirements();
		
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
		$data['icon_name'] 		= $this->icon_name;
		
		$data['extension'] 		= $this->extension;
		$data['type'] 			= $this->type;
		$data['version'] 		= $this->version();
			
		$data['text_footer'] 	= sprintf($data['text_footer'], $this->version);
		
		$data['href_oca']		= $this->href_oca;
		$data['href_oc']		= $this->href_oc;
		$data['href_med']		= $this->href_med;
		$data['href_facebook']	= $this->href_facebook;
		$data['href_twitter']	= $this->href_twitter;
		
		$data['demo'] 			= (isset($this->request->server['HTTP_HOST']) && $this->request->server['HTTP_HOST'] == 'demo.opencartaddons.com') ? $this->href_oca : false;
		
		$data['debug_download']		= $this->link($this->type, $this->extension . '/downloadDebug&format=raw');
		$data['debug_clear']		= $this->link($this->type, $this->extension . '/clearDebug&format=raw');
		$data['debug_reload']		= $this->link($this->type, $this->extension . '/reloadDebug&format=raw');
		$data['debug_log'] 			= '';
		
		$debug_file = DIR_LOGS . $this->extension . '.txt';
		if (file_exists($debug_file)) {
			$debug_file_size = filesize($debug_file);
			if ($debug_file_size >= 5242880) {
				$suffix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
				$i = 0;
				while (($debug_file_size / 1024) > 1) {
					$debug_file_size = $debug_file_size / 1024;
					$i++;
				}
				$data['error_warning'] = sprintf($this->language->get('debug_error_warning'), basename($debug_file), round(substr($debug_file_size, 0, strpos($debug_file_size, '.') + 4), 2) . $suffix[$i]);
			} else {
				$data['debug_log'] = file_get_contents($debug_file, FILE_USE_INCLUDE_PATH, null);
			}
		}
		
		$data['rate_import']	= $this->link($this->type, $this->extension);
		$data['rate_export']	= $this->link($this->type, $this->extension . '/export&format=raw');
		
		if (isset($this->request->files[$this->extension . '_import']) && is_uploaded_file($this->request->files[$this->extension . '_import']['tmp_name'])) {
			$this->import($this->request->files[$this->extension . '_import']['tmp_name']);
		} elseif (isset($this->request->post[$this->extension . '_export'])) {
			$this->export();
		}
		
		$data['success']		= isset($this->session->data['success']) ? $this->session->data['success'] : '';
		$data['error_warning'] 	= isset($this->error['warning']) ? $this->error['warning'] : '';
		$data['rate_errors'] 	= isset($this->session->data['rate_errors']) ? $this->session->data['rate_errors'] : array();
		
		unset($this->session->data['success']);
		unset($this->session->data['rate_errors']);
		
  		$fields = array('status', 'title', 'sort_order', 'ocapps_status', 'sort_quotes', 'title_display', 'display_value', 'debug', 'tooltip');
		foreach ($fields as $field) {
			$key = $this->extension . '_' . $field;
			$value = isset($this->request->post[$key]) ? $this->request->post[$key] : $this->config->get($key);
			if ($value) {
				$data[$key] = $this->value($value);
			} else {
				$data[$key] = '';
			}
		}
		
		$options = array('sort_quote', 'title_display', 'calculation_method');
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
		
		$data['combinations'] = array();
		$combinations = isset($this->request->post[$this->extension . '_combinations']) ? $this->request->post[$this->extension . '_combinations'] : $this->config->get($this->extension . '_combinations');
		if ($combinations) {
			foreach ($this->value($combinations) as $key => $value) {
				$data['combinations'][$key] = array(
					'key'					=> $key,
					'rate_group'			=> $value['rate_group'],
					'calculation_method'	=> $value['calculation_method'],
				);
			}
		}
		
		$data['requirement_types']	= $this->requirement_settings['types'];
		$data['operations']			= $this->requirement_settings['operations'];
		$data['values']				= $this->requirement_settings['values'];
		$data['parameters']			= $this->requirement_settings['parameters'];
		
		$data['rates']	= array();
		$rates			= $this->{'model_oca_' . $this->extension}->getRates();
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
		$data['action'] 	= $this->link($this->type, $this->extension);
		$data['cancel'] 	= $this->link('extension', $this->type);
		
		$data['ocapps_status'] = $this->ocapps_status;
		
		if ($this->version() >= 200) {
			$this->document->setTitle($data['text_name']);
			$data['header'] 		= $this->load->controller('common/header');
			$data['column_left'] 	= $this->load->controller('common/column_left');
			$data['footer'] 		= $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view($this->type . '/' . $this->extension . '.tpl', $data));
		} else {
			$this->data = array_merge($this->data, $data);
			$this->document->setTitle($this->data['text_name']);
			$this->template 			= $this->type . '/' . $this->extension . '.tpl';
			$this->children 			= array(
				'common/header',
				'common/footer',
			);
			$this->response->setOutput($this->render());
		}
	}
	
	private function buildRequirements() {
		$data = array();
		$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
		
		//Adjust Text Values
		foreach (array('volume', 'length', 'width', 'height') as $param) {
			foreach (array('cart', 'product') as $type) {
				$data['text_requirement_type_' . $type . '_' . $param] = sprintf($data['text_requirement_type_' . $type . '_' . $param], $this->length());
			}
		}
		
		$data['text_requirement_type_cart_weight'] 		= sprintf($data['text_requirement_type_cart_weight'], $this->weight());
		$data['text_requirement_type_cart_dim_weight'] 	= sprintf($data['text_requirement_type_cart_dim_weight'], $this->weight());
		$data['text_requirement_type_product_weight'] 	= sprintf($data['text_requirement_type_product_weight'], $this->weight());
		
		foreach (array('total') as $param) {
			foreach (array('cart', 'product') as $type) {
				$data['text_requirement_type_' . $type . '_' . $param] = sprintf($data['text_requirement_type_' . $type . '_' . $param], $this->currency($this->config->get('currency')));
			}
		}
		
		//Requirements
		$data['requirement_types'] 		= array();
		$requirement_types['cart'] 		= array('quantity', 'total', 'weight', 'volume', 'distance', 'length', 'width', 'height');
		$requirement_types['product'] 	= array('quantity', 'total', 'weight', 'volume', 'length', 'width', 'height', 'name', 'model', 'sku', 'upc', 'ean', 'jan' ,'isbn', 'mpn', 'location', 'stock', 'category', 'manufacturer');
		$requirement_types['customer'] 	= array('name', 'email', 'telephone', 'fax', 'company', 'address', 'city', 'postcode');
		$requirement_types['other']		= array('currency', 'day', 'date', 'time');
		foreach ($requirement_types as $group => $types) {
			foreach ($types as $type) {
				$data['requirement_types'][$group][] = array(
					'id'	=> ($group == 'other' ? '' : $group . '_') . $type,
					'name'	=> $data['text_requirement_type_' . ($group == 'other' ? '' : $group . '_') . $type],
				);
			}
		}
		
		//Operations
		$data['operations'] = array();
		
		//Operations Set - Equal, Not Equal
		$params = array('product_category', 'product_manufacturer', 'customer_postcode', 'currency', 'day');
		foreach ($params as $param) {
			$data['operations'][$param] = array();
			$operators = array('eq', 'neq');
			foreach ($operators as $operator) {
				$data['operations'][$param][] = array(
					'id'	=> $operator,
					'name'	=> $data['text_operator_' . $operator],
				);
			}
		}
		
		//Operations Set - Equal, Not Equal, Contains, Does Not Contain
		$params = array('product_name', 'product_model', 'product_sku', 'product_upc', 'product_ean', 'product_jan', 'product_isbn', 'product_mpn', 'product_location', 'customer_name', 'customer_email', 'customer_telephone', 'customer_fax', 'customer_company', 'customer_address', 'customer_city');
		foreach ($params as $param) {
			$data['operations'][$param] = array();
			$operators = array('eq', 'neq', 'strpos', 'nstrpos');
			foreach ($operators as $operator) {
				$data['operations'][$param][] = array(
					'id'	=> $operator,
					'name'	=> $data['text_operator_' . $operator],
				);
			}
		}
		
		//Operations Set - Equal, Not Equal, Greater Than or Equal, Less Than or Equal, Add, Subtract
		$params = array('cart_quantity', 'cart_total', 'cart_weight', 'cart_volume', 'cart_dim_weight', 'cart_distance', 'product_quantity', 'product_total', 'product_weight', 'product_volume');
		foreach ($params as $param) {
			$data['operations'][$param] = array();
			$operators = array('eq', 'neq', 'gte', 'lte', 'add', 'sub');
			foreach ($operators as $operator) {
				$data['operations'][$param][] = array(
					'id'	=> $operator,
					'name'	=> $data['text_operator_' . $operator],
				);
			}
		}
		
		//Operations Set - Equal, Not Equal, Greater Than or Equal, Less Than or Equal
		$params = array('cart_length', 'cart_width', 'cart_height', 'product_length', 'product_width', 'product_height', 'product_stock', 'date', 'time');
		foreach ($params as $param) {
			$data['operations'][$param] = array();
			$operators = array('eq', 'neq', 'gte', 'lte');
			foreach ($operators as $operator) {
				$data['operations'][$param][] = array(
					'id'	=> $operator,
					'name'	=> $data['text_operator_' . $operator],
				);
			}
		}
		
		//Values
		$data['values'] = array();
		
		//Categories
		$this->load->model('catalog/category');
		foreach ($this->model_catalog_category->getCategories(0) as $category) {
			$data['values']['product_category'][] = array(
				'id'	=> $category['category_id'],
				'name'	=> $category['name'],
			);
		}
		
		//Manufacturers
		$this->load->model('catalog/manufacturer');
		foreach ($this->model_catalog_manufacturer->getManufacturers() as $manufacturer) {
			$data['values']['product_manufacturer'][] = array(
				'id'	=> $manufacturer['manufacturer_id'],
				'name'	=> $manufacturer['name'],
			);
		}
		
		//Currencies
		$this->load->model('localisation/currency');
		foreach ($this->model_localisation_currency->getCurrencies() as $currency) {
			$data['values']['currency'][] = array(
				'id'	=> $currency['code'],
				'name'	=> $currency['title'],
			);
		}			
		
		//Days Of Week
		$day = 1;
		while ($day <= 7) {
			$data['values']['day'][] = array(
				'id'	=> $day,
				'name'	=> $data['day_' . $day],
			);
			$day++;
		}
		
		//Parameters
		$data['parameters'] = array();
		
		//Product Parameters
		foreach ($requirement_types['product'] as $param) {
			foreach (array('any', 'all', 'none') as $x) {
				$data['parameters']['product_' . $param]['match'][] = array(
					'id'	=> $x,
					'name'	=> $data['text_product_match_' . $x],
				);
			}
		}
		
		//Postal Code Types
		$data['parameters']['customer_postcode']['type'] = array();
		$data['parameters']['customer_postcode']['type'][] = array(
			'id'	=> 'other',
			'name'	=> $data['text_postcode_type_other'],
		);
		$data['parameters']['customer_postcode']['type'][] = array(
			'id'	=> 'uk',
			'name'	=> $data['text_postcode_type_uk'],
		);
		
		$this->requirement_settings = array('types' => $data['requirement_types'], 'operations' => $data['operations'], 'values' => $data['values'], 'parameters' => $data['parameters']);
	}
	
	private function version() {
		if (defined('VERSION') && strpos(VERSION, '1.5') === 0) {
			$version = 150;
		} elseif (defined('VERSION') && strpos(VERSION, '2.0') === 0) {
			$version = 200;
		} elseif (defined('VERSION') && strpos(VERSION, '2.1') === 0) {
			$version = 210;
		} else {
			$oc = '';
		}
		if (defined('JPATH_MIJOSHOP_ADMIN') && strpos(Mijoshop::get('base')->getMijoshopVersion(), '3.') === 0) {
			$version = 200;
		}
		return $version;
	}
	
	private function link($a, $b) {
		return $this->url->link($a . '/' . $b, 'token=' . $this->session->data['token'], 'SSL');
	}
	
	private function value($value) {
		return $value = (!is_array($value) && is_array(json_decode($value, true))) ? json_decode($value, true) : $value;
	}
	
	public function install() {
		$this->load->model('oca/' . $this->extension);
		$this->{'model_oca_' . $this->extension}->install();
		
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting($this->extension, array($this->extension . '_tooltip' => 1));
	}
	
	public function uninstall() {
		$this->load->model('oca/' . $this->extension);
		$this->{'model_oca_' . $this->extension}->uninstall();
	}
	
	public function save() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				$this->load->model('setting/setting');
				$json = array();
				$post_data = $this->request->post;
				foreach ($post_data as $key => $value) {
					$post_data[$key] = $this->value($value);
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
			$rate_id 	= $this->{'model_oca_' . $this->extension}->addRate($this->settings());
			$rate_info	= $this->{'model_oca_' . $this->extension}->getRate($rate_id);
			if ($rate_info) {
				$data = array();
				foreach ($rate_info as $key => $value) {
					$data[$key] = $this->value($value);
				}
					
				$html = $this->template($rate_id, $data);
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
			$this->{'model_oca_' . $this->extension}->deleteRate($rate_id);
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
			$this->{'model_oca_' . $this->extension}->deleteAllRates();
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
					if ($data['origin']) {
						$geocode = $this->getGeoCode($data['origin']);
						$data['geocode_lat'] = $geocode['lat'];
						$data['geocode_lng'] = $geocode['lng'];
					}
					$this->load->model('oca/' . $this->extension);
					$this->{'model_oca_' . $this->extension}->editRate($rate_id, $data);
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
			$rate_info = $this->{'model_oca_' . $this->extension}->copyRate($rate_id);
			
			if ($rate_info) {
				$data = array();
				foreach ($rate_info as $key => $value) {
					$data[$key] = $this->value($value);
				}
				
				$html = $this->template($data['rate_id'], $data);
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
		$rate_info = $this->{'model_oca_' . $this->extension}->getRate($rate_id);
		
		if ($rate_info) {
			$data = array();
			foreach ($rate_info as $key => $value) {
				$data[$key] = $this->value($value);
			}
				
			$html = $this->template($rate_id, $data);
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
		$rate_info = $this->{'model_oca_' . $this->extension}->getRate($rate_id);
		
		if ($rate_info) {
			$data = array();
			foreach ($rate_info as $key => $value) {
				$data[$key] = $this->value($value);
			}
				
			$html = $this->template($rate_id, $data);
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
	
	public function template($rate_id, $rate_info) {
		if ($rate_id && $rate_info) {			
			$this->buildRequirements();
			
			$data = array();
			$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
			
			$this->load->model('localisation/language');
			$this->load->model('localisation/tax_class');
			$this->load->model('localisation/currency');
			$this->load->model('setting/store');
			$this->load->model(($this->version() > 200 ? 'customer/customer_group' : 'sale/customer_group'));
			$this->load->model('localisation/geo_zone');
			$this->load->model('tool/image');
			
			$data['version']				= $this->version();
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
			
			if ($this->version() >= 200) {
				$data['link_store'] 			= $this->link('setting', 'store/add');
				$data['link_geo_zone'] 			= $this->link('localisation', 'geo_zone/add');
				$data['link_customer_group'] 	= ($this->version() > 200) ? $this->link('customer', 'customer_group/add') : $this->link('sale', 'customer_group/add');
			} else {
				$data['link_store'] 			= $this->link('setting', 'store/insert');
				$data['link_geo_zone'] 			= $this->link('localisation', 'geo_zone/insert');
				$data['link_customer_group'] 	= $this->link('sale', 'customer_group/insert');
			}
						
			$options = array('total_type', 'final_cost');
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
			
			$data['requirement_match'] = array();
			foreach (array('any', 'all', 'none') as $param) {
				$data['requirement_match'][] = array(
					'id'	=> $param,
					'name'	=> $data['requirement_match_' . $param],
				);
			}
			
			$data['requirement_cost'] = array();
			foreach (array('every', 'any', 'all', 'none') as $param) {
				$data['requirement_cost'][] = array(
					'id'	=> $param,
					'name'	=> $data['requirement_cost_' . $param],
				);
			}
			
			$data['rate_types'] 	= array();
			$rate_types['cart'] 	= array('quantity', 'total', 'weight', 'volume', 'dim_weight', 'distance');
			$rate_types['product'] 	= array('quantity', 'total', 'weight', 'volume');
			foreach ($rate_types as $rate_group => $rate_types) {
				foreach ($rate_types as $rate_type) {
					$data['rate_types'][$rate_group][] = array(
						'id'	=> $rate_group . '_' . $rate_type,
						'name'	=> $data['text_rate_type_' . $rate_group . '_' . $rate_type],
					);
				}
			}
			
			//Get Installed Shipping Methods
			$data['rate_types']['other'] = array();
			$this->load->model($this->version() >= 200 ? 'extension/extension' : 'setting/extension');
			$shipping_methods = $this->{'model_' . ($this->version() >= 200 ? 'extension_extension' : 'setting_extension')}->getInstalled('shipping');
			foreach ($shipping_methods as $shipping_method) {
				if ($shipping_method !== $this->extension && $shipping_method !== 'ocapps') {
					$this->load->language('shipping/' . $shipping_method);
					$data['rate_types']['other'][] = array(
						'id'	=> $shipping_method,
						'name'	=> strip_tags($this->language->get('heading_title')),
					);
				}
			}
			
			$data['default_store']				= $this->config->get('config_name');
			
			$data['languages'] 					= $this->model_localisation_language->getLanguages();
			$data['tax_classes'] 				= $this->model_localisation_tax_class->getTaxClasses();
			$data['currencies']					= $this->model_localisation_currency->getCurrencies();
			$data['stores'] 					= $this->model_setting_store->getStores();
			$data['customer_groups'] 			= $this->{'model_' . ($this->version() > 200 ? 'customer_customer_group' : 'sale_customer_group')}->getCustomerGroups();
			$data['geo_zones'] 					= $this->model_localisation_geo_zone->getGeoZones();
			
			foreach ($rate_info as $key => $value) {
				$data['data'][$key] = $this->value($value);
			}		

			$data['rate_id'] 					= $rate_id;
			
			$data['entry_shipping_factor'] 		= sprintf($data['entry_shipping_factor'], $this->length(), $this->weight());
			
			$data['requirement_types']			= $this->requirement_settings['types'];
			$data['operations']					= $this->requirement_settings['operations'];
			$data['values']						= $this->requirement_settings['values'];
			$data['parameters']					= $this->requirement_settings['parameters'];
			
			$no_image = ($this->version() >= 200) ? 'no_image.png' : 'no_image.jpg';
			
			if ($data['data']['image'] && file_exists(DIR_IMAGE . $data['data']['image'])) {
				$data['thumb'] 	= $this->model_tool_image->resize($data['data']['image'], 100, 100);
			} else {
				$data['thumb'] 	= $this->model_tool_image->resize($no_image, 100, 100);
			}
			$data['no_image'] 	= $this->model_tool_image->resize($no_image, 100, 100);
			
			$data['footer'] = sprintf($data['text_rate_footer'], $data['data']['rate_id'], date($data['date_format_short'], strtotime($data['data']['date_added'])), date($data['date_format_short'], strtotime($data['data']['date_modified'])), $data['data']['administrator']);
			
			if ($this->version() >= 200) {
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
	
	public function requirement() {
		$json = array();
		
		$this->buildRequirements();
		
		$data = array();
		$data = array_merge($data, $this->load->language($this->type . '/' . $this->extension));
		
		$type = isset($this->request->get['type']) ? $this->request->get['type'] : false;
		if ($type) {
			$json['success'] = true;
			
			if (!empty($this->requirement_settings['operations'][$type])) {
				$json['operations'] = array();
				foreach ($this->requirement_settings['operations'][$type] as $value) {
					$json['operations'][$value['id']] = $value['name'];
				}
			}
			
			if (!empty($this->requirement_settings['values'][$type])) {
				$json['values'] = array();
				foreach ($this->requirement_settings['values'][$type] as $value) {
					//Add A Space In Front Of Value To Prevent Browsers From Sorting
					$json['values'][' ' . $value['id']] = $value['name'];
				}
			}
			
			if (!empty($this->requirement_settings['parameters'][$type])) {
				$json['parameters'] = array();
				foreach ($this->requirement_settings['parameters'][$type] as $key => $param) {
					foreach ($param as $value) {
						$json['parameters'][$key][$value['id']] = $value['name'];
					}
					$json['parameter_tooltip'] = isset($data['tooltip_' . $type . '_' . $key]) ? $data['tooltip_' . $type . '_' . $key] : '';
				}
			}
			
			$json['value_tooltip'] = isset($data['tooltip_' . $type]) ? $data['tooltip_' . $type] : '';
		}
		$this->response->setOutput(json_encode($json));	
	}			
	
	private function weight() {
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
	
	private function length() {
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
	
	private function currency($currency) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "currency WHERE code = '" . $this->db->escape($currency) . "'");
		if (!empty($query->row['symbol_left'])) {
			return $query->row['symbol_left'];
		} elseif (!empty($query->row['symbol_right'])) {
			return $query->row['symbol_right'];
		} else {
			return '';
		}
	}
	
	private function validateRate($value) {		
		$rate_errors = array();
		
		$postcode_formats 	= array();
		$postcode_formats[] = '/^([0-9a-zA-Z]+)$/';
		$postcode_formats[] = '/^([0-9a-zA-Z]+):([0-9a-zA-Z]+)$/';
		
		$uk_formats	= array();		
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{2}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{1}[0-9]{3}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{2}[a-zA-Z]{2})$/';
		$uk_formats[] = '/^([a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2})$/';
		
		$rate_formats 	= array();
		$rate_formats[] = '/^([0-9.]+|~):([0-9.%]+)$/';
		$rate_formats[] = '/^([0-9.]+|~):([0-9.%]+)\+([0-9.%]+)$/';
		$rate_formats[] = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)$/';
		$rate_formats[] = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)\+([0-9.%]+)$/';
				
		if (!isset($value['stores'])) {
			$rate_errors['stores'] = sprintf($this->language->get('error_rate_stores'));
		}
		if (!isset($value['customer_groups'])) {
			$rate_errors['customer_groups'] = sprintf($this->language->get('error_rate_customer_groups'));
		}
		if (!isset($value['geo_zones'])) {
			$rate_errors['geo_zones'] = sprintf($this->language->get('error_rate_geo_zones'));
		}
		if (($value['rate_type'] == 'cart_dim_weight' || $value['rate_type'] == 'product_dim_weight') && !$value['shipping_factor']) {
			$rate_errors['shipping_factor'] = sprintf($this->language->get('error_rate_shipping_factor'));
		}
		if ($value['rate_type'] == 'cart_distance' && !$value['origin']) {
			$rate_errors['origin'] = sprintf($this->language->get('error_rate_origin'));
		}
		if (!empty($value['requirements'])) {
			foreach ($value['requirements'] as $key => $requirement) {
				if ($requirement['type'] == 'customer_postcode') {
					if ($requirement['value']) {
						$postcode_ranges = explode(',', $requirement['value']);
						foreach ($postcode_ranges as $postcode_range) {
							$postcode_format_match = false;
							$postcode_range = trim($postcode_range);
							foreach ($postcode_formats as $postcode_format) {
								if (preg_match($postcode_format, $postcode_range)) {
									$postcode_format_match = true;
									if ($requirement['parameter']['type'] == 'uk') {
										$postcode_uk_format_match = false;
										$postcodes = explode(':', $postcode_range);
										$postcodes[0] = trim($postcodes[0]);
										foreach ($uk_formats as $uk_format) {
											if (preg_match($uk_format, $postcodes[0])) {
												$postcode_uk_format_match = true;
												break;
											}
										}
										if (!$postcode_uk_format_match) {
											$rate_errors['requirement_' . $key] = sprintf($this->language->get('error_rate_postcode_formatting'), $postcodes[0]);
										}
										if (!empty($postcodes[1])) {
											$postcode_uk_format_match = false;
											$postcodes[1] = trim($postcodes[1]);
											foreach ($uk_formats as $uk_format) {
												if (preg_match($uk_format, $postcodes[1])) {
													$postcode_uk_format_match = true;
													break;
												}
											}
											if (!$postcode_uk_format_match) {
												$rate_errors['requirement_' . $key] = sprintf($this->language->get('error_rate_postcode_formatting'), $postcodes[1]);
											}
										}
									}
									break;
								}
							}
							if (!$postcode_format_match) {
								$rate_errors['requirement_' . $key] = sprintf($this->language->get('error_rate_postcode_range_formatting'), $postcode_range);
							}
						}
					} else {
						$rate_errors['requirement_' . $key] = $this->language->get('error_rate_requirement');
					}
				} else {
					if (empty($requirement['value'])) {
						$rate_errors['requirement_' . $key] = $this->language->get('error_rate_requirement');
					}
				}
			}
		}
		if (strpos($value['rate_type'], 'cart_') === 0 || strpos($value['rate_type'], 'product_') === 0) {
			if (!$value['rates']) {
				$rate_errors['rates'] = sprintf($this->language->get('error_rate_rates'));
			} else {
				$rates = explode(',', $value['rates']);
				foreach ($rates as $rate) {
					$rate_status = false;
					$rate = trim($rate);
					foreach ($rate_formats as $rate_format) {
						if (preg_match($rate_format, $rate)) {
							$rate_status = true;
							break;
						}
					}
					if (!$rate_status) {
						$rate_errors['rates'] = sprintf($this->language->get('error_rate_rates_formatting'), $rate);
						break;
					}
				}
			}
		}
		return $rate_errors;	
	}
	
	public function settings() {
		$this->load->model('localisation/language');
		$this->load->model('setting/store');
		$this->load->model(($this->version() > 200 ? 'customer/customer_group' : 'sale/customer_group'));
		$this->load->model('localisation/geo_zone');
		$this->load->model('catalog/category');
		
		$this->load->language($this->type . '/' . $this->extension);
		
		$this->load->model('oca/' . $this->extension);
		$data = $this->{'model_oca_' . $this->extension}->settings();
		
		$data['description'] = $this->language->get('text_name');
		
		foreach ($this->model_setting_store->getStores() as $store) {
			$data['stores'][] = (int)$store['store_id'];
		}
		
		foreach ($this->{'model_' . ($this->version() > 200 ? 'customer_customer_group' : 'sale_customer_group')}->getCustomerGroups() as $customer_group) {
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
	
	private function csv() {
		$instructions 	= 'DO NOT ADD OR REMOVE ANY COLUMNS. ADDING OR REMOVING COLUMNS MAY PREVENT RATES FROM IMPORTING CORRECTLY!';
		
		$row_offset 	= 1;
		$col_offset 	= 0;
		
		$fields 		= array();
		$this->load->model('oca/' . $this->extension);
		$data = $this->{'model_oca_' . $this->extension}->settings();
		foreach ($data as $key => $value) {
			$fields[] = $key;
		}
		
		return array(
			'instructions'	=> $instructions,
			'fields'		=> $fields,
			'row_offset'	=> $row_offset,
			'col_offset'	=> $col_offset,
		);
	}
	
	public function import($file) {
		if ($this->validate() && $file) {
			$this->load->model('oca/' . $this->extension);
			
			$changes = array(
				'added'		=> 0,
				'updated'	=> 0
			);
			
			$csv_info 	= $this->csv();
			
			$row = 0;
			if (($handle = fopen($file, "r")) !== false) {			
				while (($data = fgetcsv($handle, 4000, ",")) !== false) {
					if ($row > $csv_info['row_offset']) {
						$col = $csv_info['col_offset'];
						foreach ($fields as $field) {
							$value 				= $this->value($data[$col++]);
							$key				= trim($field);
							$rate_info[$key] 	= $value;
						}
						
						foreach ($this->settings() as $key => $value) {
							$rate_info[$key] = isset($rate_info[$key]) ? $rate_info[$key] : $value;
						}
						
						if ($rate_info['rate_id'] && $this->{'model_oca_' . $this->extension}->getRate($rate_info['rate_id'])) {
							$this->{'model_oca_' . $this->extension}->editRate($rate_info['rate_id'], $rate_info);
							$changes['updated']++;
						} else {
							$this->{'model_oca_' . $this->extension}->addRate($rate_info);
							$changes['added']++;
						}
						
						$row++;	
					} elseif ($row == $csv_info['row_offset']) {
						$fields = array();
						$fields = array_merge($data);
						
						$row++;	
					} else {
						$row++;
					}
				}
			}
			$this->session->data['success'] = sprintf($this->language->get('success_rate_import'), $changes['added'], $changes['updated']);
		}
	}
	
	public function export() {
		if ($this->validate()) {
			$this->load->model('oca/' . $this->extension);
			$rates = $this->{'model_oca_' . $this->extension}->getRates();
			
			if ($rates) {
				$this->response->addheader('Pragma: public');
				$this->response->addheader('Expires: 0');
				$this->response->addheader('Content-Description: File Transfer');
				$this->response->addheader('Content-Type: text/csv');
				$this->response->addheader('Content-Disposition: attachment; filename=' . date('Y-m-d_H-i-s', time()).'_' . $this->extension . '.csv');
				$this->response->addheader('Content-Transfer-Encoding: binary');
				
				$csv_info = $this->csv();
				
				$output = str_replace('"', '""', $csv_info['instructions']);
				$output .= "\n";
				
				$x = 1;
				foreach ($csv_info['fields'] as $field) {
					$output	.= ($x > 1) ? ',"' . str_replace('"', '""', $field) . '"' : '"' . str_replace('"', '""', $field) . '"';
					$x++;
				}
				$output .= "\n";
			
				foreach ($rates as $rate) {
					$rate_info = $this->{'model_oca_' . $this->extension}->getRate($rate['rate_id']);
					
					foreach ($rate_info as $key => $value) {
						$data[$key] = $value;
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
			$json['success'] = $this->language->get('success_debug_clear');
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	public function reloadDebug() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate()) {
			$file = DIR_LOGS . $this->extension . '.txt';
			if (file_exists($file)) {
				$file_size = filesize($file);
				if ($file_size >= 5242880) {
					$suffix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
					$i = 0;
					while (($file_size / 1024) > 1) {
						$file_size = $file_size / 1024;
						$i++;
					}
					$json['error'] = sprintf($this->language->get('error_debug'), basename($file), round(substr($file_size, 0, strpos($file_size, '.') + 4), 2) . $suffix[$i]);
				} else {
					$json['debug_log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
				}
				$json['success'] = $this->language->get('success_debug_reload');
			} else {
				$json['debug_log'] = '';
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}
		$this->response->setOutput(json_encode($json));
	}
	
	public function submitSupportRequest() {
		$json = array();
		
		$this->load->language($this->type . '/' . $this->extension);
		
		if ($this->validate() && isset($this->request->post)) {
			if ($this->request->post['email'] && $this->request->post['order_id'] && $this->request->post['enquiry']) {
				$text  = "Extension: " . $this->language->get('text_name') . "\n";
				$text .= "Version: " . $this->version . "\n";
				$text .= (defined('VERSION')) ? "OpenCart Version: " . VERSION . "\n" : "OpenCart Version: N/A \n";
				$text .= "Website: " . HTTP_CATALOG . "\n";
				$text .= "Email: " . $this->request->post['email'] . "\n";
				$text .= "Order ID: " . $this->request->post['order_id'] . "\n";
				$text .= "\n";
				$text .= "Support Question: \n";
				$text .= $this->request->post['enquiry'];
								
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
			
				$json['success'] = $this->language->get('success_support');
			} else {
				$json['error'] = $this->language->get('error_support');
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
	
	private $requirement_settings;
	
	private $img_logo	= 'oca_pro_logo.png';
	private $icon_logo	= 'oca_icon_pro_logo.png';
	private $icon_name	= 'oca_icon_pro_name.png';
	
	private $statusImage		= false;
	private $statusInstruction	= false;
	
	private $ocapps_status		= false;
}
?>