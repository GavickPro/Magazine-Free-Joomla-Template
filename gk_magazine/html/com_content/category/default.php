<?php

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<section class="category<?php echo $this->pageclass_sfx;?>">
	<?php 
		if(
			$this->params->get('show_page_heading', 1) ||
			$this->params->get('show_category_title', 1) || 
			$this->params->get('page_subheading') ||
			(
				(
					$this->params->get('show_description', 1) ||
					$this->params->def('show_description_image', 1)
				)
				&&
				(
					(
						$this->params->get('show_description_image') && 
						$this->category->getParams()->get('image')
					)
					||
					(
						$this->params->get('show_description') && 
						$this->category->description
					)
				)
			)
		) :
	?>
	<header>
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		<?php endif; ?>
	
		<?php if ($this->params->get('show_category_title', 1) || $this->params->get('page_subheading')) : ?>
		<h2>
			<?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
			<small><?php echo $this->category->title;?></small>
			<?php endif; ?>
		</h2>
		<?php endif; ?>
	
		<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<div>
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
			<?php endif; ?>
			
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
			<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</header>
	<?php endif; ?>

	<?php echo $this->loadTemplate('articles'); ?>

	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
	<div class="children">
		<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
		 	<h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
		<?php endif; ?>
		<?php echo $this->loadTemplate('children'); ?>
	</div>
	<?php endif; ?>
</section>