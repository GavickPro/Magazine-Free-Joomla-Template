<?php

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$params = &$this->params;

?>

<?php foreach ($this->items as $i => $item) : ?>
<article itemscope itemtype="http://schema.org/Article">	
	<header>
		<h1 itemprop="name">
			<?php if ($params->get('link_titles')): ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">  
				<?php echo $this->escape($item->title); ?>
			</a>
			<?php else: ?>
				<?php echo $this->escape($item->title); ?>
			<?php endif; ?>
		</h1>
		
		<?php if (($params->get('show_author')) or ($params->get('show_parent_category')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))  or ($params->get('show_hits')) or ($params->get('show_create_date')) ) : ?>
			<ul>				
				<?php if ($params->get('show_publish_date')) : ?>
				<li><time itemprop="datePublished" datetime="<?php echo JHtml::_('date', $this->item->publish_up, JText::_(DATE_W3C)); ?>"><?php echo JHtml::_('date', $this->item->publish_up, JText::_('l, j F Y')); ?></time></li>
				<?php endif; ?>

				<?php if ($params->get('show_parent_category')) : ?>
				<li class="parent-category-name">
					<?php	$title = $this->escape($item->parent_title);
							$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)).'" itemprop="genre">'.$title.'</a>';?>
					<?php if ($params->get('link_parent_category') && $item->parent_slug) : ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
						<?php else : ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
					<?php endif; ?>
				</li>
				<?php endif; ?>
		
				<?php if ($params->get('show_category')) : ?>
				<?php	$title = $this->escape($item->category_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
				<li class="category-name"><?php if ($params->get('link_category') && $item->catslug) : ?><?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?><?php else : ?><?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?><?php endif; ?></li>
				<?php endif; ?>
		
				<?php if ($params->get('show_modify_date')) : ?>
				<li class="modified"><time datetime="<?php echo JHtml::_('date', $item->modified, DATE_W3C); ?>" itemprop="dateModified"><?php echo JHtml::_('date', $item->modified, JText::_('l, j F Y')); ?></time></li>
				<?php endif; ?>
				
				<?php if ($params->get('show_create_date')) : ?>
				<li class="item-date"><time datetime="<?php echo JHtml::_('date', $item->created, DATE_W3C); ?>" itemprop="dateCreated"><?php echo JHtml::_('date', $item->created, JText::_('l, j F Y')); ?></time></li>
				<?php endif; ?>
		
				<?php if ($params->get('show_author') && !empty($item->author )) : ?>
				<li class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
				<?php $author =  $item->author; ?>
				<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author);?>
					<span itemprop="name">
					<?php if (!empty($item->contactid ) &&  $params->get('link_author') == true):?>
						<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
						 JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid), $author)); ?>
					<?php else :?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
					<?php endif; ?>
					</span>
				</li>
				<?php endif; ?>
		
				<?php if ($params->get('show_hits')) : ?>
				<li class="hits"><meta itemprop="interactionCount" content="UserPageVisits:<?php echo $item->hits; ?>" /><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?></li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
	</header>

	<?php if ($params->get('show_intro')) :?>
	<div class="itemBody<?php if (!$params->get('show_publish_date')) : ?> nodate<?php endif; ?>" itemprop="articleBody">
		<?php echo JString::substr(JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')), 0, -3); ?>
	</div>
	<?php endif; ?>
</article>
<?php endforeach; ?>

<?php echo str_replace('</ul>', '<li class="counter">'.$this->pagination->getPagesCounter().'</li>', $this->pagination->getPagesLinks()); ?>