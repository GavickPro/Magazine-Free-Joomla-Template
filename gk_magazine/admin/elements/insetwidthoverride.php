<?php

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldInsetWidthOverride extends JFormField
{
	public $type = 'InsetWidthOverride';

	protected function getInput() {		
		$html = '';
		$html .= '<div id="inset_width_for_pages_form">';
		$html .= '<div class="label">' . JText::_('TPL_GK_LANG_ADD_RULE_ITEMID_OPTION') . '</div>';
		$html .= '<input type="text" id="inset_width_for_pages_input" />';
		$html .= '<div class="label">' . JText::_('TPL_GK_LANG_ADD_RULE_WIDTH') . '</div>';
		$html .= '<input type="text" value="" id="inset_width_for_pages_select" /><span class="unit">%</span>';
		$html .= '<input type="button" value="'.JText::_('TPL_GK_LANG_ADD_RULE').'" id="inset_width_for_pages_add_btn" />';
		$html .= '<textarea name="'.$this->name.'" id="'.$this->id.'">' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '</textarea>';
		$html .= '<div id="inset_width_for_pages_rules"></div>';
		$html .= '</div>';
		
		return $html;
	}
}
