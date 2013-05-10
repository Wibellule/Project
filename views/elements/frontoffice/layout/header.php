<header id="header" class="container clearfix">
	<a href="index-2.html" id="logo">
		<img src="<?php echo Router::webroot("img/logo.png");?>" alt="SmartStart">
	</a>
	<?php //include(FRONTOFFICE.DS.'layout'.DS.'menu.php');?>
	<nav id="main-nav">
	<ul>
	  <li class="current"><a href="<?php echo router::url('/');?>" data-description="Tout commence ici">Accueil</a></li>
	  <li><a href="<?php echo router::url('portefolio');?>" data-description="Tous nos projets">Portefolio</a></li>
	  <li><a href="<?php echo router::url('blog');?>" data-description="Actualités">Blog</a></li>
			<?php foreach($pages as $p){ ?>
			<li>
				<a href="<?php echo router::url('categories/view/id:'.$p['id'].'/slug:'.$p['slug']);?>" title="<?php echo $p['name'];?>" data-description="<?php echo $p['name'];?>">
					<?php echo $p['name'];?>
				</a>
			</li>
		<?php } ?>
	</ul>
</nav>
</header>