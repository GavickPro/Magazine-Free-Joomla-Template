<?php

// No direct access.
defined('_JEXEC') or die;

$app    = JFactory::getApplication();
$menu 	= $app->getMenu();
$lang 	= JFactory::getLanguage();

?>

<footer id="gkFooter" class="gkPage">
	<div>
		<?php if($this->API->modules('footer_nav')) : ?>
		<div id="gkFooterNav">
			<jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" modnum="<?php echo $this->API->modules('footer_nav'); ?>" />
		</div>
		<?php endif; ?>
		
		<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?> 
				<p id="gkCopyrights">Joomla &amp; WordPress Theme designed by
               <a href="https://www.gavick.com/joomla-templates" title="Joomla template designed by GavickPro" rel="nofollow">GavickPro</a></p>
		<?php else : ?>
				<p id="gkCopyrights">Joomla Templates &amp; WordPress Themes - GavickPro</p>
		<?php endif; ?>
		
		<?php if($this->API->get('framework_logo', '0') == '1') : ?>
		<a href="https://www.gavick.com/" rel="nofollow" id="gkFrameworkLogo" title="Gavern Framework">Gavern Framework</a>
		<?php endif; ?>
	</div>
</footer>