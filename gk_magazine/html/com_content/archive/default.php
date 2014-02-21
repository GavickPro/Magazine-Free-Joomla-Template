<?php

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<section class="archive<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<header>
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	</header>
	<?php endif; ?>
	
	<form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
		<fieldset class="filters">
	          <?php if ($this->params->get('filter_field') != 'hide') : ?>
	          <label class="filter-search-lbl element-invisible" for="filter-search"><?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL').'&#160;'; ?></label>
	          <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="inputbox span2" onchange="document.getElementById('adminForm').submit();" placeholder="<?php echo JText::_('COM_CONTENT_TITLE_FILTER_LABEL'); ?>" />
	          <?php endif; ?>
	
	
	          <?php echo $this->form->monthField; ?>
	          <?php echo $this->form->yearField; ?>
	          <?php echo $this->form->limitField; ?>
	
	
	          <button type="submit" class="btn btn-primary" style="vertical-align: top;"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
	          <input type="hidden" name="view" value="archive" />
	          <input type="hidden" name="option" value="com_content" />
	          <input type="hidden" name="limitstart" value="0" />
		</fieldset>
	
		<?php echo $this->loadTemplate('items'); ?>
	</form>
</section>