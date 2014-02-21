<?php

/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */

// no direct access
defined('_JEXEC') or die;

// Code used to generate the page elements
$params = $this->item->params;
$k2ContainerClasses = (($this->item->featured) ? ' itemIsFeatured' : '') . ($params->get('pageclass_sfx')) ? ' '.$params->get('pageclass_sfx') : ''; 

$app        = JFactory::getApplication();
$template   = $app->getTemplate(true);
$gkparams     = $template->params;
$fblang   = $gkparams->get('fb_lang', 'en_US');
?>
<?php if(JRequest::getInt('print')==1): ?>

<a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print(); return false;"> <?php echo JText::_('K2_PRINT_THIS_PAGE'); ?> </a>
<?php endif; ?>
<article id="k2Container" class="itemView<?php echo $k2ContainerClasses; ?>"> <?php echo $this->item->event->BeforeDisplay; ?> <?php echo $this->item->event->K2BeforeDisplay; ?>
			<?php if(isset($this->item->editLink)): ?>
			<a class="itemEditLink modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>"><?php echo JText::_('K2_EDIT_ITEM'); ?></a>
			<?php endif; ?>
			<header>
					<?php if(
						$params->get('itemFontResizer') ||
						$params->get('itemAuthor') ||
						$params->get('itemPrintButton') ||
						$params->get('itemEmailButton') ||
						$params->get('itemSocialButton') ||
						$params->get('itemVideoAnchor') ||
						$params->get('itemImageGalleryAnchor') ||
						$params->get('itemHits') ||
						$params->get('itemCategory')
					): ?>
						<ul>
									<?php if($this->item->params->get('itemDateCreated')): ?>
									<li class="itemDate">
												<time datetime="<?php echo JHtml::_('date', $this->item->created, JText::_(DATE_W3C)); ?>"> <?php echo JHTML::_('date', $this->item->created, JText::_('F j, Y')); ?> </time>
									</li>
									<?php endif; ?>
									<?php if($params->get('itemAuthor')): ?>
									<li class="itemAuthor"> <?php echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?>&nbsp;
												<?php if(empty($this->item->created_by_alias)): ?>
												<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
												<?php else: ?>
												<?php echo $this->item->author->name; ?>
												<?php endif; ?>
									</li>
									<?php endif; ?>
									<?php if($params->get('itemCategory')): ?>
									<li class="itemCategory"> <span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span> <a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a> </li>
									<?php endif; ?>
									<?php if($params->get('itemHits')): ?>
									<li class="itemHits"> <?php echo JText::_('K2_READ'); ?> <strong><?php echo $this->item->hits; ?></strong> <?php echo JText::_('K2_TIMES'); ?> </li>
									<?php endif; ?>
									<?php if($params->get('itemFontResizer')): ?>
									<li class="itemResizer"> <span><?php echo JText::_('K2_FONT_SIZE'); ?></span> <a href="#" id="fontDecrease"><?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?></a> <a href="#" id="fontIncrease"><?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?></a> </li>
									<?php endif; ?>
									<?php if($params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
									<li class="itemPrint"> <a rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;"> <?php echo JText::_('K2_PRINT'); ?> </a> </li>
									<?php endif; ?>
									<?php if($params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
									<li class="itemEmail"> <a rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;"> <?php echo JText::_('K2_EMAIL'); ?> </a> </li>
									<?php endif; ?>
									<?php if($params->get('itemCommentsAnchor') && $params->get('itemComments') && ( ($params->get('comments') == '2' && !$this->user->guest) || ($params->get('comments') == '1')) ): ?>
									<li>
												<?php if(!empty($this->item->event->K2CommentsCounter)): ?>
												<!-- K2 Plugins: K2CommentsCounter --> 
												<?php echo $this->item->event->K2CommentsCounter; ?>
												<?php else: ?>
												<?php if($this->item->numOfComments > 0): ?>
												<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor"> <span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?> </a>
												<?php else: ?>
												<a class="itemCommentsLink k2Anchor" href="<?php echo $this->item->link; ?>#itemCommentsAnchor"> <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?> </a>
												<?php endif; ?>
												<?php endif; ?>
									</li>
									<?php endif; ?>
									<?php if($params->get('itemSocialButton') && !is_null($params->get('socialButtonCode', NULL))): ?>
									<li class="itemSocial"> <?php echo $params->get('socialButtonCode'); ?> </li>
									<?php endif; ?>
									<?php if($params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
									<li class="itemVideo"> <a class="k2Anchor" href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('K2_MEDIA'); ?></a> </li>
									<?php endif; ?>
									<?php if($params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
									<li class="itemGallery"> <a class="k2Anchor" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('K2_IMAGE_GALLERY'); ?></a> </li>
									<?php endif; ?>
						</ul>
						<?php endif; ?>
						<?php if($params->get('itemTitle')): ?>
						<h1> <?php echo $this->item->title; ?>
									<?php if($params->get('itemFeaturedNotice') && $this->item->featured): ?>
									<sup><?php echo JText::_('K2_FEATURED'); ?></sup>
									<?php endif; ?>
						</h1>
						<?php endif; ?>
			</header>
			<?php echo $this->item->event->AfterDisplayTitle; ?> <?php echo $this->item->event->K2AfterDisplayTitle; ?>
			<?php if($params->get('itemImage') && !empty($this->item->image)): ?>
			<div class="itemImageBlock">
						<a class="itemImage modal" rel="{handler: 'image'}" href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>"> <img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" /> </a>
						<?php if($params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
						<span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
						<?php endif; ?>
						<?php if($params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
						<span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
						<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="itemBody">
						<?php echo $this->item->event->BeforeDisplayContent; ?> <?php echo $this->item->event->K2BeforeDisplayContent; ?>
						<?php if(!empty($this->item->fulltext)): ?>
						<?php if($params->get('itemIntroText')): ?>
						<div class="itemIntroText">
									<?php echo $this->item->introtext; ?>
						</div>
						<?php endif; ?>
						<?php endif; ?>
						<?php if($params->get('itemFullText')): ?>
						<div class="itemFullText">
									<?php echo (!empty($this->item->fulltext)) ? $this->item->fulltext : $this->item->introtext; ?>
						</div>
						<?php endif; ?>
						<?php if(($params->get('itemDateModified') && intval($this->item->modified)!=0)): ?>
						<div class="itemBottom">
									<?php if($params->get('itemDateModified') && intval($this->item->modified) != 0 && $this->item->created != $this->item->modified): ?>
									<small class="itemDateModified"> <?php echo JText::_('K2_LAST_MODIFIED_ON') . JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?> </small>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
						<div class="itemExtraFields">
									<h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
									<ul>
												<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
												<?php if($extraField->value != ''): ?>
												<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
															<?php if($extraField->type == 'header'): ?>
															<h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
															<?php else: ?>
															<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span> <span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
															<?php endif; ?>
												</li>
												<?php endif; ?>
												<?php endforeach; ?>
									</ul>
						</div>
						<?php endif; ?>
						<?php echo $this->item->event->AfterDisplayContent; ?> <?php echo $this->item->event->K2AfterDisplayContent; ?>
						<?php if(
				$params->get('itemTags') ||
				$params->get('itemTwitterButton',1) || 
				$params->get('itemFacebookButton',1) || 
				$params->get('itemGooglePlusOneButton',1) ||
				$params->get('itemAttachments') ||
				$params->get('itemRating')
			): ?>
						<div class="itemLinks">
									<?php if($params->get('itemAttachments') && count($this->item->attachments)): ?>
									<div class="itemAttachmentsBlock">
												<span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
												<ul class="itemAttachments">
															<?php foreach ($this->item->attachments as $attachment): ?>
															<li> <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?>
																		<?php if($params->get('itemAttachmentsCounter')): ?>
																		<span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits==1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
																		<?php endif; ?>
																		</a> </li>
															<?php endforeach; ?>
												</ul>
									</div>
									<?php endif; ?>
									<?php if($params->get('itemRating')): ?>
									<div class="itemRatingBlock">
												<span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
												<div class="itemRatingForm">
															<ul class="itemRatingList">
																		<li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
																		<li> <a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a> </li>
																		<li> <a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a> </li>
																		<li> <a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a> </li>
																		<li> <a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a> </li>
																		<li> <a href="#" rel="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a> </li>
															</ul>
															<div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog">
																		<?php echo $this->item->numOfvotes; ?>
															</div>
												</div>
									</div>
									<?php endif; ?>
									<?php if($params->get('itemTags') && count($this->item->tags)): ?>
									<div class="itemTagsBlock">
												<span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
												<ul class="itemTags">
															<?php foreach ($this->item->tags as $tag): ?>
															<li> <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a> </li>
															<?php endforeach; ?>
												</ul>
									</div>
									<?php endif; ?>
									<?php if($params->get('itemTwitterButton',1) || $params->get('itemFacebookButton',1) || $params->get('itemGooglePlusOneButton',1)): ?>
									<div class="itemSocialSharing">
												<?php if($params->get('itemTwitterButton',1)): ?>
												<div class="itemTwitterButton">
															<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($params->get('twitterUsername')): ?> data-via="<?php echo $params->get('twitterUsername'); ?>"<?php endif; ?>><?php echo JText::_('K2_TWEET'); ?></a> 
															<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
												</div>
												<?php endif; ?>
												<?php if($params->get('itemFacebookButton',1)): ?>
												<div class="itemFacebookButton">
															<script type="text/javascript">                                                         window.addEvent('load', function(){
									      (function(){
									                  if(document.id('fb-auth') == null) {
									                  var root = document.createElement('div');
									                  root.id = 'fb-root';
									                  $$('.itemFacebookButton')[0].appendChild(root);
									                  (function(d, s, id) {
									                    var js, fjs = d.getElementsByTagName(s)[0];
									                    if (d.getElementById(id)) {return;}
									                    js = d.createElement(s); js.id = id;
									                    js.src = document.location.protocol + "//connect.facebook.net/<?php echo $fblang; ?>/all.js#xfbml=1";
									                    fjs.parentNode.insertBefore(js, fjs);
									                  }(document, 'script', 'facebook-jssdk')); 
									              }
									      }());
									  });
									</script>
															<div class="fb-like" data-send="false" data-width="260" data-show-faces="true">
															</div>
												</div>
												<?php endif; ?>
												<?php if($params->get('itemGooglePlusOneButton',1)): ?>
												<div class="itemGooglePlusOneButton">
															<g:plusone annotation="inline" width="120"></g:plusone>
															<script type="text/javascript">
		                          (function() {
		                            window.___gcfg = {lang: 'en'}; // Define button default language here
		                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		                            po.src = 'https://apis.google.com/js/plusone.js';
		                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		                          })();
		                    </script>
												</div>
												<?php endif; ?>
									</div>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if(($params->get('itemAuthorBlock') && empty($this->item->created_by_alias)) || ($params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems))):?>
						<div class="itemAuthorData">
									<?php if($params->get('itemAuthorBlock') && empty($this->item->created_by_alias)):?>
									<div class="itemAuthorBlock">
												<?php if($params->get('itemAuthorImage') && !empty($this->item->author->avatar)):?>
												<div class="gkAvatar">
															<img src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
												</div>
												<?php endif; ?>
												<div class="itemAuthorDetails">
															<h3> <a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a> </h3>
															<?php if($params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)):?>
															<?php echo $this->item->author->profile->description; ?>
															<?php endif; ?>
															<?php if($params->get('itemAuthorURL') && !empty($this->item->author->profile->url)):?>
															<span class="itemAuthorUrl"><?php echo JText::_('K2_WEBSITE'); ?> <a rel="me" href="<?php echo $this->item->author->profile->url; ?>" target="_blank" rel="nofollow"> <?php echo str_replace('http://','',$this->item->author->profile->url); ?> </a> </span>
															<?php endif; ?>
															<?php if($params->get('itemAuthorEmail')):?>
															<span class="itemAuthorEmail"><?php echo JText::_('K2_EMAIL'); ?> <?php echo JHTML::_('Email.cloak', $this->item->author->email); ?> </span>
															<?php endif; ?>
												</div>
												<?php echo $this->item->event->K2UserDisplay; ?>
									</div>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemRelated') && isset($this->relatedItems)): ?>
						<div class="itemAuthorContent">
									<h3><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></h3>
									<ul>
												<?php foreach($this->relatedItems as $key=>$item): ?>
												<li class="<?php echo ($key%2) ? "odd" : "even"; ?>"> <a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a> </li>
												<?php endforeach; ?>
									</ul>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
						<div class="itemAuthorContent">
									<?php if($params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
									<h3><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
									<ul>
												<?php foreach($this->authorLatestItems as $key=>$item): ?>
												<li class="<?php echo ($key%2) ? "odd" : "even"; ?>"> <a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a> </li>
												<?php endforeach; ?>
									</ul>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemVideo') && !empty($this->item->video)): ?>
						<div class="itemVideoBlock" id="itemVideoAnchor">
									<h3><?php echo JText::_('K2_MEDIA'); ?></h3>
									<?php if($this->item->videoType=='embedded'): ?>
									<div class="itemVideoEmbedded">
												<?php echo $this->item->video; ?>
									</div>
									<?php else: ?>
									<span class="itemVideo"><?php echo $this->item->video; ?></span>
									<?php endif; ?>
									<?php if($params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
									<span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
									<?php endif; ?>
									<?php if($params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
									<span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
						<div class="itemImageGallery" id="itemImageGalleryAnchor">
									<h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
									<?php echo $this->item->gallery; ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
						<div class="itemNavigation">
									<span><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>
									<?php if(isset($this->item->previousLink)): ?>
									<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">&laquo; <?php echo $this->item->previousTitle; ?></a>
									<?php endif; ?>
									<?php if(isset($this->item->nextLink)): ?>
									<a class="itemNext" href="<?php echo $this->item->nextLink; ?>"><?php echo $this->item->nextTitle; ?> &raquo;</a>
									<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php echo $this->item->event->AfterDisplay; ?> <?php echo $this->item->event->K2AfterDisplay; ?>
			</div>
			<?php if($params->get('itemComments') && ( ($params->get('comments') == '2' && !$this->user->guest) || ($params->get('comments') == '1'))):?>
			<?php echo $this->item->event->K2CommentsBlock; ?>
			<?php endif;?>
			<?php if($params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)):?>
			<div class="itemComments" id="itemCommentsAnchor">
						<?php if($params->get('commentsFormPosition')=='above' && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
						<div class="itemCommentsForm">
									<?php echo $this->loadTemplate('comments_form'); ?>
						</div>
						<?php endif; ?>
						<?php if($this->item->numOfComments>0 && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2'))): ?>
						<h3> <?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?> </h3>
						<ul class="itemCommentsList">
									<?php foreach ($this->item->comments as $key=>$comment): ?>
									<li class="<?php echo ($key%2) ? "odd" : "even"; echo (!$this->item->created_by_alias && $comment->userID==$this->item->created_by) ? " authorResponse" : ""; echo($comment->published) ? '':' unpublishedComment'; ?>">
												<?php if($comment->userImage):?>
												 <img src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" width="<?php echo $params->get('commenterImgWidth'); ?>" /> 
												<?php endif; ?>
												<div><span> 
															<?php if(!empty($comment->userLink)): ?>
															<a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow"> <?php echo $comment->userName; ?> </a>
															<?php else: ?>
															<?php echo $comment->userName; ?>
															<?php endif; ?>
															</span> <span> <?php echo JHTML::_('date', $comment->commentDate, JText::_('DATE_FORMAT_LC2')); ?> </span> <span> <a class="commentLink" href="<?php echo $this->item->link; ?>#comment<?php echo $comment->id; ?>" name="comment<?php echo $comment->id; ?>" id="comment<?php echo $comment->id; ?>"> <?php echo JText::_('K2_COMMENT_LINK'); ?> </a> </span>
															<p><?php echo $comment->commentText; ?></p>
															<?php if($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))): ?>
															<span class="commentToolbar">
															<?php if($this->inlineCommentsModeration): ?>
															<?php if(!$comment->published): ?>
															<a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
															<?php endif;?>
															<a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
															<?php endif;?>
															<?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
															<a class="commentReportLink modal" rel="{handler:'iframe',size:{x:640,y:480}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPORT')?></a>
															<?php endif; ?>
															</span>
															<?php endif; ?>
															
												</div>
									</li>
									<?php endforeach; ?>
						</ul>
						<div>
									<?php echo $this->pagination->getPagesLinks(); ?>
						</div>
						<?php endif; ?>
						<?php if($params->get('commentsFormPosition')=='below' && $params->get('itemComments') && !JRequest::getInt('print') && ($params->get('comments') == '1' || ($params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
						<h3> <?php echo JText::_('K2_LEAVE_A_COMMENT') ?> </h3>
						<div class="itemCommentsForm">
									<?php echo $this->loadTemplate('comments_form'); ?>
						</div>
						<?php endif; ?>
						<?php $user = JFactory::getUser(); if ($params->get('comments') == '2' && $user->guest):?>
						<div>
									<?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS');?>
						</div>
						<?php endif; ?>
			</div>
			<?php endif; ?>
			
</article> 
