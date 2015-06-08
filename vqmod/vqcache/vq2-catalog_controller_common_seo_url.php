<?php
class ControllerCommonSeoUrl extends Controller {
	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL

			if (isset($this->request->get['_route_'])) {
			$lquery = $this->db->query("SELECT * FROM " . DB_PREFIX . "language;");			
			foreach ($lquery->rows as $language) {
				if ((strpos($this->request->get['_route_'],$language['code'].'/')) === 0) {
					$this->session->data['language'] = $language['code']; 
					$this->language = new Language($language['directory']);
					$this->language->load($language['directory']); 
					$this->registry->set('language', $this->language); 
					$this->config->set('config_language_id', $language['language_id']); 					
					$this->request->get['_route_'] = substr( $this->request->get['_route_'], strlen($language['code'].'/'));
					
			        }
			}
			if ($this->request->get['_route_'] == '') 
				{
				unset($this->request->get['_route_']);
				$this->session->data['proute'] = 'common/home';
				}
			
			}
			
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT u.query, u.keyword, u.language_id as lid, l.code, l.directory FROM " . DB_PREFIX . "url_alias u left join " . DB_PREFIX . "language l on u.language_id = l.language_id WHERE u.keyword = '" . $this->db->escape($part) . "'");			
			

				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);

					if ($url[0] == 'product_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);  				
				}
			
						$this->request->get['product_id'] = $url[1];
					}

					if ($url[0] == 'category_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);					
				}
			
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}

					if ($url[0] == 'manufacturer_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']);  
				}
			
						$this->request->get['manufacturer_id'] = $url[1];
					}

					if ($url[0] == 'information_id') {

			if (($this->session->data['language'] <> $query->row['code']) || (!isset($this->session->data['language'])))
				{
				$this->session->data['language'] = $query->row['code']; 
				$this->language = new Language($query->row['directory']);
				$this->language->load($query->row['directory']); 
				$this->registry->set('language', $this->language); 
				$this->config->set('config_language_id', $query->row['lid']); 
				}
			
						$this->request->get['information_id'] = $url[1];
					}

					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'manufacturer_id' && $url[0] != 'category_id' && $url[0] != 'product_id') {
						$this->request->get['route'] = $query->row['query'];
					}
				} else {
					$this->request->get['route'] = 'error/not_found';

					break;
				}
			}

			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product'; $this->session->data['product_id'] = $this->request->get['product_id'];
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category'; $this->session->data['path'] = $this->request->get['path'];
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info'; $this->session->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
				} elseif (isset($this->request->get['information_id'])) {
					$this->request->get['route'] = 'information/information'; $this->session->data['information_id'] = $this->request->get['information_id'];
				}
			}

			
			if (isset($this->request->get['route'])) { $this->session->data['proute'] = $this->request->get['route']; }
			
			if (isset($this->request->get['route'])) {
				return new Action($this->request->get['route']);
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));

		
				$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
				$mlseo = $this->config->get('mlseo');				
				if (isset($this->session->data['language']) && (isset($mlseo['subfolder']))  && ($this->session->data['language'] <> $squery->row['value'])) {$url = '/'.$this->session->data['language'];}
				else {$url = '';}

		$data = array();

		parse_str($url_info['query'], $data);

		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || ($data['route'] == 'information/information' && $key == 'information_id')) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE language_id = " . (int)$this->config->get('config_language_id') . " AND `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}
				} elseif ($key == 'path') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE language_id = " . (int)$this->config->get('config_language_id') . " AND `query` = 'category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							
				$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
				$mlseo = $this->config->get('mlseo');				
				if (isset($this->session->data['language']) && (isset($mlseo['subfolder']))  && ($this->session->data['language'] <> $squery->row['value'])) {$url = '/'.$this->session->data['language'];}
				else {$url = '';}

							break;
						}
					}

					unset($data[$key]);
				}
			}
		}

		if (($url) && ($url <> '/'.$this->session->data['language'])){
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}
