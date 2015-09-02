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
		
		<p id="gkCopyrights">Free <a href="https://www.gavick.com/joomla-templates" title="Best colllection of Joomla Templates">Free Joomla Template by <a href="https://www.gavick.com">GavickPro.com</a>.</a></p>
		
		<?php if($this->API->get('framework_logo', '0') == '1') : ?>
		<a href="http://www.gavick.com" rel="nofollow" id="gkFrameworkLogo" title="Gavern Framework">Gavern Framework</a>
		<?php endif; ?>
	</div>
</footer>