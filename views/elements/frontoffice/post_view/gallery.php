<article class="entry clearfix">

		<div class="image-gallery-slider">
		<?php 
			$var_p = explode('/>',$post['image']);
			$var_p = array_slice($var_p, 0, -1);
		?>
		<ul>
			<?php foreach($var_p as $k => $var){ ?>
			
				<li>
					<?php $link = explode('<img alt="" src="', $var); $link = implode('',$link); $link = substr($link, 0, strpos($link, '" '));?>
					<a href="<?php echo $link;?>" class="single-image" title="" rel="blog-post-gallery">
						<?php echo $var;?>
					</a>
				</li>
			
			<?php } ?>
		</ul>
		
	</div><!-- end .image-gallery-slider -->

	<div class="entry-body">
		<a href="<?php echo Router::url('posts/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');?>">
			<h1 class="title"><?php echo $post['name'];?></h1>
		</a>

		<p><?php echo $post['content'];?></p>
		
	</div><!-- end .entry-body -->

	<div class="entry-meta">

		<ul>
			<li><a href="<?php echo Router::url('posts/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');?>"><span class="post-format gallery">Permalink</span></a></li>
			<li><span class="title">Posted:</span> <a href="#"><?php echo $post['created'];?></a></li>
			<li><span class="title">Tags:</span> <a href="#"><?php echo $post['tag'];?></a></li>
			<li><span class="title">Comments:</span> <a href="#">3</a></li>
		</ul>

	</div><!-- end .entry-meta -->
	
</article><!-- end .entry -->