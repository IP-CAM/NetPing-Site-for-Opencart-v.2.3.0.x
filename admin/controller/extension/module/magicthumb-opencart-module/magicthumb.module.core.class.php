<?php

if(!defined('MagicThumbModuleCoreClassLoaded')) {

    define('MagicThumbModuleCoreClassLoaded', true);

    require_once(dirname(__FILE__).'/magictoolbox.params.class.php');

    /**
     * MagicThumbModuleCoreClass
     *
     */
    class MagicThumbModuleCoreClass {

        /**
         * MagicToolboxParamsClass class
         *
         * @var   MagicToolboxParamsClass
         *
         */
        var $params;

        /**
         * Tool type
         *
         * @var   string
         *
         */
        var $type = 'standard';

        /**
         * Id
         *
         * @var   string
         *
         */
        var $id = '';

        /**
         * Constructor
         *
         * @return void
         */
        function __construct() {
            $this->params = new MagicToolboxParamsClass();
            $this->params->setScope('magicthumb');
            $this->params->setMapping(array(
                'loop' => array('Yes' => 'true', 'No' => 'false'),
                'keyboard' => array('Yes' => 'true', 'No' => 'false'),
                'rightClick' => array('Yes' => 'true', 'No' => 'false'),
                'lazyLoad' => array('Yes' => 'true', 'No' => 'false'),
                'autostart' => array('Yes' => 'true', 'No' => 'false')
            ));
            $this->loadDefaults();
        }

        /**
         * Method to get headers string
         *
         * @param string $jsPath  Path to JS file
         * @param string $cssPath Path to CSS file
         *
         * @return string
         */
        function getHeadersTemplate($jsPath = '', $cssPath = null) {
            //to prevent multiple displaying of headers
            if(!defined('MAGICTHUMB_MODULE_HEADERS')) {
                define('MAGICTHUMB_MODULE_HEADERS', true);
            } else {
                return '';
            }
            if($cssPath == null) {
                $cssPath = $jsPath;
            }
            $headers = array();
            $headers[] = '<!-- Magic Thumb OpenCart module version v4.4.2 [v1.6.69:v3.0.11] -->';
            $headers[] = '<script type="text/javascript">window["mgctlbx$Pltm"] = "OpenCart";</script>';
            $headers[] = '<link type="text/css" href="'.$cssPath.'/magicthumb.css" rel="stylesheet" media="screen" />';
            $headers[] = '<link type="text/css" href="'.$cssPath.'/magicthumb.module.css" rel="stylesheet" media="screen" />';
            $headers[] = '<script type="text/javascript" src="'.$jsPath.'/magicthumb.js"></script>';
            $headers[] = $this->getOptionsTemplate();
            return "\r\n".implode("\r\n", $headers)."\r\n";
        }

        /**
         * Method to get options string
         *
         * @return string
         */
        function getOptionsTemplate() {
            $addition = '';
            $captionSource = $this->params->getParam('caption-source');
            if($captionSource && isset($captionSource['core']) && $captionSource['core']) {
                $addition .= "\n\t\t'captionSource':'".$this->params->getValue('caption-source')."',";
            } else {
                $addition .= "\n\t\t'captionSource':'span',";
            }

            if($this->params->checkValue('show-caption', 'No')) {
                $this->params->setValue('captionPosition', 'off');
            }

            return  "<script type=\"text/javascript\">\n\tvar mgtOptions = {{$addition}\n\t\t".$this->params->serialize(true, ",\n\t\t")."\n\t}\n</script>".
                    "<script type=\"text/javascript\">\n\tvar mgtMobileOptions = {".
                    "\n\t\t'slideMobileEffect':'".str_replace('\'', '\\\'', $this->params->getValue('slideMobileEffect'))."',".
                    "\n\t\t'textClickHint':'".str_replace('\'', '\\\'', $this->params->getValue('textClickHintForMobile'))."'".
                    "\n\t}\n</script>";
        }

        /**
         * Method to get main image HTML
         *
         * @param array $params Params
         *
         * @return string
         */
        function getMainTemplate($params) {
            $img = '';
            $thumb = '';
            $thumb2x = '';
            $id = '';
            $alt = '';
            $title = '';
            $description = '';
            $width = '';
            $height = '';
            $link = '';
            $group = '';

            extract($params);

            if(empty($img)) {
                return false;
            }
            if(empty($thumb)) {
                $thumb = $img;
            }
            if(empty($id)) {
                $id = md5($img);
            }

            $this->id = $id;

            if(empty($alt)) {
                if(empty($title)) {
                    $title = '';
                    $alt = '';
                } else {
                    $alt = htmlspecialchars(htmlspecialchars_decode($title, ENT_QUOTES));
                }
            } else {
                if(empty($title)) {
                    $title = '';
                }
                $alt = htmlspecialchars(htmlspecialchars_decode($alt, ENT_QUOTES));
            }
            if(empty($description)) {
                $description = '';
            }
            
            $orgTitle = $title;

            if($this->params->checkValue('show-caption', 'Yes')) {
                $captionSource = $this->params->getValue('caption-source');
                $captionSource = strtolower(trim($captionSource));
                if($captionSource == 'all' || $captionSource == 'both') {
                    $captionSource = $this->params->getValues('caption-source');
                } else {
                    $captionSource = explode(',', $captionSource);
                }
                $fullTitle = array();
                foreach($captionSource as $caption) {
                    $caption = trim($caption);
                    $caption = lcfirst(implode(explode(' ', ucwords($caption))));
                    if($caption == 'all' || $caption == 'both' || !isset($$caption) || empty($$caption)) {
                        continue;
                    }
                    if($caption == 'title') {
                        $fullTitle[] = '<b>'.$$caption.'</b>';
                    } else {
                        $fullTitle[] = $$caption;
                    }
                }
                $title = implode('<br/>', $fullTitle);
                $title = trim(preg_replace('/\s+/is', ' ', $title));
                if(!empty($title)) {
                    $title = preg_replace('/<(\/?)a([^>]*)>/is', '[$1a$2]', $title);
                    $title = '<span>'.$title.'</span>';
                }
            } else {
                $title = '';
            }

            if(empty($width)) {
                $width = '';
            } else {
                $width = " width=\"{$width}\"";
            }
            if(empty($height)) {
                $height = '';
            } else {
                $height = " height=\"{$height}\"";
            }

            $dataOptions = $this->params->serialize();

            if(!empty($link)) {
                $dataOptions .= 'link:'.$link.';';
            }

            if(!empty($group)) {
                $dataOptions .= 'group:'.$group.';';
            }

            if ('' != trim($dataOptions)) {
                $dataOptions = 'data-options="'.$dataOptions.'"';
            }

            if (!empty($thumb2x)) {
                //$thumb2x = ' srcset="'.$thumb2x.' 2x"';
                //$thumb2x = ' srcset="'.$thumb.' 1x, '.$thumb2x.' 2x"';
                $thumb2x = ' srcset="'.str_replace(' ', '%20', $thumb).' 1x, '.str_replace(' ', '%20', $thumb2x).' 2x"';
            }

            return "<a title=\"{$orgTitle}\" class=\"MagicThumb\" id=\"MagicThumbImage{$id}\" href=\"{$img}\" {$dataOptions}><img itemprop=\"image\"{$width}{$height} {$thumb2x} src=\"{$thumb}\" alt=\"{$alt}\" />{$title}</a>";
        }

        /**
         * Method to get selectors HTML
         *
         * @param array $params Params
         *
         * @return string
         */
        function getSelectorTemplate($params) {
            $img = '';
            $medium = '';
            $thumb = '';
            $thumb2x = '';
            $id = '';
            $alt = '';
            $title = '';
            $width = '';
            $height = '';

            extract($params);

            if(empty($img)) {
                return false;
            }
            if(empty($medium)) {
                $medium = $img;
            }
            if(empty($thumb)) {
                $thumb = $img;
            }
            if(empty($id)) {
                $id = $this->id;
            }


            if(empty($title)) {
                $title = '';
            } else {
                $title = htmlspecialchars(htmlspecialchars_decode($title, ENT_QUOTES));
            }
            if(empty($alt)) {
                $alt = $title;
            } else {
                $alt = htmlspecialchars(htmlspecialchars_decode($alt, ENT_QUOTES));
            }

            if($this->params->checkValue('show-caption', 'Yes') && !empty($title)) {
                $title = trim(preg_replace('#\s+#is', ' ', $title));
                $title = preg_replace('#<(/?)a([^>]*+)>#is', '[$1a$2]', $title);
                $title = " title=\"{$title}\"";
            } else {
                $title = '';
            }

            if(empty($width)) {
                $width = '';
            } else {
                $width = " width=\"{$width}\"";
            }
            if(empty($height)) {
                $height = '';
            } else {
                $height = " height=\"{$height}\"";
            }

            if (!empty($thumb2x)) {
                $thumb2x = ' srcset="'.$thumb2x.' 2x"';
            }

            $template = "<a{$title} href=\"{$img}\" data-thumb-id=\"MagicThumbImage{$id}\" data-image=\"$medium\"><img{$width}{$height} src=\"{$thumb}\" {$thumb2x} alt=\"{$alt}\" /></a>";

            return $template;
        }

        /**
         * Method to load defaults options
         *
         * @return void
         */
        function loadDefaults() {
            $params = array(
				"page-status"=>array("id"=>"page-status","group"=>"General","order"=>"5","default"=>"No","label"=>"Enable effect","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"module"),
				"template"=>array("id"=>"template","group"=>"General","order"=>"20","default"=>"bottom","label"=>"Which template to use","type"=>"array","subType"=>"select","values"=>array("bottom","left","right","top"),"scope"=>"module"),
				"magicscroll"=>array("id"=>"magicscroll","group"=>"General","order"=>"22","default"=>"No","label"=>"Scroll thumbnails","description"=>"(Does not work with keep-selectors-position:yes) Powered by the versatile <a href=\"http://www.magictoolbox.com/magicscroll/examples/\">Magic Scroll</a>™. Normally £29, yours is discounted to £19. <a href=\"https://www.magictoolbox.com/buy/magicscroll/\">Buy a license</a> and upload magicscroll.js to your server. <a href=\"http://www.magictoolbox.com/contact/\">Contact us</a> for help.","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"module"),
				"thumb-max-width"=>array("id"=>"thumb-max-width","group"=>"Positioning and Geometry","order"=>"10","default"=>"300","label"=>"Maximum width of thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"thumb-max-height"=>array("id"=>"thumb-max-height","group"=>"Positioning and Geometry","order"=>"11","default"=>"300","label"=>"Maximum height of thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"right-thumb-max-width"=>array("id"=>"right-thumb-max-width","group"=>"Positioning and Geometry","order"=>"30","default"=>"75","label"=>"Maximum width of right column boxes thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"right-thumb-max-height"=>array("id"=>"right-thumb-max-height","group"=>"Positioning and Geometry","order"=>"31","default"=>"75","label"=>"Maximum height of right column boxes thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"left-thumb-max-width"=>array("id"=>"left-thumb-max-width","group"=>"Positioning and Geometry","order"=>"40","default"=>"75","label"=>"Maximum width of left column boxes thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"left-thumb-max-height"=>array("id"=>"left-thumb-max-height","group"=>"Positioning and Geometry","order"=>"41","default"=>"75","label"=>"Maximum height of left column boxes thumbnail (in pixels)","type"=>"num","scope"=>"module"),
				"square-images"=>array("id"=>"square-images","group"=>"Positioning and Geometry","order"=>"310","default"=>"disable","label"=>"Create square images","description"=>"The white/transparent padding will be added around the image or the image will be cropped.","type"=>"array","subType"=>"radio","values"=>array("extend","crop","disable"),"scope"=>"module"),
				"expandEffect"=>array("id"=>"expandEffect","group"=>"Expanded view","order"=>"10","default"=>"expand","label"=>"Effect while enlarging image","type"=>"array","subType"=>"select","values"=>array("expand","fade"),"scope"=>"magicthumb"),
				"expandSpeed"=>array("id"=>"expandSpeed","group"=>"Expanded view","order"=>"20","default"=>"350","label"=>"Duration when enlarging image (milliseconds)","description"=>"0-10000, e.g. 2000 = 2 seconds","type"=>"num","scope"=>"magicthumb"),
				"expandImageSize"=>array("id"=>"expandImageSize","group"=>"Expanded view","order"=>"30","default"=>"fit-screen","label"=>"Size of expanded box","type"=>"array","subType"=>"select","values"=>array("fit-screen","original"),"scope"=>"magicthumb"),
				"expandTrigger"=>array("id"=>"expandTrigger","group"=>"Expanded view","order"=>"40","default"=>"click","label"=>"Mouse trigger to expand","type"=>"array","subType"=>"select","values"=>array("click","hover"),"scope"=>"magicthumb"),
				"expandAlign"=>array("id"=>"expandAlign","group"=>"Expanded view","order"=>"50","default"=>"screen","label"=>"Align expanded box relative to screen or thumbnail","type"=>"array","subType"=>"select","values"=>array("screen","image"),"scope"=>"magicthumb"),
				"expandEasing"=>array("id"=>"expandEasing","group"=>"Expanded view","order"=>"60","default"=>"ease-in-out","label"=>"CSS3 Animation Easing","description"=>"CSS3 Animation Easing. See cubic-bezier.com","type"=>"text","scope"=>"magicthumb"),
				"gallerySpeed"=>array("id"=>"gallerySpeed","group"=>"Expanded view","order"=>"70","default"=>"250","label"=>"Duration when switching image (milliseconds)","description"=>"0-10000, e.g. 2000 = 2 seconds","type"=>"num","scope"=>"magicthumb"),
				"selector-max-width"=>array("id"=>"selector-max-width","group"=>"Multiple images","order"=>"10","default"=>"70","label"=>"Maximum width of additional thumbnails (in pixels)","type"=>"num","scope"=>"module"),
				"selector-max-height"=>array("id"=>"selector-max-height","group"=>"Multiple images","order"=>"11","default"=>"70","label"=>"Maximum height of additional thumbnails (in pixels)","type"=>"num","scope"=>"module"),
				"selectors-margin"=>array("id"=>"selectors-margin","group"=>"Multiple images","order"=>"40","default"=>"5","label"=>"Margin between selectors and main image (in pixels)","type"=>"num","scope"=>"module"),
				"selectorTrigger"=>array("id"=>"selectorTrigger","group"=>"Multiple images","order"=>"110","default"=>"click","label"=>"Trigger for selector","type"=>"array","subType"=>"select","values"=>array("click","hover"),"scope"=>"magicthumb"),
				"selectorEffect"=>array("id"=>"selectorEffect","group"=>"Multiple images","order"=>"115","default"=>"switch","label"=>"Effect for selector","type"=>"array","subType"=>"select","values"=>array("switch","expand"),"scope"=>"magicthumb"),
				"show-caption"=>array("id"=>"show-caption","group"=>"Title and Caption","order"=>"20","default"=>"Yes","label"=>"Show caption","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"module"),
				"captionPosition"=>array("id"=>"captionPosition","group"=>"Title and Caption","order"=>"150","default"=>"bottom","label"=>"Position of caption in zoom window","type"=>"array","subType"=>"select","values"=>array("bottom","right","off"),"scope"=>"magicthumb"),
				"headers-on-every-page"=>array("id"=>"headers-on-every-page","group"=>"Miscellaneous","order"=>"6","default"=>"No","label"=>"Include headers on all pages","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"module"),
				"link-to-product-page"=>array("id"=>"link-to-product-page","group"=>"Miscellaneous","order"=>"70","default"=>"Yes","label"=>"Link enlarged image to the product page","type"=>"array","subType"=>"select","values"=>array("Yes","No"),"scope"=>"module"),
				"z-index"=>array("id"=>"z-index","group"=>"Miscellaneous","order"=>"80","default"=>"100","label"=>"Starting z-Index","description"=>"Adjust the stack position above/below other elements","type"=>"num","scope"=>"module"),
				"keyboard"=>array("id"=>"keyboard","group"=>"Miscellaneous","order"=>"230","default"=>"Yes","label"=>"Allow navigation with right / left keys and close on Esc","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicthumb"),
				"cssClass"=>array("id"=>"cssClass","group"=>"Miscellaneous","order"=>"250","default"=>"","label"=>"Extra CSS class applied to lightbox","type"=>"text","scope"=>"magicthumb"),
				"rightClick"=>array("id"=>"rightClick","group"=>"Miscellaneous","order"=>"260","default"=>"Yes","label"=>"Whether to allow context menu on right click","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicthumb"),
				"lazyLoad"=>array("id"=>"lazyLoad","group"=>"Miscellaneous","order"=>"270","default"=>"No","label"=>"Whether to load large image on demand","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicthumb"),
				"autostart"=>array("id"=>"autostart","group"=>"Miscellaneous","order"=>"280","default"=>"Yes","label"=>"Whether to start Thumb on image automatically on page load or manually","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicthumb"),
				"imagemagick"=>array("id"=>"imagemagick","group"=>"Miscellaneous","order"=>"550","default"=>"off","label"=>"Path to Imagemagick binaries (convert tool)","description"=>"You can set 'auto' to automatically detect imagemagick location or 'off' to disable imagemagick and use php GD lib instead","type"=>"text","scope"=>"module"),
				"image-quality"=>array("id"=>"image-quality","group"=>"Miscellaneous","order"=>"560","default"=>"75","label"=>"Quality of thumbnails and watermarked images (1-100)","description"=>"1 = worst quality / 100 = best quality","type"=>"num","scope"=>"module"),
				"buttons"=>array("id"=>"buttons","group"=>"Buttons","order"=>"160","default"=>"auto","label"=>"Position of buttons in expand window","type"=>"array","subType"=>"select","values"=>array("auto","top left","top right","bottom left","bottom right","off"),"scope"=>"magicthumb"),
				"textBtnClose"=>array("id"=>"textBtnClose","group"=>"Buttons","order"=>"170","default"=>"Close","label"=>"Title of close button","type"=>"text","scope"=>"magicthumb"),
				"textBtnNext"=>array("id"=>"textBtnNext","group"=>"Buttons","order"=>"180","default"=>"Next","label"=>"Title of next button","type"=>"text","scope"=>"magicthumb"),
				"textBtnPrev"=>array("id"=>"textBtnPrev","group"=>"Buttons","order"=>"190","default"=>"Previous","label"=>"Title of previous button","type"=>"text","scope"=>"magicthumb"),
				"watermark"=>array("id"=>"watermark","group"=>"Watermark","order"=>"10","default"=>"","label"=>"Watermark image path","description"=>"Enter location of watermark image on your server. Leave field empty to disable watermark","type"=>"text","scope"=>"module"),
				"watermark-max-width"=>array("id"=>"watermark-max-width","group"=>"Watermark","order"=>"20","default"=>"30%","label"=>"Maximum width of watermark image","description"=>"pixels = fixed size (e.g. 50) / percent = relative for image size (e.g. 50%)","type"=>"text","scope"=>"module"),
				"watermark-max-height"=>array("id"=>"watermark-max-height","group"=>"Watermark","order"=>"21","default"=>"30%","label"=>"Maximum height of watermark image","description"=>"pixels = fixed size (e.g. 50) / percent = relative for image size (e.g. 50%)","type"=>"text","scope"=>"module"),
				"watermark-opacity"=>array("id"=>"watermark-opacity","group"=>"Watermark","order"=>"40","default"=>"50","label"=>"Watermark image opacity (1-100)","description"=>"0 = transparent, 100 = solid color","type"=>"num","scope"=>"module"),
				"watermark-position"=>array("id"=>"watermark-position","group"=>"Watermark","order"=>"50","default"=>"center","label"=>"Watermark position","description"=>"Watermark size settings will be ignored when watermark position is set to 'stretch'","type"=>"array","subType"=>"select","values"=>array("top","right","bottom","left","top-left","bottom-left","top-right","bottom-right","center","stretch"),"scope"=>"module"),
				"watermark-offset-x"=>array("id"=>"watermark-offset-x","advanced"=>"1","group"=>"Watermark","order"=>"60","default"=>"0","label"=>"Watermark horizontal offset","description"=>"Offset from left and/or right image borders. Pixels = fixed size (e.g. 20) / percent = relative for image size (e.g. 20%). Offset will disable if 'watermark position' set to 'center'","type"=>"text","scope"=>"module"),
				"watermark-offset-y"=>array("id"=>"watermark-offset-y","advanced"=>"1","group"=>"Watermark","order"=>"70","default"=>"0","label"=>"Watermark vertical offset","description"=>"Offset from top and/or bottom image borders. Pixels = fixed size (e.g. 20) / percent = relative for image size (e.g. 20%). Offset will disable if 'watermark position' set to 'center'","type"=>"text","scope"=>"module"),
				"hint"=>array("id"=>"hint","group"=>"Hint","order"=>"120","default"=>"once","label"=>"How to show hint","type"=>"array","subType"=>"select","values"=>array("once","always","off"),"scope"=>"magicthumb"),
				"textClickHint"=>array("id"=>"textClickHint","group"=>"Hint","order"=>"130","default"=>"Click to expand","label"=>"Hint that shows when zoom is active.","type"=>"text","scope"=>"magicthumb"),
				"textHoverHint"=>array("id"=>"textHoverHint","group"=>"Hint","order"=>"130","default"=>"Hover to expand","label"=>"Hint that shows when zoom is active.","type"=>"text","scope"=>"magicthumb"),
				"slideMobileEffect"=>array("id"=>"slideMobileEffect","group"=>"Mobile","order"=>"1","default"=>"rotate","label"=>"Switch image effect in expand window","type"=>"array","subType"=>"select","values"=>array("rotate","straight"),"scope"=>"magicthumb-mobile"),
				"textClickHintForMobile"=>array("id"=>"textClickHintForMobile","group"=>"Mobile","order"=>"2","default"=>"Tap to expand","label"=>"Hint that shows when zoom is active.","type"=>"text","scope"=>"magicthumb-mobile"),
				"width"=>array("id"=>"width","group"=>"Scroll","order"=>"10","default"=>"auto","label"=>"Scroll width","description"=>"auto | pixels | percetage","type"=>"text","scope"=>"magicscroll"),
				"height"=>array("id"=>"height","group"=>"Scroll","order"=>"20","default"=>"auto","label"=>"Scroll height","description"=>"auto | pixels | percetage","type"=>"text","scope"=>"magicscroll"),
				"orientation"=>array("id"=>"orientation","group"=>"Scroll","order"=>"30","default"=>"horizontal","label"=>"Orientation of scroll","type"=>"array","subType"=>"radio","values"=>array("horizontal","vertical"),"scope"=>"magicscroll"),
				"mode"=>array("id"=>"mode","group"=>"Scroll","order"=>"40","default"=>"scroll","label"=>"Scroll mode","type"=>"array","subType"=>"radio","values"=>array("scroll","animation","carousel","cover-flow"),"scope"=>"magicscroll"),
				"items"=>array("id"=>"items","group"=>"Scroll","order"=>"50","default"=>"3","label"=>"Items to show","description"=>"auto | fit | integer | array","type"=>"text","scope"=>"magicscroll"),
				"speed"=>array("id"=>"speed","group"=>"Scroll","order"=>"60","default"=>"600","label"=>"Scroll speed (in milliseconds)","description"=>"e.g. 5000 = 5 seconds","type"=>"num","scope"=>"magicscroll"),
				"autoplay"=>array("id"=>"autoplay","group"=>"Scroll","order"=>"70","default"=>"0","label"=>"Autoplay speed (in milliseconds)","description"=>"e.g. 0 = disable autoplay; 600 = 0.6 seconds","type"=>"num","scope"=>"magicscroll"),
				"loop"=>array("id"=>"loop","group"=>"Scroll","order"=>"80","advanced"=>"1","default"=>"infinite","label"=>"Continue scroll after the last(first) image","description"=>"infinite - scroll in loop; rewind - rewind to the first image; off - stop on the last image","type"=>"array","subType"=>"radio","values"=>array("infinite","rewind","off"),"scope"=>"magicscroll"),
				"step"=>array("id"=>"step","group"=>"Scroll","order"=>"90","default"=>"auto","label"=>"Number of items to scroll","description"=>"auto | integer","type"=>"text","scope"=>"magicscroll"),
				"arrows"=>array("id"=>"arrows","group"=>"Scroll","order"=>"100","default"=>"inside","label"=>"Prev/Next arrows","type"=>"array","subType"=>"radio","values"=>array("inside","outside","off"),"scope"=>"magicscroll"),
				"pagination"=>array("id"=>"pagination","group"=>"Scroll","order"=>"110","advanced"=>"1","default"=>"No","label"=>"Show pagination (bullets)","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicscroll"),
				"easing"=>array("id"=>"easing","group"=>"Scroll","order"=>"120","advanced"=>"1","default"=>"cubic-bezier(.8, 0, .5, 1)","label"=>"CSS3 Animation Easing","description"=>"see cubic-bezier.com","type"=>"text","scope"=>"magicscroll"),
				"scrollOnWheel"=>array("id"=>"scrollOnWheel","group"=>"Scroll","order"=>"130","advanced"=>"1","default"=>"auto","label"=>"Scroll On Wheel mode","description"=>"auto - automatically turn off scrolling on mouse wheel in the 'scroll' and 'animation' modes, and enable it in 'carousel' and 'cover-flow' modes","type"=>"array","subType"=>"radio","values"=>array("auto","turn on","turn off"),"scope"=>"magicscroll"),
				"lazy-load"=>array("id"=>"lazy-load","group"=>"Scroll","order"=>"140","advanced"=>"1","default"=>"No","label"=>"Lazy load","description"=>"Delay image loading. Images outside of view will be loaded on demand.","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"magicscroll"),
				"scroll-extra-styles"=>array("id"=>"scroll-extra-styles","group"=>"Scroll","order"=>"150","advanced"=>"1","default"=>"","label"=>"Scroll extra styles","description"=>"mcs-rounded | mcs-shadows | bg-arrows | mcs-border","type"=>"text","scope"=>"module"),
				"show-image-title"=>array("id"=>"show-image-title","group"=>"Scroll","order"=>"160","default"=>"No","label"=>"Show image title","type"=>"array","subType"=>"radio","values"=>array("Yes","No"),"scope"=>"module")
			);
            $this->params->appendParams($params);
        }
    }

}

?>
