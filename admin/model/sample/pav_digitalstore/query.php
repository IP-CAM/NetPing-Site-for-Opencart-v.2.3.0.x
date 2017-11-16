<?php 

$query['pavmegamenu'][]  = "DELETE FROM `".DB_PREFIX ."setting` WHERE `code`='pavmegamenu' and `key` = 'pavmegamenu_module'";

$query['pavmegamenu'][]  = "DELETE FROM `".DB_PREFIX ."setting` WHERE `code`='pavmegamenu_params' and `key` = 'params'";
$query['pavmegamenu'][] =  " 
INSERT INTO `".DB_PREFIX ."setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(595, 0, 'pavmegamenu_params', 'pavmegamenu_params', '[{\"submenu\":1,\"subwidth\":720,\"id\":5,\"align\":\"aligned-left\",\"group\":0,\"cols\":1,\"rows\":[{\"cols\":[{\"widgets\":\"wid-50\",\"colwidth\":3},{\"widgets\":\"wid-53\",\"colwidth\":5,\"colclass\":\"sidebar hidden-xs\"},{\"widgets\":\"wid-52\",\"colwidth\":4}]}]},{\"submenu\":1,\"id\":19,\"align\":\"aligned-left\",\"group\":0,\"cols\":1,\"rows\":[{\"cols\":[{\"type\":\"menu\",\"colwidth\":12}]}]},{\"submenu\":1,\"subwidth\":370,\"id\":7,\"align\":\"aligned-left\",\"group\":0,\"cols\":1,\"rows\":[{\"cols\":[{\"widgets\":\"wid-58\",\"colwidth\":12}]}]}]', 0);
";

$query['pavblog'][] ="
INSERT INTO `".DB_PREFIX ."layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
(0, 14, 0, 'pavblog/%');
";
$query['pavblog'][] ="
INSERT INTO `".DB_PREFIX ."layout` (`layout_id`, `name`) VALUES
(0, 'Pav Blog');
";
?>
