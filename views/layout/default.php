﻿<?php $pages = $this->requestAction('categories','getMenu');?>
<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="fr">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="fr">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="fr">  <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Home - SmartStart</title>
	<meta name="description" content="">
	<meta name="author" content="">
    <?php $this->element(FRONTOFFICE.DS.'layout'.DS.'css.php');?>
    <?php $this->element(FRONTOFFICE.DS.'layout'.DS.'js.php');?>
</head>
	<body>		
		
		<?php $this->element(FRONTOFFICE.DS.'layout'.DS.'header.php', array('pages' => $pages));?>
		
		<section id="content" class="container clearfix">
			
			<?php echo $content_for_layout; ?>
		
		</section>
		
		<?php $this->element(FRONTOFFICE.DS.'layout'.DS.'footer.php');?>
		
		<?php $this->element(FRONTOFFICE.DS.'layout'.DS.'js_2.php');?>
		
	</body>
</html>