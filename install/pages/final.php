<?php FileAndDir::fcopy(INSTALL_FILES.DS.'installed', CONFIGS_FILES.DS.'installed'); ?>
<h2>Finalisation de l'installation</h2>
<div class="alert alert-success">Félicitation l'installation s'est déroulée avec succès</div>
<div class="alert alert-info">
	<p>Pour accèder au backoffice :</p></br>
	Pour vous connecter au backoffice utilisez l'adresse www.votrenomdedomaine.com/adm <br />
	Le login par défaut est <b>superadmin</b><br />
	Le mot de passe par défaut est <b>superadmin</b><br />
	<i>Pensez à le changer par un mot de passe que vous seul pourrez retrouver</i></br>
	<a href="<?php echo Router::url('/'); ?>" target="_blank"><button class="btn btn-success" type="submit"><span>Accéder à la page d'accueil de votre site</span></button></a></br>
	<a href="<?php echo Router::url('/adm'); ?>" target="_blank"><button class="btn btn-warning" type="submit"><span>Accéder à l'espace d'administration de votre site</span></button></a>									
</div>