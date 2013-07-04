<?php
/** Commentaires **/
$comments = ClassRegistry::init('Postscomment');
$conditions_comments = array('online' => 0);
$nb_comments = $comments->findCount($conditions_comments);
/** Messages **/
$messages = ClassRegistry::init('Mail');
$conditions_messages = array('online' => 0);
$nb_messages = $messages->findCount($conditions_messages);
?>
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if(isset($title_for_layout) && !empty($title_for_layout)) { ?>
			<title><?php echo $title_for_layout;?></title>
		<?php } ?>
		<?php if(isset($description_for_layout) && !empty($description_for_layout)) { ?>
			<meta name="description" content="<?php echo $description_for_layout; ?>">
		<?php } ?>
		<link href="<?php echo Router::webroot('css/backoffice/css/_bootstrap.css');?>" rel="stylesheet" type="text/css" />
		<!--<link href="<?php //echo Router::webroot('css/backoffice/css/bootstrap-docs.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?php //echo Router::webroot('css/backoffice/css/bootstrap-responsive.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?php //echo Router::webroot('css/backoffice/css/prettify.css');?>" rel="stylesheet" type="text/css" />-->
		<link href="<?php echo Router::webroot('css/backoffice/css/_flat-ui.css');?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
	
	<div class="container">
	
		<div class="demo-headline">
			<h4 class="demo-logo">Flat UI<small>Free Web User Interface Kit</small></h4>
		</div> <!-- /demo-headline -->
		
		<div class="row demo-row">
      
          <div class="navbar navbar-inverse">
            <div class="navbar-inner">
              <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <div class="nav-collapse collapse">
                  <ul class="nav">
                    <li class="active">
                      <a href="<?php echo Router::url('adm');?>">Accueil</a>
                    </li>
					<li>
                      <a href="#">Catégories
                        <span class="navbar-unread">1</span>
                      </a>
                    </li>
                    <li>
                      <a href="<?php echo Router::url('adm/posts/index');?>">
                        Articles
                        <span class="navbar-unread">1</span>
                      </a>
                      <ul>
                        <li><a href="<?php echo Router::url('adm/postscomments/index');?>">Commentaires</a></li>
                        <li><a href="#">Element One</a></li>
                        <li><a href="#">Element One</a></li>
                        <li>
                          <a href="#">Sub menu</a>
                          <ul>
                            <li><a href="#">Element One</a></li>
                            <li><a href="#">Element Two</a></li>
                            <li><a href="#">Element Three</a></li>
                          </ul> <!-- /Sub menu -->
                        </li>
                        <li><a href="#">Element Three</a></li>
                      </ul> <!-- /Sub menu -->
                    </li>
					<li class="active">
                      <a href="#">
                        Messages
                        <span class="navbar-unread">1</span>
                      </a>
                      <ul>
                        <li><a href="#">Element One</a></li>
                        <li>
                          <a href="#">Sub menu</a>
                          <ul>
                            <li><a href="#">Element One</a></li>
                            <li><a href="#">Element Two</a></li>
                            <li><a href="#">Element Three</a></li>
                          </ul> <!-- /Sub menu -->
                        </li>
                        <li><a href="#">Element Three</a></li>
                      </ul> <!-- /Sub menu -->
                    </li>
					<li>
                      <a href="#">Projets
                        <span class="navbar-unread">1</span>
                      </a>
                    </li>
					<li>
                      <a href="#">Sliders
                        <span class="navbar-unread">1</span>
                      </a>
                    </li>
					<li>
                      <a href="#">Déconnexion
                        <span class="navbar-unread">1</span>
                      </a>
                    </li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div>
			</div>
		</div>
	</div>
	
	
	
		<ul>
		  <li><a href="<?php echo Router::url('adm');?>" title=""><i class="icon-home"></i>&nbsp;Accueil</a></li>
		  <li><a href="<?php echo Router::url('adm/posts/index');?>" title=""><i class="icon-tag"></i>&nbsp;Articles</a></li>
		  <li><a href="<?php echo Router::url('adm/postscomments/index');?>" title=""><i class="icon-file"></i>&nbsp;Commentaires <?php if($nb_comments > 0){ echo '('.$nb_comments.')'; }?></a></li>
		  <li><a href="<?php echo Router::url('adm/categories/index');?>" title=""><i class="icon-file"></i>&nbsp;Catégories</a></li>
		  <li><a href="<?php echo Router::url('adm/sliders/index');?>" title=""><i class="icon-file"></i>&nbsp;Sliders</a></li>
		  <li><a href="<?php echo Router::url('adm/mails/index');?>" title=""><i class="icon-file"></i>&nbsp;Messages <?php if($nb_messages > 0){ echo '('.$nb_messages.')'; }?></a></li>
		  <li><a href="<?php echo Router::url('adm/projects/index');?>" title=""><i class="icon-file"></i>&nbsp;Projets</a></li>
		  <li><a href="<?php echo Router::url('adm/typeposts/index');?>" title=""><i class="icon-file"></i>&nbsp;Type d'articles</a></li>
		  <li><a href="<?php echo Router::url('adm/typeprojects/index');?>" title=""><i class="icon-file"></i>&nbsp;Type de projets</a></li>
		  <li><a href="<?php echo Router::url('users/logout');?>" title=""><i class="icon-ban-circle"></i>&nbsp;Déconnexion</a></li>
		</ul>
		<?php echo $content_for_layout;?>
		
		</div>
		
		<script src="<?php echo Router::webroot('css/backoffice/js/jquery-1.8.2.min.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/jquery-ui-1.10.0.custom.min.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/jquery.dropkick-1.0.0.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/custom_checkbox_and_radio.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/custom_radio.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/jquery.tagsinput.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/bootstrap-tooltip.js');?>"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/jquery.placeholder.js');?>"></script>
		<script src="http://vjs.zencdn.net/c/video.js"></script>
		<script src="<?php echo Router::webroot('css/backoffice/js/application.js');?>"></script>
	</body>	
</html>