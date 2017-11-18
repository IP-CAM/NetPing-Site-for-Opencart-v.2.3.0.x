<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');


global $modulesPath;
global $marketPath;
global $breadcrumbsPath;

if (version_compare(VERSION,'2.3','>=')) { //newer than 2.2.x
    $modulesPath = 'extension/module';
    $breadcrumbsPath = 'extension';
    $englishPath = 'en-gb';
    if (version_compare(VERSION,'3','>=')) {
        $marketPath = 'marketplace';
    } else {
        $marketPath = 'extension';
    }
} else {
    $breadcrumbsPath = $modulesPath = 'module';
    $marketPath = 'extension';
    $englishPath = 'english';
}

require_once (DIR_APPLICATION . 'controller/'.$modulesPath.'/magicthumb-opencart-module/module.php');

$tool = & magicthumb_load_core_class();



class ControllerModuleMagicThumb extends Controller {
    private $error = array();
    private $params = array();
    
    public $style = '<style type="text/css">
          .fa-check:before { font-weight:bold; color:green; font-size:16px; } 
          .fa-close { font-weight:bold; color:red; font-size:16px; }
          .fixed .buttons {
            margin-right: 25px !important;
            right: 0% !important;
        }
        .fixed{
              border-radius: 0 0 0 0 !important;
              left: 0;
              position: fixed;
              top: -20px;
              width: 100%;
              background: white;
              z-index: 9999999;
              padding-top: 10px;
              border-bottom: 1px solid lightgray;
        }
      </style>';

