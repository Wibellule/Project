<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if(isset($title_for_layout) && !empty($title_for_layout)) { ?>
			<title><?php echo $title_for_layout;?></title>
		<?php } ?>
		<?php if(isset($description_for_layout) && !empty($description_for_layout)) { ?>
			<meta name="description" content="<?php echo $description_for_layout; ?>">
		<?php } ?>
	</head>
	<body>
		<ul>
		  <li><a href="<?php echo Router::url('adm');?>" title=""><i class="icon-home"></i>&nbsp;Accueil</a></li>
		  <li><a href="<?php echo Router::url('adm/posts/index');?>" title=""><i class="icon-tag"></i>&nbsp;Articles</a></li>
		  <li><a href="<?php echo Router::url('adm/postscomments/index');?>" title=""><i class="icon-file"></i>&nbsp;Commentaires</a></li>
		  <li><a href="<?php echo Router::url('adm/categories/index');?>" title=""><i class="icon-file"></i>&nbsp;Pages</a></li>
		  <li><a href="<?php echo Router::url('adm/sliders/index');?>" title=""><i class="icon-file"></i>&nbsp;Sliders</a></li>
		  <li><a href="<?php echo Router::url('adm/projects/index');?>" title=""><i class="icon-file"></i>&nbsp;Projets</a></li>
		  <li><a href="<?php echo Router::url('adm/typeposts/index');?>" title=""><i class="icon-file"></i>&nbsp;Type d'articles</a></li>
		  <li><a href="<?php echo Router::url('adm/typeprojects/index');?>" title=""><i class="icon-file"></i>&nbsp;Type de projets</a></li>
		  <li><a href="<?php echo Router::url('users/logout');?>" title=""><i class="icon-ban-circle"></i>&nbsp;Déconnexion</a></li>
		</ul>
		<?php echo $content_for_layout;?>
	</body>	
</html>