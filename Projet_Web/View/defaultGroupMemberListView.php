<?php $title = "Acceuil";
	  $content ="Mes Groupes";?>
<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Public/Css/defaultGroupMemberList_page.css">

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
			<div id="left_gridbox">
				<h1>Groupes</h1>
				<ul class="list_normal">
					<?php
						while ($row = mysqli_fetch_assoc($listGroup)) {
							if ($_SESSION['member']->isAdministrator($db,$row['id_Groupe'])) {
								echo '<li><a href="index.php?action=viewGroup&id='.$row['id_Groupe'].'"><span>'.$row['nomGroupe'].'</span></a><a href="index.php?action=deleteGroup&idGroupe='.$row['id_Groupe'].'"><img src="Public/Icon/cross.png" width="15px" height="15px" style="margin-left: 5px;"></a><a href="#"><img src="Public/Icon/edit.png" width="15px" height="15px" style="margin-left: 5px;"></a><a href="index.php?action=viewAddMember&idGroup='.$row['id_Groupe'].'"><img src="Public/Icon/add-friend.png" width="15px" height="15px" style="margin-left: 5px;"></a></li>';
							}else{
								echo '<li><a href="index.php?action=viewGroup&id='.$row['id_Groupe'].'"><span>'.$row['nomGroupe'].'</span></a></li>';
							}
						 } 
					?>
				</ul>
			</div>
			<div id="midle_box">
				<h1>Informations</h1>
				<ul class="list_normal">
						<ul class="list_normal">
							<?php
								while ($row = mysqli_fetch_assoc($listMemberList)) {
									if ($row['id_membreAcheteur']!=0) {
										echo '<li><span id="reserver">'.$row['nomCadeau'].'</span></li>';
									} else {
										echo '<li><a href="index.php?action=viewGroup&idGift='.$row['id_Cadeau'].'"><span>'.$row['nomCadeau'].'</span></a></li>';
									}
								 } 
							?>
						</ul>
				</ul>
			</div>
			<div id="right_box">
				<h1>Membre</h1>
				<ul class="list_normal">
					<?php
						while ($row = mysqli_fetch_assoc($listMember)) {
							if ($row['id_Membre'] != $_SESSION['member']->getId()) {
								echo '<li><a href="index.php?action=viewGroup&memberId='.$row['id_Membre'].'&idGroupe='.$row['id_Groupe'].'"><span>'.$row['nomMembre'].'</span></a></li>';
							}else{
								echo '<li><span>'.$row['nomMembre'].'</span></a></li>';
							}
						 }  
					?>
				</ul>
			</div>
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