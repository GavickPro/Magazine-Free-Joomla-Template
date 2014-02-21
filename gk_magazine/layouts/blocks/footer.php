<?php

// No direct access.
defined('_JEXEC') or die;

?>

<footer id="gkFooter" class="gkPage">
	<div>
		<?php if($this->API->modules('footer_nav')) : ?>
		<div id="gkFooterNav">
			<jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" modnum="<?php echo $this->API->modules('footer_nav'); ?>" />
		</div>
		<?php endif; ?>
		
		<p id="gkCopyrights">Free <a href="http://www.gavick.com/joomla-templates.html" title="Joomla Templates">Joomla Template</a> designed by <a href="http://www.gavick.com">GavickPro</a></p>
		
		<?php if($this->API->get('framework_logo', '0') == '1') : ?>
		<a href="http://www.gavick.com" id="gkFrameworkLogo" title="Gavern Framework">Gavern Framework</a>
		<?php endif; ?>
	</div>
</footer>