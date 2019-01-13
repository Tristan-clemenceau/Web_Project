<?php $title = "Acceuil";
	  $content ="Mon Compte";?>
<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Public/Css/modifMemberUtil_page.css">

<div id="header">
		<img id="test" onclick="menu()" src="Public/Icon/menu.png">
		<H1>Gestion de cadeau de noël</H1>
	</div>
	<div id="left_box">
		<p>Bonjour, <span><?php echo $_SESSION['member']->getLogin();?></span></p>
		 <ul id ="list">
  			<li><a href="#">Mon Compte</a>
  				<ul class="subMenu">
  					<li><a href="index.php?action=viewMember"><span>Consulter</span></a></li>
  					<li><a href="index.php?action=viewModifMember"><span>Modifier</span></a></li>
  					<li><a href="index.php?action=deleteMember"><span>Supprimer</span></a></li>
  				</ul>
  			</li>
  			<li><a href="#">Mes Listes</a>
  				<ul class="subMenu">
  					<li><a href="index.php?action=viewList"><span>Consulter</span></a></li>
  					<li><a href="index.php?action=viewAddList"><span>Ajouter</span></a></li>
  					<li><a href="#"><span>Modifier</span></a></li>
  				</ul>
  			</li>
  			<li><a href="#">Mes Groupes</a>
  				<ul class="subMenu">
  					<li><a href="index.php?action=viewGroup"><span>Consulter</span></a></li>
  					<li><a href="index.php?action=createGroup"><span>Créer</span></a></li>
  					<li><a href="#"><span>Modifier</span></a></li>
  				</ul>
  			</li>
  			<li><a href="index.php?action=deconnection">Log Out</a></li>
		</ul> 
	</div>
	<div id="content">
		<h1><span><?php echo $content; ?></span></h1>
		<div id="dynamic_content">
			<form id="formulaire" action="index.php?action=modifMember" method="POST">
				<ul class="list_normal">
					<li><span>Login : </span><?php echo $_SESSION['member']->getLogin();?></li>
					<li><span>Password : </span><?php echo $_SESSION['member']->getPassword();?></li>
					<li><span>Email : </span><?php echo $_SESSION['member']->getEmail();?></li>
					<li><span>nom : </span><input type="text" name="nom" placeholder="nom" required></li>
					<li><span>prenom : </span><input type="text" name="prenom" placeholder="prenom" required></li><br/>
					<input type="submit" value="send">
			</ul>
			</form>
		</div>
	</div>
	<div id="mid_box">
		<img id="cross" onclick="cross()" src="Public/Icon/cross.png">
		<ul>
			<li><a href="#">FR | EN</a></li>
			<li><a href="index.php?action=viewMember">Mon Compte</a></li>
			<li><a href="index.php?action=viewList">Mes Listes</a></li>
			<li><a href="index.php?action=viewGroup">Mes Groupes</a></li>
			<li><a href="index.php?action=deconnection">Log Out</a></li>
		</ul>
	</div>

<script type="text/javascript" src="Public/Js/event.js"></script>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');?>