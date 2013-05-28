<?php //pr($menuGeneral);?>
<!--<nav id="main-nav">
	<ul>
	  <li class="current"><a href="<?php //echo router::url('/');?>" data-description="Tout commence ici">Accueil</a></li>
	  <li><a href="<?php //echo router::url('portefolio');?>" data-description="Tous nos projets">Portefolio</a></li>
	  <li><a href="<?php //echo router::url('blog');?>" data-description="Actualités">Blog</a></li>
			<?php //foreach($pages as $p){ ?>
			<li>
				<a href="<?php //echo router::url('categories/view/id:'.$p['id'].'/slug:'.$p['slug']);?>" title="<?php //echo $p['name'];?>" data-description="<?php //echo $p['name'];?>">
					<?php //echo $p['name'];?>
				</a>
			</li>
		<?php //} ?>
	</ul>
</nav>-->

<nav id="main-nav">
	<?php $this->helpers['Html']->menu($menuGeneral);?>
</nav>