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
		
		<?php if($this->API->get('copyrights', '') !== '') : ?>
		<p id="gkCopyrights"><?php echo $this->API->get('copyrights', ''); ?></p>
		<?php else : ?>
		<p id="gkCopyrights">Template Design &copy; <a href="//www.gavick.com" title="Joomla Templates">Joomla Templates</a> GavickPro. All rights reserved.</p>
		<?php endif; ?>
		
		<?php if($this->API->get('framework_logo', '0') == '1') : ?>
		<a href="//gavick.com" id="gkFrameworkLogo" title="Gavern Framework">Gavern Framework</a>
		<?php endif; ?>
	</div>
</footer>