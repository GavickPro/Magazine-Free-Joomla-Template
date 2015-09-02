<?php

// No direct access.
defined('_JEXEC') or die;

$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
?>

<?php if($this->API->get('fb_login', '0') == 1 || ($this->API->get('fb_like', '0') == 1 && $option == 'com_content' && $view == 'article')) : ?>
<gavern:social>
<div id="gkfb-root"></div>
<?php if($this->API->get('cookie_consent', '0') == 0) : ?>
<script type="text/javascript">
<?php else : ?>
<script type="text/plain" class="cc-onconsent-social">
<?php endif; ?>

//<![CDATA[
   	window.fbAsyncInit = function() {
		FB.init({ appId: '<?php echo $this->API->get('fb_api_id', ''); ?>', 
			status: true, 
			cookie: true,
			xfbml: true,
			oauth: true
		});
   		    
	  	<?php if($this->API->get('fb_login', '0') == 1) : ?>
	  	function updateButton(response) {
	    	var button = document.getElementById('fb-auth');
		
			if(button) {   
			    if (response.authResponse) {
			    // user is already logged in and connected
			    button.onclick = function() {
			        if(jQuery('#login-form').length > 0){
			            jQuery('#modlgn-username').val('Facebook');
			            jQuery('#modlgn-passwd').val('Facebook');
			            jQuery('#login-form').submit();
			        } else if(jQuery('#com-login-form').length > 0) {
			           jQuery('#username').val('Facebook');
			           jQuery('#password').val('Facebook');
			           jQuery('#com-login-form').submit();
			        }
			    }
			} else {
			    //user is not connected to your app or logged out
			    button.onclick = function() {
			        FB.login(function(response) {
			           if (response.authResponse) {
			              if(jQuery('#login-form').length > 0){
			                jQuery('#modlgn-username').val('Facebook');
			                jQuery('#modlgn-passwd').val('Facebook');
			                jQuery('#login-form').submit();
			              } else if(jQuery('#com-login-form').length > 0) {
			                 jQuery('#username').val('Facebook');
			                 jQuery('#password').val('Facebook');
			                 jQuery('#com-login-form').submit();
			              }
			          } else {
			            //user cancelled login or did not grant authorization
			          }
			        }, {scope:'email'});   
			    }
	    	}
	    }
	  }
	  // run once with current status and whenever the status changes
	  FB.getLoginStatus(updateButton);
	  FB.Event.subscribe('auth.statusChange', updateButton);	
	  <?php endif; ?>
	};
    //      
    jQuery(window).load(function() {
    	(function(){
    		if(!document.getElementById('fb-root')) {
    			var root = document.createElement('div');
    			root.id = 'fb-root';
    			document.getElementById('gkfb-root').appendChild(root);
    			var e = document.createElement('script');
    			e.src = document.location.protocol + '//connect.facebook.net/<?php echo $this->API->get('fb_lang', 'en_US'); ?>/all.js';
    			e.async = true;
    			document.getElementById('fb-root').appendChild(e);
    		}  
    	})();
    });
    //]]>
</script>
</gavern:social>
<?php endif; ?>

<!-- +1 button -->
<?php if($this->API->get('google_plus', '1') == 1 && $option == 'com_content' && $view == 'article') : ?>
<gavern:social>
<?php if($this->API->get('cookie_consent', '0') == 0) : ?>
<script type="text/javascript">
<?php else : ?>
<script type="text/plain" class="cc-onconsent-social">
<?php endif; ?>
  window.___gcfg = {
    lang: '<?php echo $this->API->get("google_plus_lang", "en-GB"); ?>',
    parsetags: 'onload'
  };
</script>
<script src="//apis.google.com/js/platform.js" <?php if($this->API->get('cookie_consent', '0') == 1) : ?>type="text/plain" class="cc-onconsent-social"<?php endif; ?> async defer></script>
</gavern:social>
<?php endif; ?>

<!-- twitter -->
<?php if($this->API->get('tweet_btn', '0') == 1 && $option == 'com_content' && $view == 'article') : ?>
     <?php if($this->API->get('cookie_consent', '0') == 0) : ?>
     <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
     <?php else : ?>
     <script type="text/plain" class="cc-onconsent-social" src="//platform.twitter.com/widgets.js"></script>
     <?php endif; ?>
<?php endif; ?>


<!-- Pinterest script --> 
<?php if($this->API->get('pinterest_btn', '1') == 1 && $option == 'com_content' && $view == 'article') : ?><gavern:social>
<?php if($this->API->get('cookie_consent', '0') == 0) : ?>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<?php else : ?>
<script type="text/plain" class="cc-onconsent-social" src="//assets.pinterest.com/js/pinit.js"></script>
<?php endif; ?>

</gavern:social>
<?php endif; ?>
