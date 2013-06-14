<li>

	<div class="entry-meta">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<span class="post-format link">Permalink</span>
		</a>

		<span class="date"><?php echo $v['created'];?></span>

	</div><!-- end .entry-meta -->

	<div class="entry-body">

		<a href="<?php echo Router::url('posts/view/id:'.$v['id'].'/slug:'.$v['slug'].'/prefix:article');?>">
			<h5 class="title"><?php echo $v['name'];?></h5>
		</a>

		<?php echo substr($v['short_content'],0,125).'...';?>
			
	</div><!-- end .entry-body -->

</li>