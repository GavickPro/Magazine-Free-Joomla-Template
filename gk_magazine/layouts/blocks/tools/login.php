<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// getting user ID
$user = JFactory::getUser();
$userID = $user->get('id');

?>

<?php if($this->API->modules('login') && !GK_COM_USERS) : ?>
<div id="gkPopupLogin">	
	<div class="gkPopupWrap">
		<div id="loginForm">
			<div class="clear overflow">
				<?php if($userID > 0) : ?>
				<div>
				<?php endif; ?>
					<jdoc:include type="modules" name="login" style="<?php echo $this->module_styles['login']; ?>" />
				<?php if($userID > 0) : ?>
				</div>
				<?php endif; ?>
				
				<?php if($userID > 0) : ?>
				<div class="gkUsermenu">
					<jdoc:include type="modules" name="usermenu" style="<?php echo $this->module_styles['usermenu']; ?>" />
				</div>
				<?php endif; ?>
			</div>
		</div>	     
	</div>
</div>
<?php endif; ?>