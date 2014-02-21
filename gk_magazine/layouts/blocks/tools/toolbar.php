<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

$mail_output = $this->API->get('mail_url', '');

if($this->API->get('mail_url', '')) {
    if(stripos($mail_output, 'mailto:') !== FALSE) {
     	$encoded_email = '';
		$mail_output = str_replace('mailto:', '', $mail_output);

	    for ($i = 0; $i < strlen($mail_output); $i++) {
	    	$encoded_email .= "&#" . ord($mail_output[$i]) . ';';
		}
		
		$mail_output = 'mailto:' . $encoded_email;
    }
}

?>

<aside id="gkToolbar">
	<?php if($this->API->get('show_menu', 1)) : ?>
	<div id="gkMobileMenu">
		<?php echo JText::_('TPL_GK_LANG_MOBILE_MENU'); ?>
		<select onChange="window.location.href=this.value;">
		<?php 
		    $this->parent->mobilemenu->loadMenu($this->API->get('menu_name','mainmenu')); 
		    $this->parent->mobilemenu->genMenu($this->API->get('startlevel', 0), $this->API->get('endlevel',-1));
		?>
		</select>
	</div>
	<?php endif; ?>
	
	<?php if($this->API->get('rss_link', 1) || $this->API->get('mail_link', 1)) : ?>
	<div id="gkLinks">
		<?php if($this->API->get('mail_link', 1) == 1): ?>
		<a href="<?php echo $mail_output ?>" class="gk-icon-email"></a>
		<?php endif; ?>
		
		<?php if($this->API->get('rss_link', 1) == 1): ?>
		<a href="<?php echo $this->API->get('rss_url', ''); ?>" class="gk-icon-rss"></a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<?php if($this->API->modules('search')) : ?>
	<div id="gkSearch" class="gk-icon-search">
		<jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
	</div>
	<?php endif; ?>
	
	<?php if($this->API->modules('social')) : ?>
	<div id="gkSocial">
		<jdoc:include type="modules" name="social" style="<?php echo $this->module_styles['social']; ?>" />
	</div>
	<?php endif; ?>
	
	<?php if($this->API->get('stylearea', '0') == '1') : ?>
	<div id="gkStyleArea" class="gk-icon-cog">
		<div>
	    	<a href="#" id="gkColor1"><?php echo JText::_('TPL_GK_LANG_COLOR_1'); ?></a>
	    	<a href="#" id="gkColor2"><?php echo JText::_('TPL_GK_LANG_COLOR_2'); ?></a>
	  		<a href="#" id="gkColor3"><?php echo JText::_('TPL_GK_LANG_COLOR_3'); ?></a>
	  		<a href="#" id="gkColor4"><?php echo JText::_('TPL_GK_LANG_COLOR_4'); ?></a>
	  		<a href="#" id="gkColor5"><?php echo JText::_('TPL_GK_LANG_COLOR_5'); ?></a>
	  		<a href="#" id="gkColor6"><?php echo JText::_('TPL_GK_LANG_COLOR_6'); ?></a>
	  	</div>
	</div>
	<?php endif; ?>
	
</aside>

<a href="#gkPageTop" class="gk-icon-top" id="gkBackToTop"><!--<?php echo JText::_('TPL_GK_LANG_BACK_TO_TOP'); ?>--></a>