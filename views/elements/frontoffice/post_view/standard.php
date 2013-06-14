<article class="entry single clearfix">

	<a href="single-post.html" title="">
		<?php echo $post['image'];?>
	</a>
	
	<div class="entry-body">
		<a href="#">
			<h1 class="title"><?php echo $post['name']; ?></h1>
		</a>
		<?php echo $post['content'];?>	
	</div><!-- end .entry-body -->
	
	<div class="entry-meta">
	
		<ul>
			<li><a href="#"><span class="post-format">Permalink</span></a></li>
			<li><span class="title">Posted:</span> <a href="#"><?php echo $post['created'];?></a></li>
			<li><span class="title">Tags:</span> <a href="#"><?php echo $post['tag'];?></a></li>
			<li><span class="title">Comments:</span> <a href="#">3</a></li>
		</ul>
		
	</div><!-- end .entry-meta -->
	
</article><!-- end .entry -->