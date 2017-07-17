<?php

// no direct access
defined('_JEXEC') or die;

?>
<section class="newsfeed<?php echo $this->pageclass_sfx?><?php echo $direction; ?>">
	<header>
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		<?php endif; ?>
		
		<h2>
			<a href="<?php echo $this->item->link; ?>" target="_blank">
				<?php echo str_replace('&apos;', "'", $this->item->name); ?></a>
		</h2>
	
		<?php if ($this->params->get('show_feed_description')) : ?>
		<div>
			<?php echo str_replace('&apos;', "'", $this->item->description); ?>
		</div>
		<?php endif; ?>
		
		
		<?php if ($this->params->get('show_tags', 1)) : ?>
			<span class="tags-label"><?php echo JText::sprintf('TPL_GK_LANG_TAGGED_UNDER'); ?></span> 
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<?php endif; ?>
	</header>
	
	<!-- Show Image -->
	<?php if (isset($this->rssDoc->image) && isset($this->rssDoc->imagetitle) && $this->params->get('show_feed_image')) : ?>
	<div class="feed-img">
		<img src="<?php echo $this->rssDoc->image; ?>" alt="<?php echo $this->rssDoc->image->description; ?>" />
	</div>
	<?php endif; ?>
	
	<?php if(!empty($this->rssDoc[0])) : ?>
	<div>
		<?php for ($i = 0; $i < $this->item->numarticles; $i++) : ?>
		<div>
			<?php if (!is_null($this->rssDoc[$i]->uri)) : ?>
			<h2>
				<a href="<?php echo $this->rssDoc[$i]->uri; ?>" target="_blank">
					<?php echo $this->rssDoc[$i]->title; ?>
				</a>
			</h2>
			<?php endif; ?>
			
			<?php if ($this->params->get('show_item_description')) : ?>
			<div class="feed-item-description">
				<?php 
					$text = !empty($this->rssDoc[$i]->content) || !is_null($this->rssDoc[$i]->content) ? $this->rssDoc[$i]->content : $this->rssDoc[$i]->description;
					if($this->params->get('show_feed_image', 0) == 0) {
						$text = JFilterOutput::stripImages($text);
					}
					$text = JHtml::_('string.truncate', $text, $this->params->get('feed_character_count'));
					echo str_replace('&apos;', "'", $text);
				?>

			</div>
			<?php endif; ?>
		</div>
		<hr />
		<?php endfor; ?>
	</div>
	<?php endif; ?>
</section>