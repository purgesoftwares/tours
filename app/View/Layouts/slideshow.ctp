<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en"  xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php echo $this->Html->charset(); ?>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="author" content="Shankar Palsaniya" />
		
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../favicon.ico"> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<meta property="og:title" content="<?php echo $title_for_layout; ?> | <?php echo Configure::read('Site.title'); //$cakeDescription ?>">
	<meta property="og:image" content="<?php echo $first_image_url; ?>">
	
	<meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <title><?php echo Configure::read('Site.title'); //$cakeDescription ?>:<?php echo $title_for_layout; ?></title>
     <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('slideshow/bootstrap-yii.css','slideshow/jquery-ui-bootstrap.css','slideshow/bootstrap-notify.css','slideshow/bootstrap-combined.min.css','slideshow/gallery.css','slideshow/font-awesome.css','slideshow/theme.css'));
		
		echo $this->Html->script(array('jquery.js'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!--[if lte IE 9]>
		<script src="<?php echo WEBSITE_URL ; ?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	<link rel="shortcut icon" href="<?php echo $this->webroot;?>imgdsfsdf/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot;?>img/apple-touch-icon-precomposed.png" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
  <noscript>
    <meta http-equiv="refresh" content="0;URL=<?php echo WEBSITE_ADMIN_URL;?>noscript">
	<style>
				.es-carousel ul{
					display:block;
				}
			</style>
</noscript>  

    </head>
  
    <body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);" >
		<div id="content">
			<?php echo $this->fetch('content'); ?>
			
		</div><!-- container -->
		<?php echo $this->element('sql_dump'); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		 
<?php 
echo $this->Html->script(array(/* 'slideshow/nr-632.min.js', */'slideshow/bootstrap.min.js',/* 'slideshow/piwik.js', */'slideshow/bootstrap.bootbox.min.js','slideshow/bootstrap.notify.js','slideshow/juicebox.js'/* ,'slideshow/addthis_widget.js' */));
?>
<script type="text/javascript">
/*<![CDATA[*/
  /* var _paq = _paq || [];
  _paq.push(["setCookieDomain", "*.tourshout.com"]);
  // you can set up to 5 custom variables for each visitor
  _paq.push(["setCustomVariable", 1, "group", "85", "page"]);
  _paq.push(["setCustomVariable", 2, "clientId", "1104", "page"]);
  _paq.push(["setCustomVariable", 3, "galleryId", "11217", "page"]);
  _paq.push(["setCustomVariable", 4, "branded", "1", "page"]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);
 */

function hideAddressBar()
{
    if(!window.location.hash)
    {
        if(document.height <= window.outerHeight + 10)
        {
            document.body.style.height = (window.outerHeight + 50) +'px';
            setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
        }
        else
        {
            setTimeout( function(){ window.scrollTo(0, 1); }, 0 );
        }
    }
}
window.addEventListener("load", hideAddressBar );
window.addEventListener("orientationchange", hideAddressBar );


    function doLayout() {
        var winHeight, headerHeight, footerHeight;
        // winHeight = window.innerHeight ? window.innerHeight : $(window).height();
		if($(window).width()>$(window).height())
        winHeight = window.innerHeight ? window.innerHeight : $(window).height();
		else
        winHeight = window.innerWidth ? window.innerWidth : $(window).width();
		
        headerHeight = $('#header').outerHeight();
        footerHeight = $('#footer').outerHeight();
		if($(window).width()>$(window).height())
        var newH = parseInt(winHeight) - parseInt(headerHeight);
		else
        var newH = (parseInt(winHeight)*.75) - parseInt(headerHeight);
        $('#juicebox-content').height(newH);
    }

    $(document).ready(function () {
        doLayout();
        $(window).bind('resize', 'orientationchange', doLayout);
        $jb = new juicebox({
            containerid : 'juicebox-container',
            showSmallThumbsOnLoad: 'FALSE',
            useFullscreenExpand: 'TRUE',
            configURL : '<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'slideshow','action'=>"xml",base64_encode($id))); ?>',
            buttonBarPosition: 'OVERLAY_IMAGE',
            imageScaleMode: 'SCALE',
            captionPosition: 'NONE',
			galleryheight: "95%",
            showOpenButton: 'FALSE',
            enableAutoPlay: 'TRUE',
			showAutoPlayButton: 'TRUE',
			showAutoPlayStatus : 'FALSE',
            autoPlayOnLoad: 'TRUE',
            imageVAlign: 'TOP',
            buttonBarHAlign : 'LEFT',
            imagePreloading: 'PAGE',
            imageTransitionTime: '.75',
            imageTransitionType: 'FADE',
            showSplashPage: 'NEVER',
            galleryWidth: '100%',
            showExpandButton: 'FALSE',
            showSmallThumbsButton: 'TRUE',
            imageClickMode: 'NONE',
            imageNavPosition: 'IMAGE',
            thumbsVAlign: 'TOP'
        });
        $('.jb-thm-thumb-image').bind('contentchange', function() {
            $(".jb-thm-thumb-image").attr("nopin", "nopin");
        });

    });
/*]]>*/
</script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
jQuery('[data-toggle=popover]').popover();
jQuery('body').tooltip({"selector":"[data-toggle=tooltip]"});
jQuery('#yii_bootstrap_collapse_0').collapse({'parent':false,'toggle':false});
});
/*]]>*/
</script>
	<?php 
		$footers = $this->requestAction('users/footer');
	?>
	<footer id="footer">
		<p><?php  echo $footers['copyright_text']['Setting']['value']; ?></p>
	</footer>
    </body>
</html>