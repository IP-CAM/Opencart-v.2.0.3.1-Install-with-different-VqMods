<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}


				$data['alternate'] = '';
				$mlseo = $this->config->get('mlseo');
				if (isset($mlseo['hreflang'])) {	
					$this->load->model('localisation/language');
					$languages = $this->model_localisation_language->getLanguages();
					
					if (isset($this->request->get['route'])) {
						if ($this->request->get['route'] == 'product/product') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('product_id=', CAST(".$this->request->get['product_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] = '<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'product/category') {
							$xcats = explode('_', $this->request->get['path']); $xcat = end($xcats);
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('category_id=', CAST(".$xcat." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] = '<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'product/manufacturer/info') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('manufacturer_id=', CAST(".$this->request->get['manufacturer_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] = '<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'information/information') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('information_id=', CAST(".$this->request->get['information_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] = '<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						
					
					}
				}
				
				
		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}
		$data['google_webmaster'] = html_entity_decode($this->config->get('config_google_webmaster'), ENT_QUOTES, 'UTF-8');
		$data['google_meta'] = html_entity_decode($this->config->get('config_google_meta'), ENT_QUOTES, 'UTF-8');
		$data['google_tagmanager'] = html_entity_decode($this->config->get('config_google_tagmanager'), ENT_QUOTES, 'UTF-8');
		// paysera
		$data['paysera_meta'] = html_entity_decode($this->config->get('config_paysera_meta'), ENT_QUOTES, 'UTF-8');
		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}