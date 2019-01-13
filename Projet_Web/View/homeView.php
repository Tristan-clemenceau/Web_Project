<?php $title = "Acceuil";?>

<?php ob_start(); ?>
<link rel="stylesheet" type="text/css" href="Public/Css/home_page.css">

<div id="header">
		<img id="test" onclick="menu()" src="Public/Icon/menu.png">
		<H1>Gestion de cadeau de noël</H1>
</div>
	<div id ="mid_box">
		<img id="cross" onclick="cross()" src="Public/Icon/cross.png">
		<ul>
			<li><a onclick="">FR | EN</a></li>
			<li><a onclick="display('login')">Login</a></li>
			<li><a onclick="display('register')">Register</a></li>
		</ul>
	</div>
	<div id="formulaire">
		<img id="left_arrow" onclick="left_Arrow()" src="Public/Icon/left_arrow.png">
		<div id="login">
			<h1>Login</h1>
			<form action="index.php?action=login" class="login_register" method="POST">
				<label><span>Instruction :</span><br/><br/>If you already have an account please complete the fields below. </label><br/>
				<input class="field" type="text" name="login" placeholder="Login" required><br />
				<input class="field" type="password" name="password" placeholder="Password" required><br />
				<input class="button" type="submit" name="btn_Connection" value="sign in">
			</form>
		</div>
		<div id="register" >
			<h1>Register</h1>
			<form action="index.php?action=register" class="login_register" method="POST">
				<label><span>Instruction :</span><br/><br/>Please complete the fields below to finish your inscription. </label><br/>
				<input class="field" type="email" name="mail" placeholder="Email"><br />
				<input class="field" type="text" name="login" placeholder="Login"><br />
				<input class="field" type="password" name="password" placeholder="Password"><br />
				<input class="button" type="submit" name="btn_Connection" value="sign in">
			</form>
		</div>
	</div>

<script type="text/javascript" src="Public/Js/slider_show.js"></script>
<script type="text/javascript" src="Public/Js/event.js"></script>
<?php $content = ob_get_clean(); ?>

<?php require('template.php');?>
