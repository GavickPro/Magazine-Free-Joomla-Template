<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>


<?php if(stripos($moduleclass_sfx, 'clear') === FALSE) : ?>
<div class="custom<?php echo $moduleclass_sfx; ?>" <?php if ($params->get('backgroundimage')): ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
<?php endif; ?>

	<?php echo $module->content;?>
	
<?php if(stripos($moduleclass_sfx, 'clear') === FALSE) : ?>
</div>
<?php endif; ?>