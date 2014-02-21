<?php

/**
 *
 * Framework module styles
 *
 * @version             1.0.0
 * @package             GK Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 * @license                
 */
 
// No direct access.
defined('_JEXEC') or die;

$gkModulesCounter = array();

/**
 * gk_style
 */
 
function modChrome_gk_style($module, $params, $attribs) {	
	global $gkModulesCounter;
	
	if (!empty ($module->content)) {		
		$modnum_class = '';
		
		if(isset($gkModulesCounter[$attribs['name']])) {
			$gkModulesCounter[$attribs['name']]++;
		} else {
			$gkModulesCounter[$attribs['name']] = 1;
		}
		
		/**
		 *
		 *	We will get following classes:
		 *
		 *	gkmod-1 - for 1 module
		 *	gkmod-2 - for 2 modules
		 *	gkmod-3 - for 3 modules
		 *	gkmod-4 - for 4 modules
		 *	gkmod-more - for more than 4 modules
		 *
		 *	gkmod-last-1 - for more than 4 modules and 1 module at the end
		 *	gkmod-last-2 - for more than 4 modules and 2 module at the end
		 *	gkmod-last-3 - for more than 4 modules and 3 module at the end
		 *
		 **/
		$num = 1; 
		$cols = 6;
		
		if(isset($attribs['modcol'])) {
			$cols = $attribs['modcol'];
		} 
		 
		if(isset($attribs['modnum'])) {
			$num = $attribs['modnum'];
			
			if($num > $cols) {
				$num = $num % $cols;
				
				if($num == 0) {
					$modnum_class = ' gkmod-' . $cols;
				} else {
					$modnum_class = ' gkmod-more gkmod-last-' . $num;
				}
			} else {
				$modnum_class = ' gkmod-' . $num;
			}
		}
		
		$margin_class = '';
		
		if(isset($attribs['modnum']) && $gkModulesCounter[$attribs['name']] <= $cols) {
			$margin_class = ' nomargin';
		} elseif($num == 1 && $gkModulesCounter[$attribs['name']] == 1) {
			$margin_class = ' nomargin';
		}
		
		$overflow_class = '';
		
		if($module->name == 'tabs_gk5') {
			$overflow_class = ' nooverflow';
		}
		
		$clear_mode = false;
		
		if(stripos($params->get('moduleclass_sfx'), 'clear') !== FALSE) {
			$clear_mode = true;
		}
		
		echo '<div class="box ' . $params->get('moduleclass_sfx') . $modnum_class . $overflow_class . $margin_class . '">';
		
		if($module->showtitle) {	
			if($params->get('module_link_switch')) {
				echo '<h3 class="header"><a href="'. $params->get('module_link') .'">'. $module->title .'</a></h3>';
			} else {
				echo '<h3 class="header">'. $module->title .'</h3>';
			}
		}
	
		if($clear_mode == false) echo '<div class="content">';
		
		echo $module->content;
		
		if($clear_mode == false) echo '</div>';
		
		echo '</div>';
 	}
}

// EOF