    public $script = '<script type="text/javascript">
    $(document).ready(function() {
        var headingTop = $(\'.page-header\').position().top;
        console.log(headingTop);
        $(window).scroll(function() {
            if(headingTop >= $(window).scrollTop()) {
                if($(\'.page-header\').hasClass(\'fixed\')) {
                    $(\'.page-header\').removeClass(\'fixed\');
                }
            } else { 
                if(!$(\'.page-header\').hasClass(\'fixed\')) {
                    $(\'.page-header\').addClass(\'fixed\');
                }
            }
        });
    });
    </script>';

    public $blocks = array(
		'default' => 'General',
		'product' => 'Product page',
		'category' => 'Category page',
		'search' => 'Search results page',
		'manufacturers' => 'Manufacturers page',
		'bestseller' => 'Bestsellers block',
		'special' => 'Specials block',
		'featured' => 'Featured block',
		'latest' => 'Latest block',
	);
    public $map = array(
		'default' => array(
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'right-thumb-max-width',
				'right-thumb-max-height',
				'left-thumb-max-width',
				'left-thumb-max-height',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'headers-on-every-page',
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
				'imagemagick',
				'image-quality',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Watermark' => array(
				'watermark',
				'watermark-max-width',
				'watermark-max-height',
				'watermark-opacity',
				'watermark-position',
				'watermark-offset-x',
				'watermark-offset-y',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'product' => array(
			'General' => array(
				'page-status',
				'template',
				'magicscroll',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Multiple images' => array(
				'selector-max-width',
				'selector-max-height',
				'selectors-margin',
				'selectorTrigger',
				'selectorEffect',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
			'Scroll' => array(
				'width',
				'height',
				'orientation',
				'mode',
				'items',
				'speed',
				'autoplay',
				'loop',
				'step',
				'arrows',
				'pagination',
				'easing',
				'scrollOnWheel',
				'lazy-load',
				'scroll-extra-styles',
				'show-image-title',
			),
		),
		'category' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'search' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'manufacturers' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'bestseller' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'right-thumb-max-width',
				'right-thumb-max-height',
				'left-thumb-max-width',
				'left-thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'special' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'right-thumb-max-width',
				'right-thumb-max-height',
				'left-thumb-max-width',
				'left-thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'featured' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'right-thumb-max-width',
				'right-thumb-max-height',
				'left-thumb-max-width',
				'left-thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
		'latest' => array(
			'General' => array(
				'page-status',
			),
			'Positioning and Geometry' => array(
				'thumb-max-width',
				'thumb-max-height',
				'right-thumb-max-width',
				'right-thumb-max-height',
				'left-thumb-max-width',
				'left-thumb-max-height',
				'square-images',
			),
			'Expanded view' => array(
				'expandEffect',
				'expandSpeed',
				'expandImageSize',
				'expandTrigger',
				'expandAlign',
				'expandEasing',
				'gallerySpeed',
			),
			'Title and Caption' => array(
				'show-caption',
				'captionPosition',
			),
			'Miscellaneous' => array(
				'link-to-product-page',
				'z-index',
				'keyboard',
				'cssClass',
				'rightClick',
				'lazyLoad',
				'autostart',
			),
			'Buttons' => array(
				'buttons',
				'textBtnClose',
				'textBtnNext',
				'textBtnPrev',
			),
			'Hint' => array(
				'hint',
				'textClickHint',
				'textHoverHint',
			),
			'Mobile' => array(
				'slideMobileEffect',
				'textClickHintForMobile',
			),
		),
	);

    public function index () {
    
            global $modulesPath;
            global $breadcrumbsPath;
            global $marketPath;
            
            $tool = $GLOBALS["magictoolbox"]["magicthumb"];
            $shop_dir = str_replace('system/', '', DIR_SYSTEM);
            $image_dir = str_replace($shop_dir, '', DIR_IMAGE);
            $pathToCache = '/'.$image_dir.'magictoolbox_cache';

            $this->language->load($modulesPath.'/magicthumb'); // load lang. file
            $this->load->model('setting/setting');

            if (method_exists($this->document, 'setTitle')) {
                $this->document->setTitle($this->language->get('title'));
            } else {
                $this->document->title = $this->language->get('title'); //load title
            }

            $this->load->model('setting/setting');

            if (isset($this->session->data['token'])) {
                $tokenName = 'token';
                $token = $this->session->data['token'];
                $tokenUrl = 'token='.$this->session->data['token'];
            } 
            if (isset($this->session->data['user_token'])) { // OpenCart 3 and above   
                $tokenName = 'user_token';
                $token = $this->session->data['user_token']; 
                $tokenUrl = 'user_token='.$this->session->data['user_token'];
            } 
            
            $extension_data['token_url'] = $tokenUrl;
            if (!isset($this->session->data['refresh_modifications'])) {
                $extension_data['refresh_modifications'] = false;
            } else {
                unset($this->session->data['refresh_modifications']);
                $extension_data['refresh_modifications'] = true;
            }

            if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
                if(isset($this->request->post['clear_cache']) && $this->request->post['clear_cache'] == '1') {
                    //clear cache
                    $this->params = $this->model_setting_setting->getSetting('magicthumb');//load settings from DB
                    foreach ($tool->params->getParams() as $param => $values) {
                        if (isset($this->params[$values['id']])) {
                            $tool->params->setValue($values['id'],$this->params[$values['id']]);
                        }
                    }

                    require_once(DIR_APPLICATION . 'controller/'.$modulesPath.'/magicthumb-opencart-module/magictoolbox.imagehelper.class.php');

                    $imagehelper = new MagicToolboxImageHelperClass($shop_dir, $pathToCache, $tool->params);
                    $usedSubCache = $imagehelper->getOptionsHash();
                    if(is_dir($shop_dir.$pathToCache))
                        $this->clearCache($shop_dir.$pathToCache, ($this->request->post['what-clear'] == 'all_items')?null:$usedSubCache);
                } else {
                    //save params
                    unset($this->request->post['clear_cache']);
                    unset($this->request->post['what-clear']);
                    
                    $finalSettings = array('magicthumb_settings' => $this->request->post); //serialize to avoid module name check for each option
                    
                    if ($this->request->post['magicthumb_status'] == '1' && $this->request->post['magicthumb_status'] != $this->request->post['magicthumb_status_was']) { //fire only on activaion
                        $this->session->data['refresh_modifications'] = true;
                    }
                    
                    $this->model_setting_setting->editSetting('magicthumb', $finalSettings);
                    $this->params = $this->model_setting_setting->getSetting('magicthumb');//load settings from DB
                    
                    if (version_compare(VERSION,'2','<')) {
            			$this->session->data['success'] = $this->language->get('text_success');
            			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/module&' . $tokenUrl);
                    } else {
            			$this->session->data['success'] = $this->language->get('text_success');
                        //$this->response->redirect($this->url->link($marketPath.'/'.$breadcrumbsPath, $tokenUrl, 'SSL'));
                        $this->response->redirect($this->url->link($modulesPath.'/magicthumb', $tokenUrl, true));
                    }
                }
            }

            $extension_data['heading_title'] = $this->language->get('heading_title');

            $extension_data['text_enabled'] = $this->language->get('text_enabled');
            $extension_data['text_disabled'] = $this->language->get('text_disabled');

            $extension_data['entry_status'] = $this->language->get('entry_status');

            $extension_data['button_save'] = $this->language->get('button_save');
            $extension_data['button_cancel'] = $this->language->get('button_cancel');
            $extension_data['button_clear'] = $this->language->get('button_clear');
            
            $extension_data['blocks'] = $this->blocks;
	    
            $this->params = $this->model_setting_setting->getSetting('magicthumb');//load settings from DB
            
	    if (isset($this->params['magicthumb_settings'])) {
		  $this->params = $this->params['magicthumb_settings'];
	    } else {
		  $this->params = array();
	    }
	    
	    
	    $defaults = $tool->params->getParams();
	    
	    if (!count($this->params)) { //first time page config loaded after save
		foreach ($this->blocks as $profile_id => $profile_name) {
		    $tool->params->appendParams($defaults,$profile_id);
		}
	    } else {
		foreach ($this->blocks as $profile_id => $profile_name) {
		    foreach ($defaults as $id => $values) {
			if (isset($this->params[$profile_id.'_'.$id])) { //param profile naming
			    $tool->params->setValue($id,$this->params[$profile_id.'_'.$id],$profile_id);
			}
		    }
		}
	    }
	    
	    
	    
            foreach ($tool->params->getParams() as $param => $values) {
                if (isset($this->params[$values['id']])) {
                    $tool->params->setValue($values['id'],$this->params[$values['id']]);
                }
            }

            require_once(DIR_APPLICATION . 'controller/'.$modulesPath.'/magicthumb-opencart-module/magictoolbox.imagehelper.class.php');

            $imagehelper = new MagicToolboxImageHelperClass($shop_dir, $pathToCache, $tool->params);
            $usedSubCache = $imagehelper->getOptionsHash();
            $cacheInfo = $this->MagicThumbgetCacheInfo($shop_dir.$pathToCache, $usedSubCache);
            $extension_data['path_to_cache'] = $pathToCache;
            $extension_data['total_items'] = $cacheInfo['totalCount'].' ('.$this->MagicThumbformat_size($cacheInfo['totalSize']).')';
            $extension_data['unused_items'] = $cacheInfo['unusedCount'].' ('.$this->MagicThumbformat_size($cacheInfo['unusedSize']).')';


            $profiles = $tool->params->getProfiles();
	    foreach ($profiles as $profile) {
	      $extension_data['parameters'][$profile] = $tool->params->getParams($profile); // LOAD PARAMS
	    }

            if (isset($this->error['warning'])) {
                    $extension_data['error_warning'] = $this->error['warning'];
            } else {
                    $extension_data['error_warning'] = '';
            }

            if (isset($this->error['code'])) {
                    $extension_data['error_code'] = $this->error['code'];
            } else {
                    $extension_data['error_code'] = '';
            }

            $extension_data['breadcrumbs'] = array();

            $extension_data['breadcrumbs'][] = array(
            'href'      => HTTPS_SERVER . 'index.php?route=common/dashboard&' . $tokenUrl,
            'text'      => $this->language->get('text_home'),
            'separator' => FALSE
            );

            $extension_data['breadcrumbs'][] = array(
            'href'      => HTTPS_SERVER . 'index.php?route='.$marketPath.'/'.$breadcrumbsPath . '&'.$tokenUrl,
            'text'      => $this->language->get('text_module'),
            'separator' => ' :: '
            );

            $extension_data['breadcrumbs'][] = array(
            'href'      => HTTPS_SERVER . 'index.php?route='.$modulesPath.'/magicthumb' . '&'.$tokenUrl,
            'text'      => $this->language->get('heading_title'),
            'separator' => ' :: '
            );

            $extension_data['action'] = HTTPS_SERVER . 'index.php?route='.$modulesPath.'/magicthumb' . '&'.$tokenUrl;

            $extension_data['cancel'] = HTTPS_SERVER . 'index.php?route='.$marketPath.'/'.$breadcrumbsPath . '&'.$tokenUrl;

            if (isset($this->request->post['magicthumb_status'])) {
                $extension_data['magicthumb_status'] = $this->request->post['magicthumb_status'];
            }  else if (isset($this->request->post['magicthumb_settings']['magicthumb_status'])) {
                $extension_data['magicthumb_status'] = $this->request->post['magicthumb_settings']['magicthumb_status']; 
            } else {
                if (isset($this->params['magicthumb_status'])) {
                    $this->config->set('magicthumb_status',$this->params['magicthumb_status']);
                } 
                $extension_data['magicthumb_status'] = $this->config->get('magicthumb_status');
            }
            
            $toolAbr = '';
            $abr = explode(" ", strtolower("Magic Thumb"));
            foreach ($abr as $word) $toolAbr .= $word{0};

            $extension_data['map'] = $this->map;
            $default_map = array('default' => array('Watermark' => $this->map['default']['Watermark'],
                                                    'Miscellaneous' => array('image-quality','headers-on-every-page')));
                                                                                 
            $data['groupsHTML']['general'] = $this->MagicThumb_groupsHTML($extension_data['parameters'],'default', $default_map);

            foreach ($this->blocks as $block_id => $block_name) { 
                if ($block_id == 'default') continue;

                $data['groupsHTML'][$block_id] = '<div class="tab-pane" id="tab-'.$block_id.'">';
                $data['groupsHTML'][$block_id] .= $this->MagicThumb_groupsHTML($extension_data['parameters'], $block_id, $this->map);
                $data['groupsHTML'][$block_id] .= '</div>';

            }


            if (!preg_match('/DEMO/is',@file_get_contents(DIR_CATALOG.'view/javascript/magicthumb.js'))) {
                $data['trial'] = false; 
            } else {
                $data['trial'] = true;  
            }

            $data['trial_bage'] = '<div style="border: 1px solid #C7C16C;background: #feffd0;text-align: center;">
                                <h1 style="color: black;font-size: 1.5em;text-transform: none;">Trial version</h1>
                                To remove the red "<span style="color:red;">Please upgrade..</span>" text, please <a target="_blank" href="http://magictoolbox.com/buy/magicthumb/"><b>buy</b></a> and upload your licensed magicthumb.js file to this folder:
                                <div style="padding:10px 0;">'.preg_replace('/^.*?([^\/]*\/?$)/is','$1',DIR_CATALOG).'view/javascript/magicthumb.js</div></div>';

            $data['style'] = $this->style;
            $data['script'] = $this->script;




	    if (version_compare(VERSION,'2','<')) {
		foreach ($extension_data as $key => $value) {
		    $this->data[$key] = $value;
		}
		$this->template = $modulesPath.'/magicthumb_oc15.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	    } else {
		foreach ($extension_data as $key => $value) {
		    $data[$key] = $value;
		}
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                if (version_compare(VERSION,'3','>=')) {
                    $this->response->setOutput($this->load->view($modulesPath.'/magicthumb', $data));
                } else {
                    $this->response->setOutput($this->load->view($modulesPath.'/magicthumb_oc2.tpl', $data));
                }
	    }
	    
            
    }

    private function validate() {
    
            global $modulesPath;
            
            if (!$this->user->hasPermission('modify', $modulesPath.'/magicthumb')) {
                    $this->error['warning'] = $this->language->get('error_permission');
            }

            if (!$this->error) {
                    return TRUE;
            } else {
                    return FALSE;
            }
    }

    private function clearCache($path, $usedSubCache = null) {
        $files = glob($path.DIRECTORY_SEPARATOR.'*');
        if($files !== FALSE && !empty($files)) {
            foreach($files as $file) {
                if(is_dir($file)) {
                    if(!$usedSubCache || $usedSubCache != substr($file, strrpos($file, DIRECTORY_SEPARATOR)+1)) {
                        $this->clearCache($file);
                        @rmdir($file);
                    }
                } else {
                    @unlink($file);
                }
            }
        }
        return;
    }

    function MagicThumbgetCacheInfo($path, $usedSubCache = null) {

        $totalSize = 0;
        $totalCount = 0;
        $usedSize = 0;
        $usedCount = 0;
        if (is_dir($path))
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                $next = $path . DIRECTORY_SEPARATOR . $file;
                if ($file != '.' && $file != '..' && !is_link($next)) {
                    if (is_dir($next)) {
                        $result = $this->MagicThumbgetCacheInfo($next);
                        if($file == $usedSubCache) {
                            $usedSize += $result['totalSize'];
                            $usedCount += $result['totalCount'];
                        }
                        $totalSize += $result['totalSize'];
                        $totalCount += $result['totalCount'];
                    } elseif (is_file($next)) {
                        $totalSize += filesize($next);
                        $totalCount++;
                    }
                }
            }
            closedir($handle);
        }
        return array('totalSize' => $totalSize, 'totalCount' => $totalCount, 'unusedSize' => $totalSize-$usedSize, 'unusedCount' => $totalCount-$usedCount);
    }

    function MagicThumbformat_size($size) {
        $units = array(' bytes', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2).$units[$i];
    }

    function MagicThumb_groupsHTML ($parameters, $profile = 'default', $map) {

        if (!isset($parameters[$profile])) return false;

        $groups = array();

        $parameters = $parameters[$profile];
                
        $imgArray = array('zoom &amp; expand', //array for the images ordering
                          'yes',
                          'zoom',
                          'expand',
                          'expanded',
                          'original',
                          'swap images only',
                          'no',
                          'left',
                          'top left', 
                          'top-left', 
                          'top',
                          'top right', 
                          'top-right', 
                          'right', 
                          'bottom right', 
                          'bottom-right', 
                          'bottom', 
                          'bottom left', 
                          'bottom-left'); 

        global $toolAbr, $magicthumb_status;

        if ($magicthumb_status) {
            $selected_yes = 'selected';
        } else {
            $selected_yes = '';
        }

        if (!$magicthumb_status) {
            $selected_no = 'selected'; 
        } else {
            $selected_no = '';  
        }

        $html = '';
        
        foreach ($parameters as $name => $s) {

            if (!isset($map[$profile][$s['group']]) || !in_array($s['id'], $map[$profile][$s['group']])) continue;

            if ($profile == 'product') {
                if ($s['id'] == 'page-status' && !isset($s['value'])) {
                    $s['default'] = 'Yes';
                }
            }
            
            if ($s['id'] == 'direction') continue;

            
            
            if (in_array($s['id'],array('thumb-max-width','thumb-max-height')) && !isset($s['value']) && in_array($profile,array('featured','bestseller','latest','special'))) {
                $s['default'] = '100';
            }
            
            if (!isset($s['group'])) {
                $s['group'] = 'Miscellaneous';
            }
            if (!isset($groups[$s['group']])) {
                $groups[$s['group']] = array();
            }

            if (strpos($s["label"],'(')) {
                $before = substr($s["label"],0,strpos($s["label"],'('));
                $after = ' '.str_replace(')','',substr($s["label"],strpos($s["label"],'(')+1));
            } else {
                $before = $s["label"];
                $after = '';
            }

            if (strpos($after,'%')) $after = ' %';
            if (strpos($after,'in pixels')) $after = ' pixels';
            if (strpos($after,'milliseconds')) $after = ' milliseconds';
            
            $description = '';
            if (isset($s["description"]) && trim($s["description"]) != '') {
                $description = $s["description"];
            }

            $html  .= '<div class="form-group">';
            
            if ($s["type"]=='num' || $s["type"]=='text') {
                $html  .= '<label class="col-sm-2 control-label" for="magicthumbsettings'. ucwords(strtolower($name)).'">'.$before.'</label>';
            } else {
                $html  .= '<label class="col-sm-2 control-label">'.$before.'</label>';
            }

            if(($s['type'] != 'array') && isset($s['values'])) {
                $description = implode(', ',$s['values']);
            }
                            
            $html .= '<div class="col-sm-10">';
                                        
            if (!empty($after)) {
                $html .= '<div class="input-group">';
            }

            switch($s["type"]) {
                case "array":

                    $rButtons = array();

                    foreach($s["values"] as $p) {
                        if (!isset($s["value"])) $s["value"] = $s["default"];
                        $rButtons[strtolower($p)] = '<label class="radio-inline"><input type="radio" value="'.$p.'"'. ($s["value"]==$p?"checked=\"checked\"":"").' name="'.$profile.'_'.$s['id'].'" id="magicthumbsettings'. ucwords(strtolower($name)).$p.'">';
                        $pName = ucwords($p);

                        if ($pName=='Yes') $pName = '<span class="fa fa-check"></span>';
                        if ($pName=='No') $pName = '<span class="fa fa-close"></span>';

                        $rButtons[strtolower($p)] .= ' '.$pName.'</label>';
                    }

                    foreach ($imgArray as $img){
                        if (isset($rButtons[$img])) {
                            $html .= $rButtons[$img];
                            unset($rButtons[$img]);
                        }
                    }

                    $html .= implode('',$rButtons);

                    break;
                case "num":
                case "text":
                default:
                    if (strtolower($name) == 'message') { $width = 'style="width:95%;"';} else {$width = '';}
                    if (!isset($s["value"])) $s["value"] = $s["default"];
                    $html .= '<input class="form-control" '.$width.' type="text" name="'.$profile.'_'.$s['id'].'" id="magicthumbsettings'. ucwords(strtolower($name)).'" value="'.$s["value"].'" />';
                    break;
            }

            if (!empty($after)) {
                $html .= '<span class="input-group-addon">'.$after.'</span>';
            }

            if (!empty($after)) {
                $html .= '</div>';
            }

            if (!empty($description)) $html .= '<p class="help-block">'.$description.'</p>';
            
            $html .= '</div>';
            $html .= '</div>';
            $groups[$s['group']][] = $html;
            $html = '';
        }

        $finalHTML = '';
        foreach ($groups as $name => $group) {
            $i = 0;
            $group[count($group)-1] = str_replace('<tr','<tr class="last"',$group[count($group)-1]); //set "last" class

            $finalHTML .= ' <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title"><i class="fa fa-pencil"></i>'.$name.'</h3>
                            </div>
                            <div class="panel-body '.$toolAbr.'params">';

            foreach ($group as $g) {
                if (++$i%2==0) { //set stripes
                    if (strpos($g,'class="last"')) {
                        $g = str_replace('class="last"','class="back last"',$g);
                    } else {
                        $g = str_replace('<tr','<tr class="back"',$g);
                    }
                }
                $finalHTML .= $g;
            }
            $finalHTML .= ' </div></div>';
        }
        return $finalHTML;
      }
}
if (version_compare(VERSION,'2.3','>=')) { //newer than 2.2.x
    class_alias('ControllerModuleMagicThumb','ControllerExtensionModuleMagicThumb'); //hack the class system
}

?>