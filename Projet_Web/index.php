<?php 
require('Controller/frontend.php');
try{
	if (!isset($_GET['action'])) {
		homePage();
	}else{
		switch (security($_GET['action'])) {
		case "login":
			authentification(security($_POST['login']),security($_POST['password']));
			break;
		case "register":
			register(security($_POST['login']),security($_POST['password']),security($_POST['mail']));
			break;
		case "viewModifMember":
			ModifMemberPage();
			break;
		case "modifMember":
			modifMember(security($_POST['nom']),security($_POST['prenom']));
			break;
		case "deleteMember":
			cleanMember();
			break;
		case "viewMember":
			memberPage();
			break;
		case "viewList":
			if (isset($_GET['id'])) {
				dispListGift(security($_GET['id']));
			}else{
				ListMemberPage();
			}
			break;
		case "viewAddGiftLIst":
			if (isset($_GET['id'])) {
				AddGiftListPage(security($_GET['id']));
			}else{
				ListMemberPage();
			}
			break;
		case "addGiftList":
			addGiftList(security($_POST['nomCadeau']),security($_POST['lienCadeau']),security($_POST['desc']),security($_POST['idList']));
			break;
		case "viewAddList":
			addListPage();
			break;
		case "addList":
			addList(security($_POST['nomList']));
			break;
		case "deleteList":
			if (isset($_GET['id'])) {
				deleteList(security($_GET['id']));
			}else{
				ListMemberPage();
			}
			break;
		case "deleteListGift":
			if (isset($_GET['idList'])&&isset($_GET['idGift'])) {
				deleteListGift(security($_GET['idList']),security($_GET['idGift']));
			}else{
				ListMemberPage();
			}
			break;
		case "viewGroup":
			if (isset($_GET['id'])) {
				dispGroupMember(security($_GET['id']));
			}elseif (isset($_GET['memberId'])&& isset($_GET['idGroupe'])) {
				dispGroupMemberList(security($_GET['memberId']),security($_GET['idGroupe']));
			}elseif(isset($_GET['idGift'])){
				disGroupMemberGiftInfo(security($_GET['idGift']));
			}else{
				groupPage();
			}
			break;
		case "createGroup":
			createGroupPage();
			break;
		case "setGroup":
			setGroup(security($_POST['nomGroupe']));
			break;
		case "viewShareList":
			if (isset($_GET['idGroupe'])&&isset($_GET['idListe'])) {
				addListToGroup(security($_GET['idGroupe']),security($_GET['idListe']));
			}elseif (isset($_GET['id'])) {
				shareListPage(security($_GET['id']));
			}else{
				ListMemberPage();
			}
			break;
		case "book":
			if (isset($_GET['id'])) {
				book(security($_GET['id']));
			}else{
				groupPage();
			}
			break;
		case "deleteGroup":
			if (isset($_GET['idGroupe'])) {
				deleteGroup(security($_GET['idGroupe']));
			}else{
				groupPage();
			}
			break;
		case "viewAddMember":
			if (isset($_GET['idGroup'])) {
				listMemberAddPage(security($_GET['idGroup']));
			} else {
				groupPage();	
			}
			break;
		case "AddMemberGroup":
			if (isset($_GET['idGroupe'])&& isset($_GET['idMember'])) {
				AddMemberGroup(security($_GET['idGroupe']),security($_GET['idMember']));
			} else {
				groupPage();
			}
			
			break;
		default:
			homePage();
			break;
		}
	}
}
catch(Exception $e){
	echo 'Erreur : '.$e->getMessage();
}
?>