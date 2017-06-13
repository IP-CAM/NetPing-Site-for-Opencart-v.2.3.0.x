<?php  
class ControllerExtensionModulePavcustom extends Controller {
	
	private $mdata = array();

	public function index($setting) {
		$this->load->language('extension/module/pavcustom');

		$this->mdata['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

		$description = isset( $setting['description'][$this->config->get('config_language_id')] ) ? $setting['description'][$this->config->get('config_language_id')]:"";
		$title = isset( $setting['module_title'][$this->config->get('config_language_id')] ) ? $setting['module_title'][$this->config->get('config_language_id')]:"";

		$this->mdata['message'] = html_entity_decode($description,  ENT_QUOTES, 'UTF-8'  ) ;

		$show_title = isset($setting['show_title'])?$setting['show_title']:1;
		$this->mdata['title'] = "";
		if($show_title){
			$this->mdata['title'] = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		}
		$this->mdata['module_class'] = isset($setting['module_class'])? " ".$setting['module_class']:"";
		
		$template = 'extension/module/pavcustom';
		return $this->load->view($template, $this->mdata);
	}
}
?>