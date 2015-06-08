<?php
//==//

class ModelOCAOCAASPRO extends Model { 
	private $error 			= array();
	private $extension 		= 'ocaaspro';	
	private $db_table		= 'advanced_shipping_pro';
	
	public function addRate($data) {
		foreach ($this->getFields() as $key => $value) {
			$data[$key] = isset($data[$key]) ? $data[$key] : $value;
		}			
		
		$this->db->query("INSERT INTO " . DB_PREFIX . $this->db_table . " SET description = '" . $this->db->escape(substr($data['description'], 0, 100)) . "', status = '" . (int)$data['status'] . "', image = '" . $this->db->escape($data['image']) . "', image_width = '" . (int)$data['image_width'] . "', image_height = '" . (int)$data['image_height'] . "', name = '" . $this->db->escape(serialize($data['name'])) . "', instruction = '" . $this->db->escape(serialize($data['instruction'])) . "', `group` = '" . $this->db->escape($data['group']) . "', multirate = '" . (int)$data['multirate'] . "', sort_order = '" . (int)$data['sort_order'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', total_type = '" . (int)$data['total_type'] . "', currency = '" . $this->db->escape($data['currency']) . "', days = '" . $this->db->escape(serialize($data['days'])) . "', time = '" . $this->db->escape(serialize($data['time'])) . "', date = '" . $this->db->escape(serialize($data['date'])) . "', stores = '" . $this->db->escape(serialize($data['stores'])) . "', customer_groups = '" . $this->db->escape(serialize($data['customer_groups'])) . "', geo_zones = '" . $this->db->escape(serialize($data['geo_zones'])) . "', currencies = '" . $this->db->escape(serialize($data['currencies'])) . "', postcode_type = '" . (int)$data['postcode_type'] . "', postcode_method = '" . (int)$data['postcode_method'] . "', postcode_ranges = '" . $this->db->escape($data['postcode_ranges']) . "', cart_quantity = '" . $this->db->escape(serialize($data['cart_quantity'])) . "', cart_total = '" . $this->db->escape(serialize($data['cart_total'])) . "', cart_weight = '" . $this->db->escape(serialize($data['cart_weight'])) . "', cart_volume = '" . $this->db->escape(serialize($data['cart_volume'])) . "', cart_distance = '" . $this->db->escape(serialize($data['cart_distance'])) . "', cart_length = '" . $this->db->escape(serialize($data['cart_length'])) . "', cart_width = '" . $this->db->escape(serialize($data['cart_width'])) . "', cart_height = '" . $this->db->escape(serialize($data['cart_height'])) . "', product_length = '" . $this->db->escape(serialize($data['product_length'])) . "', product_width = '" . $this->db->escape(serialize($data['product_width'])) . "', product_height = '" . $this->db->escape(serialize($data['product_height'])) . "', category_match = '" . (int)$data['category_match'] . "', category_cost = '" . (int)$data['category_cost'] . "', categories = '" . $this->db->escape(serialize($data['categories'])) . "', rate_type = '" . (int)$data['rate_type'] . "', final_cost = '" . (int)$data['final_cost'] . "', split = '" . (int)$data['split'] . "', shipping_factor = '" . (float)$data['shipping_factor'] . "', origin = '" . $this->db->escape($data['origin']) . "', geocode_lat = '" . (float)$data['geocode_lat'] . "', geocode_lng = '" . (float)$data['geocode_lng'] . "', rates = '" . $this->db->escape($data['rates']) . "', cost = '" . $this->db->escape(serialize($data['cost'])) . "', freight_fee = '" . $this->db->escape($data['freight_fee']) . "', date_added = NOW(), date_modified = NOW(), administrator = '" . $this->db->escape($this->user->getUserName()) . "'");
		
		$rate_id = $this->db->getLastId();
		return $rate_id;
	}
	
	public function editRate($rate_id, $data) {
		foreach ($this->getFields() as $key => $value) {
			$data[$key] = isset($data[$key]) ? $data[$key] : $value;
		}
		
		$this->db->query("UPDATE " . DB_PREFIX . $this->db_table . " SET description = '" . $this->db->escape(substr($data['description'], 0, 100)) . "', status = '" . (int)$data['status'] . "', image = '" . $this->db->escape($data['image']) . "', image_width = '" . (int)$data['image_width'] . "', image_height = '" . (int)$data['image_height'] . "', name = '" . $this->db->escape(serialize($data['name'])) . "', instruction = '" . $this->db->escape(serialize($data['instruction'])) . "', `group` = '" . $this->db->escape($data['group']) . "', multirate = '" . (int)$data['multirate'] . "', sort_order = '" . (int)$data['sort_order'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', total_type = '" . (int)$data['total_type'] . "', currency = '" . $this->db->escape($data['currency']) . "', days = '" . $this->db->escape(serialize($data['days'])) . "', time = '" . $this->db->escape(serialize($data['time'])) . "', date = '" . $this->db->escape(serialize($data['date'])) . "', stores = '" . $this->db->escape(serialize($data['stores'])) . "', customer_groups = '" . $this->db->escape(serialize($data['customer_groups'])) . "', geo_zones = '" . $this->db->escape(serialize($data['geo_zones'])) . "', currencies = '" . $this->db->escape(serialize($data['currencies'])) . "', postcode_type = '" . (int)$data['postcode_type'] . "', postcode_method = '" . (int)$data['postcode_method'] . "', postcode_ranges = '" . $this->db->escape($data['postcode_ranges']) . "', cart_quantity = '" . $this->db->escape(serialize($data['cart_quantity'])) . "', cart_total = '" . $this->db->escape(serialize($data['cart_total'])) . "', cart_weight = '" . $this->db->escape(serialize($data['cart_weight'])) . "', cart_volume = '" . $this->db->escape(serialize($data['cart_volume'])) . "', cart_distance = '" . $this->db->escape(serialize($data['cart_distance'])) . "', cart_length = '" . $this->db->escape(serialize($data['cart_length'])) . "', cart_width = '" . $this->db->escape(serialize($data['cart_width'])) . "', cart_height = '" . $this->db->escape(serialize($data['cart_height'])) . "', product_length = '" . $this->db->escape(serialize($data['product_length'])) . "', product_width = '" . $this->db->escape(serialize($data['product_width'])) . "', product_height = '" . $this->db->escape(serialize($data['product_height'])) . "', category_match = '" . (int)$data['category_match'] . "', category_cost = '" . (int)$data['category_cost'] . "', categories = '" . $this->db->escape(serialize($data['categories'])) . "', rate_type = '" . (int)$data['rate_type'] . "', final_cost = '" . (int)$data['final_cost'] . "', split = '" . (int)$data['split'] . "', shipping_factor = '" . (float)$data['shipping_factor'] . "', origin = '" . $this->db->escape($data['origin']) . "', geocode_lat = '" . (float)$data['geocode_lat'] . "', geocode_lng = '" . (float)$data['geocode_lng'] . "', rates = '" . $this->db->escape($data['rates']) . "', cost = '" . $this->db->escape(serialize($data['cost'])) . "', freight_fee = '" . $this->db->escape($data['freight_fee']) . "', date_modified = NOW(), administrator = '" . $this->db->escape($this->user->getUserName()) . "' WHERE rate_id = '" . (int)$rate_id . "'");
	}
	
	public function copyRate($rate_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . $this->db_table . " WHERE rate_id = '" . (int)$rate_id . "'");
		
		if ($query->num_rows) {
			$data = array();
	
			$data = $query->row;
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
	
	public function getFields() {
		return array(
			'rate_id'			=> 0,
			'description'		=> '',
			'status'			=> 0,
			'image'				=> '',
			'image_width'		=> 50,
			'image_height'		=> 50,
			'name'				=> array(),
			'instruction'		=> array(),
			'group'				=> 'A',
			'multirate'			=> 0,
			'sort_order'		=> 1,
			'tax_class_id'		=> 0,
			'total_type'		=> 0,
			'currency'			=> $this->config->get('config_currency'),
			'days'				=> array(0,1,2,3,4,5,6),
			'time'				=> array('start'=>'', 'end'=>''),
			'date'				=> array('start'=>'', 'end'=>''),
			'stores'			=> array(0),
			'customer_groups'	=> array(-1,0),
			'geo_zones'			=> array(0),
			'currencies'		=> array('0'),
			'postcode_type'		=> 0,
			'postcode_method'	=> 0,
			'postcode_ranges'	=> '',
			'cart_quantity'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_total'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_weight'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_volume'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_distance'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_length'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_width'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'cart_height'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'product_length'	=> array('min'=>'', 'max'=>'', 'add'=>''),
			'product_width'		=> array('min'=>'', 'max'=>'', 'add'=>''),
			'product_height'	=> array('min'=>'', 'max'=>'', 'add'=>''),
			'category_match'	=> 0,
			'category_cost'		=> 0,
			'categories'		=> array(0),
			'rate_type'			=> 0,
			'final_cost'		=> 0,
			'split'				=> 0,
			'shipping_factor'	=> 5000,
			'origin'			=> '',
			'geocode_lat'		=> 0,
			'geocode_lng'		=> 0,
			'rates'				=> '',
			'cost'				=> array('min'=>'', 'max'=>'', 'add'=>''),
			'freight_fee'		=> '',
			'date_added'		=> '0000-00-00 00:00:00',
			'date_modified'		=> '0000-00-00 00:00:00',
			'administrator'		=> ''
		);
	}
}
?>