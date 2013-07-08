<article class="entry clearfix">

	<div class="entry-body">

		<?php echo $post['image'];?>
		
		<?php echo $post['short_content'];?>
		
	</div><!-- end .entry-body -->

	<div class="entry-meta">

		<ul>
			<li><a href="<?php echo Router::url('posts/view/id:'.$post['id'].'/slug:'.$post['slug'].'/prefix:article');?>"><span class="post-format link">Permalink</span></a></li>
			<li><span class="title">Posted:</span> <a href="#"><?php echo substr($post['created'],0,10);?></a></li>
			<li><span class="title">Tags:</span> <a href="#"><?php echo $post['tag'];?></a></li>
			<li><span class="title">Comments:</span> <a href="#">3</a></li>
		</ul>
		
	</div><!-- end .entry-meta -->
	
</article><!-- end .entry -->