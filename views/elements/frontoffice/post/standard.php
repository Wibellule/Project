<article class="entry clearfix">

	<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>" title="">
		<?php echo $v['image'];?>
	</a>

	<div class="entry-body">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<h1 class="title"><?php echo $v['name'];?></h1>
		</a>

		<p><?php echo $v['short_content'];?></p>
		
	</div><!-- end .entry-body -->

	<div class="entry-meta">

		<ul>
			<li><a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>"><span class="post-format ">Permalink</span></a></li>
			<li><span class="title">Posted:</span> <a href="#"><?php echo $v['created'];?></a></li>
			<li><span class="title">Tags:</span> <a href="#"><?php echo $v['tag'];?></a></li>
			<li><span class="title">Comments:</span> <a href="#">3</a></li>
		</ul>

	</div><!-- end .entry-meta -->
	
</article><!-- end .entry -->