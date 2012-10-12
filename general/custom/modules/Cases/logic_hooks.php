<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'Cases push feed', 'modules/Cases/SugarFeeds/CaseFeed.php','CaseFeed', 'pushFeed'); 
$hook_array['before_save'][] = Array(2, 'Carga de datos anteriores', 'custom/modules/Cases/AbproCases.php','AbproCases', 'cargaPreData');
$hook_array['after_save'][] = Array(1, 'Notifica caso liberado_abpro', 'custom/modules/Cases/AbproCases.php','AbproCases', 'notificaLiberadoAbpro'); 



?>
