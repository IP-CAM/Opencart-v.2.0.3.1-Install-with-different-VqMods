<?php 
//==//

class ModelShippingOCAASPRO extends Model {  
	private $extension 				= 'ocaaspro';
	private $type 					= 'shipping';
	private $db_table				= 'advanced_shipping_pro';
	private $debugStatus			= true;
	
	public function getQuote($address) {
		$this->debugStatus = $this->getField('debug');
		
		if ($this->getField('status') && $this->getRates() && $this->cart->hasProducts() && $address) {	
			$language_code = isset($this->session->data['language']) ? $this->session->data['language'] : $this->config->get('config_language');
			
			if ($this->customer->isLogged()) {
				$customer_group_id = ($this->getVersion() >= 200) ? (int)$this->customer->getGroupId() : (int)$this->customer->getCustomerGroupId();
			} else {
				$customer_group_id = 0;
			}

			$rates = $this->getRates();

			$quote_data = array();
			$method_data = array();
			
			$sum_data 	= array();
			$avg_data 	= array();
			$low_data 	= array();
			$high_data 	= array();
			
			$rate_row = 1;
			
			if ($rates) {
				foreach ($rates as $rate_info) {
					$rate 	= array();
					$this->load->language($this->type . '/' . $this->extension);
					$debug  = $this->language->get('text_title');
					$debug .= ' | RateID: ' . $rate_info['rate_id'];
					$debug .= ' | Description: ' . strtoupper($rate_info['description']);
					$debug .= ' | LanguageCode: ' . strtoupper($language_code);
					
					foreach ($rate_info as $key => $value) {
						$rate[$key] = $this->getValue($value);
					}
					
					if ($rate['status']) {
						$debug .= ' | RateStatus: ENABLED';
						$debug .= ' | CustomerAddress: FOUND';
						$status = true;
						
						$cart_value = array(
							'total'		=> 0,
							'quantity'	=> 0,
							'weight'	=> 0,
							'volume'	=> 0,
							'distance'	=> 0,
							'length'	=> 0,
							'width'		=> 0,
							'height'	=> 0
						);
				
						$cart_value['total'] 		= $this->getTotal($rate);					
						$cart_value['quantity'] 	= $this->getQuantity();
						$cart_value['volume'] 		= $this->getVolume($rate);
						
						if ($rate['geocode_lat'] && $rate['geocode_lng'] && $rate['origin'] && ((float)$rate['cart_distance']['min'] || (float)$rate['cart_distance']['max'] || $rate['rate_type'] == 5)) {
							$origin = array(
								'origin'	=> $rate['origin'],
								'lat'		=> $rate['geocode_lat'],
								'lng'		=> $rate['geocode_lng']
							);
							$country_query 	= $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$address['country_id'] . "'");
							$zone_query		= $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$address['zone_id'] . "'");
							if ($country_query) {
								$destination  = $address['address_1'];
								$destination .= ($address['address_2']) ? ' ' . $address['address_2'] : '';
								$destination .= ' ' . $address['city'];
								$destination .= ' ' . $address['postcode'];
								$destination .= ($zone_query) ? ' ' . $zone_query->row['name'] : '';
								$destination .= ' ' . $country_query->row['name'];
								$cart_value['distance'] = $this->getDistance($origin, $destination);
							}
						}
						
						if ($rate['rate_type'] == 4 && $rate['shipping_factor']) {
							$cart_value['weight'] 	= $this->getDimensionalWeight($rate);
						} else {
							$cart_value['weight'] 	= $this->getWeight();
						}
						
						$dimensions 				= $this->getDimensions($rate);
						$cart_value['length']		= $dimensions['length'];
						$cart_value['width']		= $dimensions['width'];
						$cart_value['height']		= $dimensions['height'];
						
						$categories 				= isset($rate['categories']) ? $rate['categories'] : array();
						
						$exclude_values = array(
							'total'		=> 0,
							'quantity'	=> 0,
							'weight'	=> 0,
							'volume'	=> 0,
							'distance'	=> 0,
							'length'	=> 0,
							'width'		=> 0,
							'height'	=> 0
						);
						
						if ($categories && ($rate['category_cost'] == 1 || $rate['category_cost'] == 2) && !in_array(0, $categories)) {
							$exclude_values	 = $this->excludeProduct($rate['category_cost'], $categories, $rate['currency']);
						}
						
						$value_status = array();
						foreach ($cart_value as $key => $value) {
							$debug 					.= ' | Cart' . ucfirst($key) . ': ' . $cart_value[$key];
							$cart_value[$key]		-= isset($exclude_values[$key]) ? (float)$exclude_values[$key] : 0;
							$debug 					.= ' | Cart' . ucfirst($key) . ' After excludeProduct: ' . $cart_value[$key];
							$cart_value[$key]		 = $this->getValueAdd($cart_value[$key], $key, $rate);
							$debug 					.= ' | Cart' . ucfirst($key) . ' After getValueAdd: ' . $cart_value[$key];
							$value_status[]			 = $this->checkValue($cart_value[$key], $key, $rate);
						}
						
						if (in_array(false, $value_status)) {
							$status = false;
							if (!$this->debugStatus) { continue; }
							$debug .= ' | checkCartValues: FAILED';
						} else {
							$debug .= ' | checkCartValues: PASSED';
						}
						
						if (!$rate['rates']) {
							$status = false;
							if (!$this->debugStatus) { continue; }
							$debug .= ' | Rates: NOT FOUND';
						} else {
							$debug .= ' | Rates: FOUND';
						}
							
						if ($status) {
							$status_time = $this->checkDateTime($rate);
							$debug .= $status_time['debug'];
							if (!$status_time['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkDateTime: FAILED';
							} else {
								$debug .= ' | checkDateTime: PASSED';
							}
						}
						
						if ($status) {
							$status_store = $this->checkStores($rate);
							$debug .= $status_store['debug'];
							if (!$status_store['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkStores: FAILED';
							} else {
								$debug .= ' | checkStores: PASSED';
							}
						}
						
						if ($status) {
							$status_customer = $this->checkCustomer($customer_group_id, $rate);
							$debug .= $status_customer['debug'];
							if (!$status_customer['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkCustomer: FAILED';
							} else {
								$debug .= ' | checkCustomer: PASSED';
							}
						}
						
						if ($status) {
							$status_products = $this->checkProducts($rate);
							$debug .= $status_products['debug'];
							if (!$status_products['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkProducts: FAILED';
							} else {
								$debug .= ' | checkProducts: PASSED';
							}
						}
						
						if ($status) {
							$status_categories = $this->checkCategories($categories, $rate);
							$debug .= $status_categories['debug'];
							if (!$status_categories['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkCategories: FAILED';
							} else {
								$debug .= ' | checkCategories: PASSED';
							}
						}
						
						if ($status && $rate['postcode_ranges']) {
							$status_postalcodes = $this->checkPostalCodes($address, $rate);
							$debug .= $status_postalcodes['debug'];
							if (!$status_postalcodes['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkPostalCodes: FAILED';
							} else {
								$debug .= ' | checkPostalCodes: PASSED';
							}
						}
						
						if ($status) {
							$status_geozones = $this->checkGeoZones($address, $rate);
							$debug .= $status_geozones['debug'];
							if (!$status_geozones['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkGeoZones: FAILED';
							} else {
								$debug .= ' | checkGeoZones: PASSED';
							}
						}
						
						if ($status) {
							$status_currencies = $this->checkCurrencies($rate['currencies']);
							$debug .= $status_currencies['debug'];
							if (!$status_currencies['status']) {
								$status = false;
								if (!$this->debugStatus) { continue; }
								$debug .= ' | checkCurrencies: FAILED';
							} else {
								$debug .= ' | checkCurrencies: PASSED';
							}
						}
						
						if ($status) {
							$cost = '';
							
							if ($rate['rate_type'] == 0) {
								$value = $cart_value['quantity'];
								$debug .= ' | RateType: QUANTITY';
							} elseif ($rate['rate_type'] == 1) {
								$value = $cart_value['total'];
								$debug .= ' | RateType: TOTAL';
							} elseif ($rate['rate_type'] == 2) {
								$value = $cart_value['weight'];
								$debug .= ' | RateType: WEIGHT';
							} elseif ($rate['rate_type'] == 3) {
								$value = $cart_value['volume'];
								$debug .= ' | RateType: VOLUME';
							} elseif ($rate['rate_type'] == 4) {
								$value = $cart_value['weight'];
								$debug .= ' | RateType: DIMENSIONAL WEIGHT';
							} elseif ($rate['rate_type'] == 5) {
								$value = $cart_value['distance'];
								$debug .= ' | RateType: DISTANCE';
							} else {
								$value = $cart_value['quantity'];
								$debug .= ' | RateType: NOT FOUND - QUANTITY USED';
							}
							
							$max_rate	= $this->getRateMax($rate['rates']);
							if ($rate['split'] && $max_rate > 0 && $max_rate !== '~') {
								$debug .= ' | SplitStatus: ENABLED';
								$divide = ceil($value / $max_rate);
								$x		= 1;
							} else {
								$debug .= ' | SplitStatus: DISABLED';
								$divide	= 1;
								$x		= 1;
							}
							while ($divide >= $x) {
								if ($rate['split']) {
									$split_value = ($divide == $x) ? $value - ($max_rate * ($x - 1)) : $max_rate;
								} else {
									$split_value = $value;
								}
								if ($rate['final_cost'] == 0) {
									$cost_data 	= $this->getRateSingle($split_value, $rate['rates'], $cart_value['total']);
									$debug .= ' | FinalCost: SINGLE';
								} elseif ($rate['final_cost'] == 1) {
									$cost_data 	= $this->getRateCumulative($split_value, $rate['rates'], $cart_value['total']);
									$debug .= ' | FinalCost: CUMULATIVE';
								} else {
									$cost_data 	= $this->getRateSingle($split_value, $rate['rates'], $cart_value['total']);
									$debug .= ' | FinalCost: NOT FOUND - SINGLE USED';
								}
								$cost	+= $cost_data['cost'];
								$debug	.= $cost_data['debug'];
								$x++;
							}
							
							if ((string)$cost != '') {
								if ($rate['cost']['min']) {
									if ($cost < $rate['cost']['min']) {
										$cost 	= $rate['cost']['min'];
										$debug .= ' | CostMin: COST ADJUSTED';
									} else {
										$debug .= ' | CostMin: COST ABOVE MIN';
									}
								}
								
								if ($rate['cost']['max']) {
									if ($cost > $rate['cost']['max']) {
										$cost 	= $rate['cost']['max'];
										$debug .= ' | CostMax: COST ADJUSTED';
									} else {
										$debug .= ' | CostMax: COST BELOW MAX';
									}
								}
								
								if ($rate['cost']['add']) {
									if (strpos($rate['cost']['add'], '%')) {
										$cost += $cost * ($rate['cost']['add'] / 100);
									} else {
										$cost  += $rate['cost']['add'];
									}
									$debug .= ' | CostAdd: SUCCESS';
								} else {
									$debug .= ' | CostAdd: NO ADD VALUE';
								}
								
								if ($rate['freight_fee']) {
									$pos = strpos($rate['freight_fee'], '%');
									if ($pos) {
										$cost += $cost * ($rate['freight_fee'] / 100);
									} else {
										$cost += $rate['freight_fee'];
									}
									$debug .= ' | FreightFee: ADDED';
								} else {
									$debug .= ' | FreightFee: NO FREIGHT FEE VALUE';
								}
								
								$debug .= ' | ' . ucfirst($this->type) . 'Cost: ' . $cost;
								
								$this->load->language($this->type . '/' . $this->extension);

								if ($rate['image'] && file_exists(DIR_IMAGE . $rate['image'])) {
									$this->load->model('tool/image');
									$image = $this->model_tool_image->resize($rate['image'], $rate['image_width'], $rate['image_height']);
								} else {
									$image = '';
								}
								
								$instruction = !empty($rate['instruction'][$language_code]) ? $rate['instruction'][$language_code] : '';
								
								$rate_name  	= !empty($rate['name'][$language_code]) ? $rate['name'][$language_code] : $this->language->get('text_name');
								$shipping_name 	= !empty($rate['name'][$language_code]) ? $rate['name'][$language_code] : $this->language->get('text_name');
								
								if ($this->getField('display_value')) {
									if ($rate['rate_type'] == 0) {
										$name_value = $value;
									} elseif ($rate['rate_type'] == 1) {
										$name_value = $this->currency->format($value, $rate['currency'], 1);
									} elseif ($rate['rate_type'] == 2) {
										$name_value = $this->weight->format($value, $this->config->get('config_' . $this->getWeightClass()));
									} elseif ($rate['rate_type'] == 3) {
										$name_value = $this->length->format($value, $this->config->get('config_' . $this->getLengthClass())) . '&sup3;';
									} elseif ($rate['rate_type'] == 4) {
										$name_value = $this->weight->format($value, $this->config->get('config_' . $this->getWeightClass()));
									} elseif ($rate['rate_type'] == 5) {
										$name_value = round($value, 2) . 'km';
									} else {
										$name_value = $value;
									}
									$shipping_name .= ' (' . $name_value . ')';
								}
								
								$debug .= ' | Name: ' . $rate_name;
								$debug .= ' | Image: ' . $image;
								$debug .= ' | Instruction: ' . $instruction;
								$debug .= ' | Rate Group: ' . $rate['group'];
								
								$key = $rate['group'];
								
								if ($rate['multirate'] == 0) {
									$single_data = array(
										'title'			=> $shipping_name,
										'image'			=> $image,
										'instruction'	=> $instruction,
										'sort_order'	=> $rate['sort_order'],
										'tax_class_id'	=> $rate['tax_class_id'],
										'cost'			=> $cost,
										'code'			=> $rate['rate_id'],
									);
									$quote_data[$this->extension . '_' . $rate['rate_id']] = $this->getQuoteData($single_data, $rate['currency']);
									$debug .= ' | Calculation Method: SINGLE';
								} elseif ($rate['multirate'] == 1) {
									if (isset($sum_data[$key])) {
										$sum_data[$key]['tax_class_id'] = $rate['tax_class_id'];
										$sum_data[$key]['cost'] += $cost;
										if ($this->getField('title_display') == 1) {
											$sum_data[$key]['title'] 		= $shipping_name;
											$sum_data[$key]['image'] 		= $image;
											$sum_data[$key]['instruction'] 	= $instruction;
										} elseif ($this->getField('title_display') == 2) {
											$sum_data[$key]['title'] 		.= ' + ' . $rate_name;
											$sum_data[$key]['image'] 		= '';
											$sum_data[$key]['instruction'] 	= '';
										} elseif ($this->getField('title_display') == 3) {
											$sum_data[$key]['title'] 		.= ' + ' . $rate_name . '(' . $this->currency->format($this->tax->calculate($cost, $rate['tax_class_id'], $this->config->get('config_tax'))) . ')';
											$sum_data[$key]['image'] 		= '';
											$sum_data[$key]['instruction'] 	= '';
										}
									} else {
										$sum_data[$key] = array(
											'sort_order' 	=> $rate['sort_order'],
											'tax_class_id' 	=> $rate['tax_class_id'],
											'cost'			=> $cost,
											'code'			=> $rate['rate_id'],
										);
										if ($this->getField('title_display') == 2) {
											$sum_data[$key]['title'] 		= $rate_name;
											$sum_data[$key]['image'] 		= '';
											$sum_data[$key]['instruction'] 	= '';
										} elseif ($this->getField('title_display') == 3) {
											$sum_data[$key]['title'] 		= $rate_name . '(' . $this->currency->format($this->tax->calculate($cost, $rate['tax_class_id'], $this->config->get('config_tax'))) . ')';
											$sum_data[$key]['image'] 		= '';
											$sum_data[$key]['instruction'] 	= '';
										} else {
											$sum_data[$key]['title'] 		= $shipping_name;
											$sum_data[$key]['image'] 		= $image;
											$sum_data[$key]['instruction'] 	= $instruction;
										}
									}
									$debug .= ' | Calculation Method: SUM';
								} elseif ($rate['multirate'] == 2) {
									if (isset($avg_data[$key])) {
										$avg_data[$key]['tax_class_id'] = $rate['tax_class_id'];
										$avg_data[$key]['cost'] += $cost;
										$avg_data[$key]['count']++;
										if ($this->getField('title_display') == 1) {
											$avg_data[$key]['title'] 		= $shipping_name;
											$avg_data[$key]['image'] 		= $image;
											$avg_data[$key]['instruction'] 	= $instruction;
										} elseif ($this->getField('title_display') == 2) {
											$avg_data[$key]['title'] 		.= ' + ' . $rate_name;
											$avg_data[$key]['image'] 		= '';
											$avg_data[$key]['instruction'] 	= '';
										} elseif ($this->getField('title_display') == 3) {
											$avg_data[$key]['title'] 		.= ' + ' . $rate_name . '(' . $this->currency->format($this->tax->calculate($cost, $rate['tax_class_id'], $this->config->get('config_tax'))) . ')';
											$avg_data[$key]['image'] 		= '';
											$avg_data[$key]['instruction'] 	= '';
										}
									} else {
										$avg_data[$key] = array(
											'sort_order' 	=> $rate['sort_order'],
											'tax_class_id' 	=> $rate['tax_class_id'],
											'cost'			=> $cost,
											'code'			=> $rate['rate_id'],
											'count'			=> 1
										);
										if ($this->getField('title_display') == 2) {
											$avg_data[$key]['title'] 		= $rate_name;
											$avg_data[$key]['image'] 		= '';
											$avg_data[$key]['instruction'] 	= '';
										} elseif ($this->getField('title_display') == 3) {
											$avg_data[$key]['title'] 		= $rate_name . '(' . $this->currency->format($this->tax->calculate($cost, $rate['tax_class_id'], $this->config->get('config_tax'))) . ')';
											$avg_data[$key]['image'] 		= '';
											$avg_data[$key]['instruction'] 	= '';
										} else {
											$avg_data[$key]['title'] 		= $shipping_name;
											$avg_data[$key]['image'] 		= $image;
											$avg_data[$key]['instruction'] 	= $instruction;
										}
									}
									$debug .= ' | Calculation Method: AVERAGE';
								} elseif ($rate['multirate'] == 3) {
									if (isset($low_data[$key])) {
										if ($low_data[$key]['cost'] > $cost) {
											$low_data[$key]['tax_class_id'] = $rate['tax_class_id'];
											$low_data[$key]['cost'] 		= $cost;
											$low_data[$key]['title'] 		= $shipping_name;
											$low_data[$key]['image'] 		= $image;
											$low_data[$key]['instruction'] 	= $instruction;
										}
									} else {
										$low_data[$key] = array(
											'sort_order' 	=> $rate['sort_order'],
											'tax_class_id' 	=> $rate['tax_class_id'],
											'cost'			=> $cost,
											'code'			=> $rate['rate_id'],
										);
										$low_data[$key]['title'] 		= $shipping_name;
										$low_data[$key]['image'] 		= $image;
										$low_data[$key]['instruction'] 	= $instruction;
									}
									$debug .= ' | Calculation Method: LOWEST';
								} elseif ($rate['multirate'] == 4) {
									if (isset($high_data[$key])) {
										if ($high_data[$key]['cost'] < $cost) {
											$high_data[$key]['tax_class_id'] 	= $rate['tax_class_id'];
											$high_data[$key]['cost'] 			= $cost;
											$high_data[$key]['title'] 			= $shipping_name;
											$high_data[$key]['image'] 			= $image;
											$high_data[$key]['instruction'] 	= $instruction;
										}
									} else {
										$high_data[$key] = array(
											'sort_order' 	=> $rate['sort_order'],
											'tax_class_id' 	=> $rate['tax_class_id'],
											'cost'			=> $cost,
											'code'			=> $rate['rate_id'],
										);
										$high_data[$key]['title'] 		= $shipping_name;
										$high_data[$key]['image'] 		= $image;
										$high_data[$key]['instruction'] = $instruction;
									}
									$debug .= ' | Calculation Method: HIGHEST';
								} else {
									$single_data = array(
										'title'			=> $shipping_name,
										'image'			=> $image,
										'instruction'	=> $instruction,
										'sort_order'	=> $rate['sort_order'],
										'tax_class_id'	=> $rate['tax_class_id'],
										'cost'			=> $cost,
										'code'			=> $rate['rate_id'],
									);
									$quote_data[$this->extension . '_' . $rate['rate_id']] = $this->getQuoteData($single_data, $rate['currency']);
									$debug .= ' | Calculation Method: NOT FOUND - SINGLE USED';
								}
							}
						}
					} else {
						if (!$this->debugStatus) { continue; }
						$debug .= ' | RateStatus: DISABLED';
					}
					if ($this->debugStatus) {
						$this->writeDebug($debug);
					}
					
					$rate_row++;
				}
			}
			
			if (!empty($sum_data)) {
				foreach ($sum_data as $key => $value) {
					$quote_data[$this->extension . '_' . $value['code']] = $this->getQuoteData($value, $rate['currency']);
				}
			}
			
			if (!empty($avg_data)) {
				foreach ($avg_data as $key => $value) {
					$value['cost'] = $value['cost'] / $value['count'];
					$quote_data[$this->extension . '_' . $value['code']] = $this->getQuoteData($value, $rate['currency']);
				}
			}
			
			if (!empty($low_data)) {
				foreach ($low_data as $key => $value) {
					$quote_data[$this->extension . '_' . $value['code']] = $this->getQuoteData($value, $rate['currency']);
				}
			}
			
			if (!empty($high_data)) {
				foreach ($high_data as $key => $value) {
					$quote_data[$this->extension . '_' . $value['code']] = $this->getQuoteData($value, $rate['currency']);
				}
			}
						
			if ($quote_data) {
				foreach ($quote_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
					$sort_cost[$key] = $value['value'];
				}
				
				if ($this->getField('sort_quotes') == 0) {
					array_multisort($sort_order, SORT_ASC, $quote_data);
				} elseif ($this->getField('sort_quotes') == 1) {
					array_multisort($sort_order, SORT_DESC, $quote_data);
				} elseif ($this->getField('sort_quotes') == 2) {
					array_multisort($sort_cost, SORT_ASC, $quote_data);
				} elseif ($this->getField('sort_quotes') == 3) {
					array_multisort($sort_cost, SORT_DESC, $quote_data);
				} else {
					array_multisort($sort_order, SORT_ASC, $quote_data);
				}
				
				//$this->load->language($this->type . '/' . $this->extension);
				
				$title = $this->getField('title');
				$title = !empty($title[$language_code]) ? $title[$language_code] : $this->language->get('text_title');
				
				$method_data = array(
					'id'       		=> $this->extension,
					'code'       	=> $this->extension,
					'title'      	=> $title,
					'quote'      	=> $quote_data,
					'sort_order' 	=> $this->getField('sort_order'),
					'error'      	=> false
				);
			}
			return $method_data;
		} else {
			$this->load->language($this->type . '/' . $this->extension);
			$debug  = $this->language->get('text_title');
			$debug .= ' | FAILED TO INITIALIZE';
			if ($this->getField('status')) {
				$debug .= ' | ExtensionStatus: ENABLED';
			} else {
				$debug .= ' | ExtensionStatus: DISABLED';
			}
			if ($this->getRates()) {
				$debug .= ' | Rates: EMPTY';
			} else {
				$debug .= ' | Rates: ' . count($this->getRates()) . ' FOUND';
			}
			if ($this->cart->hasProducts()) {
				$debug .= ' | ProductsInCart: EMPTY';
			} else {
				$debug .= ' | ProductsInCart: ' . count($this->cart->hasProducts()) . ' FOUND';
			}
			if ($address) {
				$debug .= ' | CustomerAddress: NOT FOUND';
			} else {
				$debug .= ' | CustomerAddress: FOUND';
			}
			if ($this->debugStatus) {
				$this->writeDebug($debug);
			}
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
	
	private function getRates() {
		$rates = array();
		if ($this->cache->get($this->type . $this->extension)) {
			$rates = $this->cache->get($this->type . $this->extension);
		}	
		if (!$rates) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . $this->db_table . " WHERE status = '1' ORDER BY sort_order, rate_id ASC");
			$rates = $query->rows;
			$this->cache->set($this->type . $this->extension, $rates);
		}	
		return $rates;
	}

	private function getField($field) {
		$key = $this->config->get($this->extension . '_' . $field);
		if (is_string($key) && strpos($key, 'a:') === 0) {
			$value = unserialize($key);
		} else {
			$value = $key;
		}
		return $value;
	}	
	
	private function getValue($value) {
		if (is_string($value) && strpos($value, 'a:') === 0) {
			$value = unserialize($value);
		}
		return $value;
	}
	
	private function getTotal ($rate) {
		$total_data = array();					
		$total = 0;
		$taxes = $this->cart->getTaxes();
		
		if (isset($rate['total_type'])) {
			if ($rate['total_type'] == 1) {
				$total = $this->cart->getSubTotal();
			} elseif ($rate['total_type'] == 2) {
				$total = $this->cart->getTotal();
			} else {
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					if ($this->getVersion() >= 200) {
						$this->load->model('extension/extension');
						$results = $this->model_extension_extension->getExtensions('total');
					} else {
						$this->load->model('setting/extension');
						$results = $this->model_setting_extension->getExtensions('total');
					}
					$sort_order = array();
					foreach ($results as $key => $value) {
						$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
					}
					array_multisort($sort_order, SORT_ASC, $results);
					foreach ($results as $result) {
						if ($result['code'] == 'shipping') {
							break;
						} else {
							if ($this->config->get($result['code'] . '_status')) {
								$this->load->model('total/' . $result['code']);
					
								$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
							}
						}
					}
				}
			}
		}
		if ($rate['currency'] !== $this->config->get('config_currency')) {
			$total = $this->currency->convert($total, $this->config->get('config_currency'), $rate['currency']);
		}
		return (float)$total;
	}
	
	private function getQuantity() {
		$quantity = 0;
	
    	foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {
				$quantity += $product['quantity'];
			}
		}
		return (int)$quantity;
	}
	
	private function getWeight() {
		$weight = 0;
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {
				$weight += $this->weight->convert($product['weight'], $product[$this->getWeightClass()], $this->config->get('config_' . $this->getWeightClass()));
			}
		}
		return (float)$weight;
	}
	
	private function getDimensionalWeight($rate) {
		$dimweight = 0;
	
    	foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {				
				$length = $this->length->convert($product['length'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				$width = $this->length->convert($product['width'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				$height = $this->length->convert($product['height'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				
				$types = array('length', 'width', 'height');
				
				foreach ($types as $type) {				
					if ($rate['product_' . $type]['add']) {
						if (strpos($rate['product_' . $type]['add'], '%')) {
							${$type} += ${$type} * ($rate['product_' . $type]['add'] / 100);
						} else {
							${$type} += $rate['product_' . $type]['add'];
						}
					}
				}
				
				$volume = ($length * $width * $height) * $product['quantity'];
				$weight = $this->weight->convert($product['weight'], $product[$this->getWeightClass()], $this->config->get('config_' . $this->getWeightClass()));
				
				if (($volume / $rate['shipping_factor']) > $weight) {
					$dimweight += $volume / $rate['shipping_factor'];
				} else {
					$dimweight += $weight;
				}
			}
		}
		return (float)$dimweight;
	}
	
	private function getVolume($rate) {
		$volume = 0;
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {
      			$length = $this->length->convert($product['length'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				$width = $this->length->convert($product['width'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				$height = $this->length->convert($product['height'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
				
				$types = array('length', 'width', 'height');
				
				foreach ($types as $type) {				
					if ($rate['product_' . $type]['add']) {
						if (strpos($rate['product_' . $type]['add'], '%')) {
							${$type} += ${$type} * ($rate['product_' . $type]['add'] / 100);
						} else {
							${$type} += $rate['product_' . $type]['add'];
						}
					}
				}
				
				$volume += ($length * $width * $height) * $product['quantity'];
			}
		}
		return (float)$volume;
	}
	
	private function getDistance($origin, $destination) {
		$distance = 0;

		if ($origin && $destination) {
			$directions = $this->getDirections($origin['origin'], $destination);
			if ($directions) {
				return (float)$directions['value'];
			} else {
				$geocode = $this->getGeoCode($destination);
				if ($geocode) {
					$r 		= 6371;
					$lat1	= deg2rad($origin['lat']);
					$lat2	= deg2rad($geocode['lat']);
					$lng1	= deg2rad($origin['lng']);
					$lng2	= deg2rad($geocode['lng']);
					$dlat	= $lat2 - $lat1;
					$dlng	= $lng2 - $lng1;
					$a		= sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlng/2) * sin($dlng/2);
					$c		= 2 * atan2(sqrt($a), sqrt(1-$a));
					$distance = $r * $c;
					return (float)$distance;
				}
			}
		}
		return (float)$distance;
	}
	
	private function getDirections($origin, $destination) {		
		$url = 'https://maps.googleapis.com/maps/api/directions/xml?origin=' . $origin . '&destination=' . $destination . '&sensor=false';
		$response = simplexml_load_file($url);
		if (isset($response->status) && $response->status == 'OK' && isset($response->route->leg->distance)) {
			return array(
				'value'	=> $response->route->leg->distance->value / 1000,
				'text'	=> $response->route->leg->distance->text
			);
		} else {
			return false;
		}
	}
	
	private function getGeoCode($destination) {
		$url = 'https://maps.googleapis.com/maps/api/geocode/xml?address=' . $destination . '&sensor=false';
		$response = simplexml_load_file($url);
		if (isset($response->status) && $response->status == 'OK') {
			return array(
				'lat'	=> (float)$response->result->geometry->location->lat,
				'lng'	=> (float)$response->result->geometry->location->lng
			);
		} else {
			return false;
		}
	}
	
	private function getDimensions($rate) {
		$length = 0;
		$width 	= 0;
		$height = 0;
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {	
				$types = array('length', 'width', 'height');
				foreach ($types as $type) {
					if ($rate['product_' . $type]['add']) {
						if (strpos($rate['product_' . $type]['add'], '%')) {
							${$type} += ($this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * $product['quantity']) * ($rate['product_' . $type]['add'] / 100);
						} else {
							${$type} += ($this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * $product['quantity']) + $rate['product_' . $type]['add'];
						}
					} else {
						${$type} += $this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * $product['quantity'];
					}
				}
			}
		}
		return array(
			'length' => (float)$length,
			'width'	 => (float)$width,
			'height' => (float)$height
		);
	}
	
	private function getValueAdd($value, $type, $rate) {
		if ($rate['cart_' . $type]['add']) {
			if (strpos($rate['cart_' . $type]['add'], '%')) {
				$value += $value * ($rate['cart_' . $type]['add'] / 100);
			} else {
				$value += $rate['cart_' . $type]['add'];
			}
		}
		return (float)$value;
	}
	
	private function getWeightClass() {
		return 'weight_class_id';
	}
	
	private function getLengthClass() {
		return 'length_class_id';
	}
	
	private function excludeProduct($cost_setting, $categories, $currency) {
		$total 		= 0;	
		$quantity 	= 0;
		$weight 	= 0;
		$volume 	= 0;
		$length 	= 0;
		$width		= 0;
		$height		= 0;
		
		$this->load->model('catalog/product');
		
		foreach ($this->cart->getProducts() as $product) {
			$exclude_product = false;
			
			if ($categories) {
				$product_categories = $this->model_catalog_product->getCategories($product['product_id']);
				if ($product_categories) {
					$cat_status = false;
					foreach ($product_categories as $product_category) {
						if (in_array($product_category['category_id'], $categories)) {
							$cat_status = true;
							break;
						}
					}
					if ((!$cat_status && $cost_setting == 1) || ($cat_status && $cost_setting == 2)) {
						$exclude_product = true;
					}
				} 
			}
			
			if ($exclude_product) {
				$total += $product['total'];
				$quantity += $product['quantity'];
				$weight += $this->weight->convert($product['weight'], $product[$this->getWeightClass()], $this->config->get('config_' . $this->getWeightClass()));
				$volume += ($this->length->convert($product['length'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * $this->length->convert($product['width'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * $this->length->convert($product['height'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()))) * $product['quantity'];
				$length += ($this->length->convert($product['length'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()))) * $product['quantity'];
				$width += ($this->length->convert($product['width'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()))) * $product['quantity'];
				$height += ($this->length->convert($product['height'], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()))) * $product['quantity'];
			}
		}
		if ($currency !== $this->config->get('config_currency')) {
			$total = $this->currency->convert($total, $this->config->get('config_currency'), $currency);
		}
		return array(
			'total'		=> (float)$total,
			'quantity'	=> (int)$quantity,
			'weight'	=> (float)$weight,
			'volume'	=> (float)$volume,
			'length'	=> (float)$length,
			'width'		=> (float)$width,
			'height'	=> (float)$height
		);
	}
	
	private function checkValue($value, $type, $rate) {
		$value	= (float)$value;
		$min 	= (float)$rate['cart_' . $type]['min'];
		$max 	= (float)$rate['cart_' . $type]['max'];
		
		if ($min && $value < $min) {
			return false;
		}
		if ($max && $value > $max) {
			return false;
		}
		return true;
	}
	
	private function checkDateTime($rate) {
		$status = true;
		$debug 	= '';
		
		$days = isset($rate['days']) ? $rate['days'] : array();
		if ($days) {
			if (!in_array(date("w"), $days)) {
				$status = false;
				$debug .= ' | Days: FAILED';
			}
		}
		if ($rate['time']['start']) {
			if ($rate['time']['start'] > date("H:i")) {
				$status = false;
				$debug .= ' | TimeStart: FAILED';
			}
		}
		if ($rate['time']['end']) {
			if ($rate['time']['end'] < date("H:i")) {
				$status = false;
				$debug .= ' | TimeEnd: FAILED';
			}
		}
		if ($rate['date']['start']) {
			if ($rate['date']['start'] > date("Y-m-d H:i:s") || !$rate['date']['start'] == "0000-00-00") {
				$status = false;
				$debug .= ' | DateStart: FAILED';
			}
		}
		if ($rate['date']['end']) {
			if ($rate['date']['end'] < date("Y-m-d H:i:s") || !$rate['date']['end'] == "0000-00-00") {
				$status = false;
				$debug .= ' | DateEnd: FAILED';
			}
		}
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkProducts($rate) {
		$status = true;
		$debug	= '';
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['shipping']) {	
				$types = array('length', 'width', 'height');
				foreach ($types as $type) {
					if ($rate['product_' . $type]['add']) {
						if (strpos($rate['product_' . $type]['add'], '%')) {
							${$type} = $this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) * ($rate['product_' . $type]['add'] / 100);
						} else {
							${$type} = $this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass())) + $rate['product_' . $type]['add'];
						}
					} else {
						${$type} = $this->length->convert($product[$type], $product[$this->getLengthClass()], $this->config->get('config_' . $this->getLengthClass()));
					}
				}
				
				foreach ($types as $type) {
					if ($rate['product_' . $type]['min']) {
						if (${$type} < $rate['product_' . $type]['min']) {
							$status = false;
							$debug .= ' | Product' . ucfirst($type) . 'Min: FAILED';
							break;
						}
					}
					
					if ($rate['product_' . $type]['max']) {
						if (${$type} > $rate['product_' . $type]['max']) {
							$status = false;
							$debug .= ' | Product' . ucfirst($type) . 'Max: FAILED';							
							break;
						}
					}
				}
			}
		}
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkCategories($categories, $rate) {
		$status = true;
		$debug	= '';
		
		if ($categories && !in_array(0, $categories) && $rate['category_match'] !== 4) {
			$this->load->model('catalog/product');
			
			if ($rate['category_match'] == 3) {
				$cat_array = array();
				foreach ($this->cart->getProducts() as $product) {
					$product_categories = $this->model_catalog_product->getCategories($product['product_id']);
					if ($product_categories) {
						foreach ($product_categories as $product_category) {
							$cat_array[] = $product_category['category_id'];
						}
					}
				}
				foreach ($categories as $category) {
					$cat_status = false;
					if (!in_array($category, $cat_array)) {
						$status = false;
						$debug .= ' | CategoriesMatchAll: FAILED';
						break;
					}
				}
			} else {						
				foreach ($this->cart->getProducts() as $product) {
					$product_categories = $this->model_catalog_product->getCategories($product['product_id']);
					$cat_status = false;
					if ($product_categories) {
						foreach ($product_categories as $product_category) {
							if (in_array($product_category['category_id'], $categories)) {
								$cat_status  = true;
								break;
							}
						}
						if ($cat_status) {
							if ($rate['category_match'] == 1) {
								break;
							} elseif ($rate['category_match'] == 2) {
								$status = false;
								$debug .= ' | CategoriesMatchNone: FAILED';
								break;
							}
						} else {
							if ($rate['category_match'] == 0) {
								$status = false;
								$debug .= ' | CategoriesMatchOnly: FAILED';
								break;
							}
						}
					}
				}
			}
			if (!$cat_status && $rate['category_match'] == 1) {
				$status = false;
				$debug .= ' | CategoriesMatchAny: FAILED';
			}
		} elseif (in_array(0, $categories) && $rate['category_match'] == 2) {
			$status = false;
			$debug .= ' | CategoriesMatchNone: FAILED';
		}
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkStores($rate) {
		$status = true;
		$debug	= '';
		
		$debug .= ' | StoreId: ' . (int)$this->config->get('config_store_id');
		
		$stores = isset($rate['stores']) ? $rate['stores'] : array();
		if (!in_array((int)$this->config->get('config_store_id'), $stores)) {
			$status = false;
		}
		
		if ($stores) {
			$debug .= ' | SelectedStores: ';
			foreach ($stores as $store) {
				$debug .= $store .',';
			}
		}		
		
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkCustomer($customer_group_id, $rate) {
		$status = true;
		$debug	= '';
		
		$debug .= ' | CustomerGroupId: ' . $customer_group_id;
		
		$customer_groups = isset($rate['customer_groups']) ? $rate['customer_groups'] : array();
		if (!in_array(-1, $customer_groups) && !in_array((int)$customer_group_id, $customer_groups)) {
			$status = false;
		}
		
		if ($customer_groups) {
			$debug .= ' | SelectedCustomerGroups: ';
			foreach ($customer_groups as $customer_group) {
				$debug .= $customer_group .',';
			}
		}
		
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkGeoZones($address, $rate) {
		$status = true;
		$debug	= '';
		
		$geo_zones = isset($rate['geo_zones']) ? $rate['geo_zones'] : array();
		
		$zone_status = false;
		$zone_found = false;
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name");
		foreach ($query->rows as $result) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$result['geo_zone_id'] . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			if ($query->num_rows) {
				$zone_found = true;
				if (in_array($result['geo_zone_id'], $geo_zones)) {
					$zone_status = true;
					$debug .= ' | GeoZone: ' . $result['name'];
					break;
				}
			}
		}
		
		if (!$zone_found) {
			if (!in_array(0, $geo_zones)) {
				$status = false;
			} else {
				$debug .= ' | GeoZone: All Other Zones';
			}
		} elseif (!$zone_status) {
			$status = false;
		}
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkCurrencies($currencies) {
		$status = true;
		$debug	= '';
		
		$debug .= ' | CurrencyCode: ' . $this->currency->getCode();
		
		if (!in_array('0', $currencies) && !in_array($this->currency->getCode(), $currencies)) {
			$status = false;
		}
		
		if ($currencies) {
			$debug .= ' | SelectedCurrencies: ';
			foreach ($currencies as $currency) {
				$debug .= $currency .',';
			}
		}
		
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function checkPostalCodes($address, $rate) {
		$status = false;
		$debug	= '';
		$uk_formats	= array();
		
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2})$/',
			'start'	=> 'AA0A0AA',
			'end'	=> 'ZZ9Z9ZZ'
		);
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2})$/',
			'start'	=> 'A0A0AA',
			'end'	=> 'Z9Z9ZZ'
		);
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{1}[0-9]{2}[A-Z]{2})$/',
			'start'	=> 'A00AA',
			'end'	=> 'Z99ZZ'
		);
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{1}[0-9]{3}[A-Z]{2})$/',
			'start'	=> 'A000AA',
			'end'	=> 'Z999ZZ'
		);
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{2}[0-9]{2}[A-Z]{2})$/',
			'start'	=> 'AA00AA',
			'end'	=> 'ZZ99ZZ'
		);
		$uk_formats[]	= array(
			'regex'	=> '/^([A-Z]{2}[0-9]{3}[A-Z]{2})$/',
			'start'	=> 'AA000AA',
			'end'	=> 'ZZ999ZZ'
		);
		
		if ($rate['postcode_ranges']) {
			$ranges = explode(',', $rate['postcode_ranges']);
			
			$postcode = trim(preg_replace('/[\s\-]/', '', strtoupper($address['postcode'])), ' ');
			
			$debug .= ' | PostCode: ' . $postcode;
			
			foreach ($ranges as $range) {
				if (strpos($range, ':')) {
					$values = explode(':', $range);
					if (isset($values[0]) && isset($values[1])) {
						$start 	= trim(preg_replace('/[\s\-]/', '', strtoupper($values[0])), ' ');
						$end 	= trim(preg_replace('/[\s\-]/', '', strtoupper($values[1])), ' ');
						$x 		= (strlen($start) > strlen($end)) ? strlen($start) : strlen($end);
						
						$debug .= ' | PostCodeRangeStart: ' . $start . ' | PostCodeRangeEnd: ' . $end . ' | PostCodeRangeLength: ' . $x;
						
						if ($rate['postcode_type'] == 0) {
							foreach ($uk_formats as $format) {
								if (preg_match($format['regex'], $postcode) && (preg_match($format['regex'], $start) || preg_match($format['regex'], $end))) {
									if (strnatcmp($start, $postcode) <= 0 && strnatcmp($end, $postcode) >= 0) {
										$status = true;
										$debug .= ' | PostCodeRangeFound: ' . trim(preg_replace('/[\s\-]/', '', strtoupper($values[0])), ' ') . ':' . trim(preg_replace('/[\s\-]/', '', strtoupper($values[1])), ' ');
										break;
									}
								}
							}
						} else {
							$modified_postcode = substr($postcode, 0, $x);
							$postcode_validation = $this->validatePostalCode($start, $modified_postcode, $x);
							$debug .= $postcode_validation['debug'];
							if ($postcode_validation['status']) {
								if (strnatcmp($start, $modified_postcode) <= 0 && strnatcmp($end, $modified_postcode) >= 0) {
									$status = true;
									$debug .= ' | PostCodeRangeFound: ' . trim(strtoupper($values[0]), ' ') . ':' . trim(strtoupper($values[1]), ' ');
									break;
								}
							}
						}
					}
				} else {
					$value = trim(preg_replace('/[\s\-]/', '', strtoupper($range)), ' ');
					if ($value === $postcode) {
						$status = true;
						break;
					}
				}
			}
			if ($status && $rate['postcode_method'] == 1) {
				$debug .= ' | PostCodeMethod: ALLOW';
			} elseif ($status && $rate['postcode_method'] == 0) {
				$debug .= ' | PostCodeMethod: DENY';
				$status = false;
			} elseif (!$status && $rate['postcode_method'] == 0) {
				$debug .= ' | PostCodeMethod: DENY';
				$debug .= ' | PostCodeRangeFound: FALSE';
				$status = true;
			} else {
				$debug .= ' | PostCodeRangeFound: FALSE';
			}
		} else {
			$debug .= ' | PostCodeRanges: NOT SET';
			$status = true;
		}
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}
	
	private function validatePostalCode($start = 0, $postcode = 0, $x = 0) {
		$debug 		= '';
		$debug 		.= ' | PostCode: ' . $postcode;
		
		$start 		= str_split($start);
		$postcode 	= str_split($postcode);
		$i 			= 0;
		
		$status = false;		
		if ($start && $postcode && $x) {
			while ($i <= ($x - 1)) {
				$a	= isset($start[$i]) ? $start[$i] : 0;
				$b 	= isset($postcode[$i]) ? $postcode[$i] : 0;
				
				if (is_numeric($a) && is_numeric($b)) {
					$status = true;
				} elseif (!is_numeric($a) && !is_numeric($b)) {
					$status = true;
				} elseif ($a == $b) {
					$status = true;
				} else {
					$status = false;
					break;
				}
				$i ++;
			}
		}
		
		$debug .= ($status) ? ' | PostCodeValidation: PASSED' : ' | PostCodeValidation: FAILED';
		
		return array(
			'status'	=> $status,
			'debug'		=> $debug
		);
	}	
	
	private function getRateMax($rates) {
		$max 	= 0;
		$rates 	= explode(',', $rates);
	
		foreach ($rates as $rate) {
			$rate 	= trim($rate);
			$data 	= explode(':',$rate);
			$max	= $data[0];
		}
		return $max;
	}
	
	private function getRateSingle($value, $rates, $total) {
		$rate_formula_1 = '/^([0-9.]+|~):([0-9.%]+)$/';
		$rate_formula_2 = '/^([0-9.]+|~):([0-9.%]+)\+([0-9.%]+)$/';
		$rate_formula_3 = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)$/';
		$rate_formula_4 = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)\+([0-9.%]+)$/';
		
		$cost 	= '';
		$debug	= '';
		$rates 	= explode(',', $rates);
	
		foreach ($rates as $rate) {
			$rate = trim($rate);
			$a = false;
			$b = false;
			$c = false;
			$d = 0;
			if (preg_match($rate_formula_1, $rate)) {
				$data 	= explode(':',$rate);
				$a		= $data[0];
				$b		= $data[1];
			} elseif (preg_match($rate_formula_2, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('+', $data[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$d		= $data2[1];
			} elseif (preg_match($rate_formula_3, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('/', $data[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$c		= $data2[1];
			} elseif (preg_match($rate_formula_4, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('/', $data[1]);
				$data3 	= explode('+', $data2[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$c		= $data3[0];
				$d		= $data3[1];
			}
			if (strpos($b, '%')) {
				$b = $total * ($b / 100);
			}
			if (strpos($d, '%')) {
				$d = $total * ($d / 100);
			}
			if ($a >= $value || $a == '~') {
				if ($b && $c) {
					$cost = ceil($value / $c) * $b;
				} else {
					$cost = $b;
				}
				$cost += $d;
				$debug .= ' | RatesFound: SUCCESS (' . $rate . ')';
				$debug .= ' | RateCost: ' . $cost;
				break;
			}
		}
		return array(
			'cost'	=> $cost,
			'debug'	=> $debug
		);
	}
	
	private function getRateCumulative($value, $rates, $total) {
		$rate_formula_1 = '/^([0-9.]+|~):([0-9.%]+)$/';
		$rate_formula_2 = '/^([0-9.]+|~):([0-9.%]+)\+([0-9.%]+)$/';
		$rate_formula_3 = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)$/';
		$rate_formula_4 = '/^([0-9.]+|~):([0-9.%]+)\/([0-9.]+)\+([0-9.%]+)$/';
		
		$cost 			= '';
		$debug			= '';
		$rates 			= explode(',', $rates);
		$prev 			= 0;
		$max_found		= false;
		
		foreach ($rates as $rate) {
			$rate = trim($rate);
			$a = false;
			$b = false;
			$c = false;
			$d = 0;
			if (preg_match($rate_formula_1, $rate)) {
				$data 	= explode(':',$rate);
				$a		= $data[0];
				$b		= $data[1];
			} elseif (preg_match($rate_formula_2, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('+', $data[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$d		= $data2[1];
			} elseif (preg_match($rate_formula_3, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('/', $data[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$c		= $data2[1];
			} elseif (preg_match($rate_formula_4, $rate)) {
				$data 	= explode(':', $rate);
				$data2 	= explode('/', $data[1]);
				$data3 	= explode('+', $data2[1]);
				$a		= $data[0];
				$b		= $data2[0];
				$c		= $data3[0];
				$d		= $data3[1];
			}
			if (strpos($b, '%')) {
				$b = $total * ($b / 100);
			}
			if (strpos($d, '%')) {
				$d = $total * ($d / 100);
			}
			if ($a < $value && $a !== '~') {
				if ($b && $c) {
					$cost += ceil(($a - $prev) / $c) * $b;
				} else {
					$cost += $b;
				}
				$cost += $d;
				$debug .= ' | RatesFound: SUCCESS (' . $rate . ')';
				$debug .= ' | RateCost: ' . $cost;
				$prev = $a;
			} else {
				if ($b && $c) {
					$cost += ceil(($value - $prev) / $c) * $b;
				} else {
					$cost += $b;
				}
				$cost += $d;
				$debug .= ' | RatesFound: SUCCESS (' . $rate . ')';
				$debug .= ' | RateCost: ' . $cost;
				$max_found = true;
				break;
			}
		}
		if (!$max_found) {
			$cost	= '';
			$debug 	= ' | RatesFound: VALUE EXCEEDS MAX RATE';
		}
		return array(
			'cost'	=> $cost,
			'debug'	=> $debug
		);
	}
	
	private function getQuoteData($data, $currency) {
		if ($currency !== $this->config->get('config_currency')) {
			$data['cost'] = $this->currency->convert($data['cost'], $currency, $this->config->get('config_currency'));
		}
		return array(
			'id'		   => $this->extension . '.' . $this->extension . '_' . $data['code'],
			'code'		   => $this->extension . '.' . $this->extension . '_' . $data['code'],
			'title'        => $data['title'],
			'image'        => $data['image'],
			'instruction'  => $data['instruction'],
			'cost'         => $data['cost'],
			'value'        => $data['cost'],
			'text'         => $this->currency->format($this->tax->calculate($data['cost'], $data['tax_class_id'], $this->config->get('config_tax'))),
			'sort_order'   => $data['sort_order'],
			'tax_class_id' => $data['tax_class_id']
		);
	}
	
	private function writeDebug($debug) {
		$write 	= date('Y-m-d h:i:s');
		$write .= ' - ';
		$write .= $debug;
		$write .= "\n";
		
		$file	= DIR_LOGS . $this->extension . '.txt';
		
		file_put_contents ($file, $write, FILE_APPEND);
	}
}
?>