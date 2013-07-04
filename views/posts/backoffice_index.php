<div class="container">
<div class="page-header">
	<?php 
		$messageFlash = Session::read('Flash');
		if($messageFlash){
			echo "<div class='alert alert-".Session::read('Flash.type')."'>";
			echo Session::read('Flash.message').'</div>';
		}
		Session::delete('Flash');
		// pr($_SESSION);
	?>
	<?php
		$controllerData = $this->request->controller;
		// pr($$controllerData);
	?>
	<h1>Liste des articles</h1>
	<h3><?php echo "Total d'articles: ".$nbElem;?></h3>
</div>
<table class='table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Titre</th>
				<th>Statut</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($$controllerData as $k=>$v):?>
				<tr>
					<td><?php echo $v['id'];?></td>
					<td><?php echo $v['name'];?></td>
					<td><span class="label <?php echo ($v['online']==1)?'label-success':'label-important';?>"><?php echo ($v['online']==1)?'En ligne':'Hors ligne';?></span></td>
					<td>
						<?php echo '<a href='.Router::url('/adm/'.$controllerData.'/edit/'.$v['id']).'>Editer&nbsp;<span class="fui-new-24"></span></a>';?>
						<?php echo '<a href='.Router::url('/adm/'.$controllerData.'/delete/'.$v['id']).'>Supprimer&nbsp;<span class="fui-cross-24"></span></a></td>';?>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
</table>
<a href="<?php echo router::url('adm/'.$controllerData.'/add');?>" class="btn btn-primary">Ajouter une article</a>
<div class="pagination">
	<ul>
		<li class="previous"><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page=1';?>"><img src="<?php echo Router::webroot('css/backoffice/images/pager/previous.png');?>" /></a></li>
		<?php for($i=1; $i<=$nbPages; $i++){ ?>
		<li class="<?php echo ($i == $this->request->page)?'active':'';?>"><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$i; ?>"><?php echo $i; ?></a></li>
		<?php } ?>
		<li class="next"><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$nbPages; ?>"><img src="<?php echo Router::webroot('css/backoffice/images/pager/next.png');?>" /></a></li>
	</ul>
</div>
</div>

