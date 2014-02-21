<?php
defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');
class JFormFieldConfigManager extends JFormField {
	protected $type = 'ConfigManager';
	protected function getInput() {
		jimport('joomla.filesystem.file');
		// necessary Joomla! classes
		$uri = JURI::getInstance();
		$db = JFactory::getDBO();
		// variables from URL
		$tpl_id = $uri->getVar('id', 'none');
		$task = $uri->getVar('gk_template_task', 'none');
		$file = $uri->getVar('gk_template_file', 'none');
		$base_path = str_replace('admin'.DS.'elements', '', dirname(__FILE__)).'config'.DS;
		// helping variables
		$redirectUrl = $uri->root() . 'administrator/index.php?option=com_templates&view=style&layout=edit&id=' . $tpl_id;
		// if the URL contains proper variables
		if($tpl_id !== 'none' && is_numeric($tpl_id) && $task !== 'none') {
			if($task == 'load') {
				if(JFile::exists($base_path . $file)) {
					//
					$query = '
						UPDATE 
							#__template_styles
						SET	
							params = '.$db->quote(file_get_contents($base_path . $file)).'
						WHERE 
						 	id = '.$tpl_id.'
						LIMIT 1
						';	
					// Executing SQL Query
					$db->setQuery($query);
					$result = $db->query();
					// check the result
					if($result) {
						// make an redirect
						$app = JFactory::getApplication();
						$app->redirect($redirectUrl, JText::_('TPL_GK_LANG_CONFIG_LOADED_AND_SAVED'), 'message');
					} else {
						// make an redirect
						$app = JFactory::getApplication();
						$app->redirect($redirectUrl, JText::_('TPL_GK_LANG_CONFIG_SQL_ERROR'), 'error');
					}
				} else {
					// make an redirect
					$app = JFactory::getApplication();
					$app->redirect($redirectUrl, JText::_('TPL_GK_LANG_CONFIG_SELECTED_FILE_DOESNT_EXIST'), 'error');
				}	
			} else if($task == 'save') {
				if($file == '') {
					$file = date('d_m_Y_h_s');
				}
				// variable used to detect if the specified file exists
				$i = 0;
				// check if the file to save doesn't exist
				if(JFile::exists($base_path . $file . '.json')) {
					// find the proper name for the file by incrementing
					$i = 1;
					while(JFile::exists($base_path . $file . $i . '.json')) { $i++; }
				}	
				// get the settings from the database
				$query = '
					SELECT
						params AS params
					FROM 
						#__template_styles
					WHERE 
					 	id = '.$tpl_id.'
					LIMIT 1
					';	
				// Executing SQL Query
				$db->setQuery($query);
				$row = $db->loadObject();
				// write it
				if(JFile::write($base_path . $file . (($i != 0) ? $i : '') . '.json' , $row->params)) {
					// make an redirect
					$app = JFactory::getApplication();
					$app->redirect($redirectUrl, JText::_('TPL_GK_LANG_CONFIG_FILE_SAVED_AS'). ' '. $file . (($i == 0) ? '' : $i) .'.json', 'message');
				} else {
					// make an redirect
					$app = JFactory::getApplication();
					$app->redirect($redirectUrl, JText::_('TPL_GK_LANG_CONFIG_FILE_WASNT_SAVED_PLEASE_CHECK_PERM'), 'error');
				}
			} else if($task == 'delete') {
				// Check if file exists before deleting
				if(JFile::exists($base_path . $file)) {
					if(JFile::delete($base_path . $file)) {
						$msg = '<div class="gk_ok">'. $file . ' ' . JText::_('TPL_GK_LANG_CONFIG_FILE_DELETED_AS') .'</div>';
					} else {
						$msg = '<div class="gk_error">'. $file . ' ' . JText::_('TPL_GK_LANG_CONFIG_FILE_WASNT_DELETED_PLEASE_CHECK_PERM') .'</div>';
					}
				} else {
					$msg = '<div class="gk_error">'. $file . ' ' . JText::_('TPL_GK_LANG_CONFIG_FILE_WASNT_DELETED_PLEASE_CHECK_FILE') .'</div>';
				}	
			}
		}
		// generate the select list
		$options = (array) $this->getOptions();
		$file_select = JHtml::_('select.genericlist', $options, 'name', '', 'value', 'text', 'default', 'config_manager_load_filename');
		$file_delete = JHtml::_('select.genericlist', $options, 'name', '', 'value', 'text', 'default', 'config_manager_delete_filename');
     // return the standard formfield output
		// return the standard formfield output
		$html = '';
		$html .= '<div id="gk-social"><span>Follow us on the social media: </span> <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fgavickpro&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe> <a href="https://twitter.com/gavickpro" class="twitter-follow-button" data-show-count="false">Follow @gavickpro</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
		<div class="g-plusone" data-size="medium" data-annotation="inline" data-width="150" data-href="https://plus.google.com/+gavickpro/"></div><script type="text/javascript">(function() { var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true; po.src = \'https://apis.google.com/js/platform.js\';var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);})();</script></div>';
		$html .= '<div id="config_manager_form">';
		$html .= '<div><label>'.JText::_('TPL_GK_LANG_CONFIG_LOAD').'</label>'.$file_select.'<button id="config_manager_load">'.JText::_('TPL_GK_LANG_CONFIG_LOAD_BTN').'</button></div>';
		$html .= '<div><label>'.JText::_('TPL_GK_LANG_CONFIG_SAVE').'</label><input type="text" id="config_manager_save_filename" /><span>.json</span><button id="config_manager_save">'.JText::_('TPL_GK_LANG_CONFIG_SAVE_BTN').'</button></div>';
		$html .= '<div><label>'.JText::_('TPL_GK_LANG_CONFIG_DELETE').'</label>'.$file_delete.'<button id="config_manager_delete">'.JText::_('TPL_GK_LANG_CONFIG_DELETE_BTN').'</button></div>';
		$html .= '<div><label>'.JText::_('TPL_GK_LANG_CONFIG_DIRECTORY').'</label><span>'.$base_path.'</span></div>';
		$html .= '</div>';
		// finish the output
		return $html;
	}
	protected function getOptions() {
		$options = array();
		$path = (string) $this->element['directory'];
		if (!is_dir($path)) $path = JPATH_ROOT.'/'.$path;
		$files = JFolder::files($path, '.json');
		if (is_array($files)) {
			foreach($files as $file) {
				$options[] = JHtml::_('select.option', $file, $file);
			}
		}
		return array_merge($options);
	}
}
/* EOF */