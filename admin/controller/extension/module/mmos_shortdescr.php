<?php

class ControllerExtensionModulemmosshortdescr extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/module/mmos_shortdescr');
        $this->document->setTitle($this->language->get('heading_title1'));
        $this->load->model('setting/setting');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {


            $this->model_setting_setting->editSetting('mmos_shortdescr', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/mmos_shortdescr', 'token=' . $this->session->data['token'], 'SSL'));
        }

        //WWw.MMOsolution.com config data -- DO NOT REMOVE--- 
        $data['MMOS_version'] = '2.1';
        $data['MMOS_code_id'] = 'MMOSOC140';

        $data['heading_title'] = $this->language->get('heading_title1');

        // option setting
        $data['mmos_shortdescr_accept'] = array('maxdescr' => 'text', 'richtext' => 'checkbox', 'featured' => 'checkbox', 'bestseller' => 'checkbox', 'latest' => 'checkbox', 'specials' => 'checkbox', 'pcategory' => 'checkbox', 'pmanafacturer' => 'checkbox', 'pspecial' => 'checkbox', 'psearch' => 'checkbox', 'pcompare' => 'checkbox', 'prelated' => 'checkbox', 'pproduct' => 'checkbox');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['text_form'] = $this->language->get('text_form');

        $data['entry_option_show'] = $this->language->get('entry_option_show');
        $data['text_status'] = $this->language->get('text_status');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['tab_support'] = $this->language->get('tab_support');
        $data['tab_setting'] = $this->language->get('tab_setting');

        $data['entry_setting'] = $this->language->get('entry_setting');
        $data['entry_value'] = $this->language->get('entry_value');

        $language_option = array();
        foreach ($data['mmos_shortdescr_accept'] as $key => $value) {
            $language_option[$key] = $this->language->get('text_option_' . $key);
        }
        $data['language_option'] = $language_option;

        //
        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $data['mmos_shortdescr'] = $this->request->post['mmos_shortdescr'];
        } else {
            $data['mmos_shortdescr'] = $this->config->get('mmos_shortdescr');
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }





        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title1'),
            'href' => $this->url->link('extension/module/mmos_shortdescr', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/module/mmos_shortdescr', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL');

        $data['token'] = $this->session->data['token'];



        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/mmos_shortdescr.tpl', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/mmos_shortdescr')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function uninstall() {
       
            $this->load->model('catalog/mmos_shortdescr');
           // $this->model_catalog_mmos_shortdescr->uninstall();
            $this->load->model('setting/setting');
            $this->model_setting_setting->deleteSetting('mmos_shortdescr');
           
        
    }

    public function install() {
 
            $this->load->model('catalog/mmos_shortdescr');
            $this->model_catalog_mmos_shortdescr->install();

            // initial variable
            $initial = array();
            $initial['mmos_shortdescr'] = array(
                'status' => 0,
                'maxdescr' => 200,
                'richtext' => 0,
                'featured' => 1,
                'bestseller' => 1,
                'latest' => 1,
                'specials' => 1
            );


            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('mmos_shortdescr', $initial);
           $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', 'SSL'));
        
    }
    

}

?>