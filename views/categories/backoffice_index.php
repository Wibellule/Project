<div class="page-header">
	<?php $this->element(BACKOFFICE.DS.'formulaire'.DS.'message_flash.php');?>	
	<?php $controllerData = $this->request->controller; //pr($controllerData);?>
	<h1>Liste des pages</h1>
	<h3><?php echo "Total de pages: ".$nbElem;?></h3>
</div>
<table class="table">
<thead>
	<tr>
		<th>ID</th>
		<th>Titre</th>
		<th>Statut</th>
		<th>Actions</th>
	</tr>
</thead>
<?php //pr($categories);?>
<?php //pr($titre);?>
<?php
	for($i=0;$i<=$nbElem-1;$i++){
		$categories[$i]['name'] = $titre[$categories[$i]['id']];	
	}
?>
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
		<?php endforeach;?>
		</tr>
	
</tbody>
</table>
<a class="btn btn-primary" href="<?php echo Router::url('adm/categories/add');?>" title="Ajouter une page" alt="Liste des pages">Ajouter une page</a>		
<div class="pagination">
	<ul>
		<li><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page=1';?>">First</a></li>
		<?php for($i=1; $i<=$nbPages; $i++){ ?>
			<li class="page"><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$i; ?>"><?php echo $i; ?></a></li>
		<?php } ?>
		<li><a href="<?php echo Router::url('adm/'.$controllerData.'/index').'?page='.$nbPages; ?>">Last</a></li>
	</ul>
</div>


