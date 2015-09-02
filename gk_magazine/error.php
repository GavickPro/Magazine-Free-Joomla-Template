<?php

/**
 *
 * Error view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.factory');
// get the URI instance
$uri = JURI::getInstance();
// get the template params
$templateParams = JFactory::getApplication()->getTemplate(true)->params; 

if($templateParams->get('webmaster_contact_type') != 'none') {
     // get the webmaster e-mail value
     $webmaster_contact = $templateParams->get('webmaster_contact', '');
     if($templateParams->get('webmaster_contact_type') == 'email') {
          // e-mail cloak
          $searchEmail = '([\w\.\-]+\@(?:[a-z0-9\.\-]+\.)+(?:[a-z0-9\-]{2,4}))';
          $searchText = '([\x20-\x7f][^<>]+)';
          $pattern = '~(?:<a [\w "\'=\@\.\-]*href\s*=\s*"mailto:' . $searchEmail . '"[\w "\'=\@\.\-]*)>' . $searchText . '</a>~i';   
          preg_match($pattern, '<a href="mailto:'.$webmaster_contact.'">'.JText::_('TPL_GK_LANG_CONTACT_WEBMASTER').'</a>', $regs, PREG_OFFSET_CAPTURE);
          $replacement = JHtml::_('email.cloak', $regs[1][0], 1, $regs[2][0], 0);
          $webmaster_contact_email = substr_replace($webmaster_contact, $replacement, $regs[0][1], strlen($regs[0][0]));
     }
}

// get necessary template parameters
$templateParams = JFactory::getApplication()->getTemplate(true)->params;
$pageName = JFactory::getDocument()->getTitle();

// get logo configuration
$logo_type = $templateParams->get('logo_type');
$logo_image = $templateParams->get('logo_image');
$template_style = $templateParams->get('template_color');

if(($logo_image == '') || ($templateParams->get('logo_type') == 'css')) {
     $logo_image = JURI::base() . '../images/logo.png';
} else {
     $logo_image = JURI::base() . $logo_image;
}

$logo_text = $templateParams->get('logo_text', '');
$logo_slogan = $templateParams->get('logo_slogan', '');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<title><?php echo $this->error->getCode(); ?>-<?php echo $this->title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo JURI::base(); ?>templates/<?php echo $this->template; ?>/css/system/error.style<?php echo $template_style; ?>.css" type="text/css" />
<?php if($templateParams->get('css_override')) : ?>
<link rel="stylesheet" href="<?php echo JURI::base(); ?>templates/<?php echo $this->template; ?>/css/override.css" type="text/css" />
<?php endif; ?>
</head>
<body>
<div id="gkPage">
		<div id="gkPageTop">
				<?php if ($logo_type !=='none'): ?>
				<?php if($logo_type == 'css') : ?>
				<a href="./" id="gkLogo" class="cssLogo"></a>
				<?php elseif($logo_type =='text') : ?>
				<a href="./" id="gkLogo text"> <span><?php echo $logo_text; ?></span> <small class="gkLogoSlogan"><?php echo $logo_slogan; ?></small> </a>
				<?php elseif($logo_type =='image') : ?>
				<a href="./" id="gkLogo"> <img src="<?php echo $logo_image; ?>" alt="<?php echo $pageName; ?>" />
				</a>
				<?php endif; ?>
				<?php endif; ?>
		</div>
		<div id="gkPageWrap">
				<div id="frame">
						<div id="errorDescription">
								<?php if($this->error->getCode() == 403 || $this->error->getCode() == 404) : ?>
									<h2><span><?php echo $this->error->getCode(); ?></span><?php echo JText::_('TPL_GK_LANG_ERROR_INFO'); ?> </h2>
								<?php else : ?>
									<h2><span><?php echo $this->error->getCode(); ?></span><?php echo $this->error->getMessage(); ?> </h2>
								<?php endif; ?>
								<h3><?php echo JText::_('TPL_GK_LANG_ERROR_DESC'); ?></h3>
						</div>
				</div>
				<div id="errorboxbody"> <a href="<?php echo JURI::base(); ?>" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a> | 
						<?php if($templateParams->get('webmaster_contact_type') == 'email') :
                          echo $webmaster_contact_email;
                     ?>
						<?php elseif($templateParams->get('webmaster_contact_type') == 'url') : ?>
						<a href="<?php echo $webmaster_contact; ?>">
						<?php  echo JText::_('TPL_GK_LANG_CONTACT_WEBMASTER'); ?>
						</a>
						<?php endif; ?>
				</div>
		</div>
</div>
</body>
</html>