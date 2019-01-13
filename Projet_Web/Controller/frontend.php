<?php
//Class

require_once('Model/member.php');
require_once('Model/connection.php');

//Function

function homePage(){
	require('View/homeView.php');
}
function memberPage(){
	require('View/defaultMemberView.php');
}
function ModifMemberPage(){
	require('View/modifMemberUtilView.php');
}
function ListMemberPage(){
	$db = new DataBase();
	$listMenu = $_SESSION['member']->listMenu($db);
	require('View/defaultListView.php');
}
function groupPage(){
	$db = new DataBase();
	$listGroup = $_SESSION['member']->listGroup($db);
	require('View/defaultGroupView.php');
}
function AddGiftListPage($id){
	$idList = $id;
	require('View/addGiftListView.php');
}
function addListPage(){
	require('View/addListView.php');
}
function createGroupPage(){
	require('View/createGroupView.php');
}
function shareListPage($idList){
	$db = new DataBase();
	$listMenu = $_SESSION['member']->listMenu($db);
	$listPossibleGroup = $_SESSION['member']->listPossibleGroup($db);
	$listAddId = $idList;
	require('View/listDispPossibleListView.php');
}
function listMemberAddPage($idGroup){
	$db = new DataBase();
	$listPossibleMember = $_SESSION['member']->listPossibleMember($db,$idGroup);
	$idGroupe = $idGroup;
	require('View/addMemberListView.php');
}
function disGroupMemberGiftInfo($idGift){
	$db = new DataBase();
	$GiftInfo = $_SESSION['member']->giftInfo($db,$idGift);
	require('View/defaultGiftInfo.php');
}
function setGroup($nomGroupe){
	$db = new DataBase();

	$user = $_SESSION['member'];
	$user->setGroupe($db,$nomGroupe);
	groupPage();
}
function addList($nomList){
	$db = new DataBase();

	$user = $_SESSION['member'];
	$user->addList($db,$nomList);
	ListMemberPage();
}
function addGiftList($nomCadeau,$lienCadeau,$desc,$idList){
	$db = new DataBase();

	$user = $_SESSION['member'];
	$user->addGiftList($db,$nomCadeau,$lienCadeau,$desc,$idList);
	ListMemberPage();
}
function addListToGroup($idGroupe,$idListe){
	$db = new DataBase();
	$_SESSION['member']->addListToGroup($db,$idGroupe,$idListe);
	groupPage();
}
function AddMemberGroup($idGroup,$idMember){
	$db = new DataBase();
	$_SESSION['member']->AddMemberGroup($db,$idGroup,$idMember);
	groupPage();
}
function security($var){
	return strip_tags($var);
}
function deconnection(){
	$user = $_SESSION['member'];

	$user->deconnection();
	homePage();
}
function authentification($login,$password){
	$db = new DataBase();

	$member = new Member($login,$password);
	$member->verifData($db);
	if ($member->getId() != 0) {
		$member-> updateData($db);
		$_SESSION['member']=$member;
		memberPage();
	}else{
		homePage();
	}
}

function register($login,$password,$email){
	$db = new DataBase();

	$member = new Member($login,$password,$email);

	if($member->register($db)){
		$member->verifData($db);
		if ($member->getId()!= 0) {
			$member-> updateData($db);
			$_SESSION['member']=$member;
			memberPage();
		}else{
			homePage();
		}
	}else{
		homePage();
	}
}
function modifMember($nom,$prenom){
	$db = new DataBase();
	$member=$_SESSION['member'];
	$member->modifMember($nom,$prenom,$db);
	$member->updateData($db);
	memberPage();
}
function cleanMember(){
	$db = new DataBase();
	$member=$_SESSION['member'];
	$member->cleanMember($db);
}
function deleteList($id){
	$db = new DataBase();
	$member=$_SESSION['member'];
	$member->deleteList($db,$id);
	ListMemberPage();
}
function deleteListGift($id_Liste,$id_Cadeau){
	$db = new DataBase();
	$member=$_SESSION['member'];
	$member->deleteGift($db,$id_Liste,$id_Cadeau);
	ListMemberPage();
}
function dispListGift($id){
	$db = new DataBase();
	$listMenu = $_SESSION['member']->listMenu($db);
	$listGift = $_SESSION['member']->listGift($db,$id);
	$infoList= $_SESSION['member']->listInfo($db,$id);
	require('View/defaultListGiftView.php');
}
function dispGroupMember($id){
	$db = new DataBase();
	$listGroup = $_SESSION['member']->listGroup($db);
	$listMember = $_SESSION['member']->listMember($db,$id);
	require('View/defaultGroupMemberView.php');
}
function dispGroupMemberList($idMember,$idGroupe){
	$db = new DataBase();
	$listGroup = $_SESSION['member']->listGroup($db);
	$listMember = $_SESSION['member']->listMember($db,$idGroupe);
	$listMemberList= $_SESSION['member']->listMemberList($db,$idMember,$idGroupe);
	require('View/defaultGroupMemberListView.php');
}
function book($idGift){
	$db = new DataBase();
	$_SESSION['member']->book($db,$idGift);
	groupPage();
}
function deleteGroup($idGroup){
	$db = new DataBase();
	$_SESSION['member']->deleteGroup($db,$idGroup);
	groupPage();
}
?>