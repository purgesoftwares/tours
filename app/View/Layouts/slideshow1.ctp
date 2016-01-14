<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en"  xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php echo $this->Html->charset(); ?>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="author" content="Shankar Palsaniya" />
		<link rel="shortcut icon" href="../favicon.ico"> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <title><?php echo Configure::read('Site.title'); //$cakeDescription ?>:<?php echo $title_for_layout; ?></title>
     <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('slideshow/demo.css','slideshow/style.css','slideshow/elastislide.css','slideshow/demo.css'));
		
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
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
    </head>
  
    <body>
		<div class="container">
			<?php echo $this->fetch('content'); ?>
			
		</div><!-- container -->
		<?php echo $this->element('sql_dump'); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php 
echo $this->Html->script(array('slideshow/jquery.tmpl.min.js','slideshow/jquery.easing.1.3.js','slideshow/jquery.elastislide.js','slideshow/gallery.js'));
?>
	<?php 
		$footers = $this->requestAction('users/footer');
	?>
	<footer id="footer">
		<p><?php  echo $footers['copyright_text']['Setting']['value']; ?></p>
	</footer>
    </body>
</html>