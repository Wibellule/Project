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
	<h1>Liste des types d'articles</h1>
	<h3><?php echo "Total de types: ".$nbElem;?></h3>
<table>
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
						<?php echo '<a href='.Router::url('/adm/'.$controllerData.'/edit/'.$v['id']).'><img src='.Router::webroot('img/icons/icon_edit.png').' alt="Edit" /></a>';?>
						<?php echo '<a href='.Router::url('/adm/'.$controllerData.'/delete/'.$v['id']).'><img src='.Router::webroot('img/icons/icon_delete.png').' alt="Delete" /></a></td>';?>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
</table>
<a href="<?php echo router::url('adm/'.$controllerData.'/add');?>" class="btn btn-primary">Ajouter un type d'article</a>
	<ul>
		<li><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page=1';?>">Prev</a></li>
		<?php for($i=1; $i<=$nbPages; $i++){ ?>
			<li class="page"><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$i; ?>"><?php echo $i; ?></a></li>
		<?php } ?>
		<li><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$nbPages; ?>">Next</a></li>
	</ul>

