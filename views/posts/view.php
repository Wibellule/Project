<?php
$title_for_layout = $post['name'];
$description_for_layout = $post['name'];
?>


<header class="page-header">

	<h1 class="page-title"><?php echo $post['name'];?></h1>	
	
</header><!-- end .page-header -->

<section id="main">

	<?php 
	switch($post['tag']){ 
	
		case $post['tag']:
		
			include(FRONTOFFICE.DS.'post_view'.DS.lcfirst($post['tag']).'.php');
			
		break; 
	
	}
	/* Affichage des commentaires */
	?>
	<section id="comments">
		<h6 class="section-title">Commentaires (<?php echo $nbcomments;?>)</h6>
		<ol class="comments-list">
			<?php foreach($comments as $k => $v){ ?>
				<li class="comment">
					<article>
						<img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=50" alt="Image" class="avatar"/>
						<div class="comment-meta">
							<h5 class="author"><a href="#"><?php echo $v['name'];?></a></h5>
							<p class="date"><?php echo $v['created'];?></p>
						</div><!-- end .comment-meta -->
						<div class="comment-body">
							<p><?php echo $v['message'];?></p>
						</div><!-- end .comment-body -->
					</article>
				</li>
			<?php } ?>
		</ol>
	</section>
	<?php
	/* Affichage du formulaire de commentaires */
	if($post['display_option'] == 1){ 
	
		echo $this->helpers['Html']->comment($post['id'],$post['slug']);
		
	} 
?>
</section>

<?php include(FRONTOFFICE.DS.'post'.DS.'menu_blog.php');?>
