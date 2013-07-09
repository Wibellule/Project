<?php
$title_for_layout = 'Liste des articles';
$description_for_layout = 'Liste des articles';
?>
<?php 
	$this->element(FRONTOFFICE.DS.'msg_flash'.DS.'message_flash.php');
?>
<header class="page-header">
		<h1 class="page-title">Bienvenue sur notre blog</h1>
</header><!-- end .page-header -->

<section id="main">
	<?php foreach($posts as $k=>$v){ ?>

		<?php switch($v['tag']){ 
		
		case $v['tag']:
			include(FRONTOFFICE.DS.'post'.DS.lcfirst($v['tag']).'.php');
		break;
		
		} ?>
		
	<?php } ?>
	<?php 
		// pr($typeposts);
		// pr($this->request);
		// if(isset($this->request->params[0]) && !empty($this->request->params[0])){
			// $redir = $this->request->params[0];
		// }else{
			// $redir = 'blog';
		// }
		if($this->request->url == '/blog.html'){
			$url = 'blog';
		}else{
			if(!empty($posts) && isset($posts)){
				$url = lcfirst($posts[0]['tag']);
			}else{
				$this->redirect('blog');
			}
		}
	?>
	<ul class="pagination">
	
		<li class="next"><a href="<?php echo Router::url($url).'?page=1';?>">&larr; Début</a></li>
		
		<?php for($i=1; $i<=$nbPages; $i++){ ?>
		
			<li><a href="<?php echo Router::url($url).'?page='.$i; ?>" class="<?php echo ($i == $this->request->page)?'current':'';?>"><?php echo $i; ?></a></li>
			
		<?php } ?>
		
		<li class="prev"><a href="<?php echo Router::url($url).'?page='.$nbPages; ?>">Fin &rarr;</a></li>
		
	</ul>
	
	
</section>

<?php $this->element(FRONTOFFICE.DS.'post'.DS.'menu_blog.php');?>