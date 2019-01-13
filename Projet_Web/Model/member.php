<?php  
session_start();
class Member{
	private $email;
	private $login;
	private $password;
	private $id;
	private $nom;
	private $prenom;

	function __construct(){
		$numArgs = func_num_args();
		$args = func_get_args();
		if ($numArgs == 2) {
			$this->login = $args['0'];
			$this->password = $args['1'];
		}else if ($numArgs == 3) {
			$this->login = $args['0'];
			$this->password = $args['1'];
			$this->email = $args['2'];
		}else{
		echo "Erreur constructeur";
		}
	}

	//Function GetAtt
	function getEmail(){
		return $this->email;
	}
	function getLogin(){
		return $this->login;
	}
	function getPassword(){
		return $this->password;
	}
	function getId(){
		return $this->id;
	}
	function getNom(){
		return $this->nom;
	}
	function getPrenom(){
		return $this->prenom;
	}


	function verifData($db){
		$db->connection();
		$sql ="SELECT id_Membre FROM membre WHERE loginMembre ='$this->login' AND mdpMembre = '$this->password'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);
		if($row[0]!= 0){
			$this->id=$row[0];
			$_SESSION["session"]=$this->id;
		}else{
			$_SESSION["session"]=0;
		}
		$db->deconnection();
	}

	function register($db){

		$db->connection();
		$sql ="SELECT id_Membre FROM membre WHERE loginMembre ='$this->login' AND mdpMembre = '$this->password'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		if($row[0]!= 0){
			return false;
		}else{
			$sql ="INSERT INTO membre(loginMembre,mdpMembre,mailMembre,etatMembre) VALUES('$this->login','$this->password','$this->email','Actif')";
			$sqlExecute = mysqli_query($db->getCo(),$sql);

			$sql ="INSERT INTO actif(id_Membre) VALUES($this->id)";
			$sqlExecute = mysqli_query($db->getCo(),$sql);

			return true;
		}

		$db->deconnection();
	}

	function updateData($db){
		$db->connection();
		$sql ="SELECT id_Membre,nomMembre,prenomMembre,mailMembre,loginMembre,mdpMembre FROM membre WHERE loginMembre ='$this->login' AND mdpMembre = '$this->password'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$row = mysqli_fetch_row($sqlExecute);

		$this->id= $row[0];
		$this->nom= $row[1];
		$this->prenom= $row[2];
		$this->email= $row[3];
		$this->login= $row[4];
		$this->password= $row[5];

		$db->deconnection();
	}

	function modifMember($nom,$prenom,$db){
		$db->connection();
		$this->nom = $nom;
		$this->prenom = $prenom;
		$sql ="UPDATE membre set nomMembre = '$this->nom', prenomMembre = '$this->prenom' WHERE id_Membre = $this->id ";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$db->deconnection();
	}

	function cleanMember($db){
		$db->connection();
		$sql =" DELETE FROM membre WHERE id_Membre = $this->id ";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql =" DELETE FROM actif WHERE id_Membre = $this->id ";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$db->deconnection();
		deconnection();
	}

	function listMenu($db){
		$db->connection();
		$sql="SELECT id_Liste,nomListe FROM liste WHERE id_Membre = $this->id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function listGift($db,$id){
		$db->connection();
		$sql="SELECT DISTINCT(ca.nomCadeau),ca.id_Cadeau,co.id_Liste FROM contient co,cadeaux ca WHERE co.id_Cadeau = ca.id_Cadeau AND co.id_Liste= $id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}
	function listInfo($db,$id){
		$db->connection();
		$sql="SELECT DISTINCT(gr.nomGroupe) FROM affilier af,groupe gr WHERE af.id_Groupe= gr.id_groupe AND af.id_Liste = $id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function listGroup($db){
		$db->connection();
		$sql="SELECT DISTINCT(gr.nomGroupe),gr.id_Groupe FROM appartenir ap, groupe gr WHERE ap.id_Groupe = gr.id_Groupe AND ap.id_Membre = $this->id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function listMember($db,$id){
		$db->connection();
		$sql="SELECT DISTINCT(me.nomMembre),me.id_Membre,ap.id_Groupe FROM appartenir ap, membre me WHERE ap.id_Membre= me.id_Membre AND ap.id_Groupe =$id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function listMemberList($db,$idMember,$idGroupe){
		$db->connection();
		$sql="SELECT ca.nomCadeau , co.id_membreAcheteur,ca.id_Cadeau FROM liste li,affilier af,contient co, cadeaux ca where li.id_Liste =af.id_Liste and co.id_Liste = li.id_Liste AND co.id_cadeau =ca.id_cadeau and af.id_Groupe =$idGroupe AND li.id_Membre =$idMember";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function addGiftList($db,$nomCadeau,$lienCadeau,$desc,$idList){
		$db->connection();
		$sql="INSERT INTO cadeaux(nomCadeau,lienCadeau,descCadeau) VALUES('$nomCadeau','$lienCadeau','$desc')";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="SELECT id_cadeau FROM cadeaux WHERE nomCadeau = '$nomCadeau' AND lienCadeau = '$lienCadeau'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$row = mysqli_fetch_assoc($sqlExecute);
		$id_Cadeau = $row['id_cadeau'];

		$sql="INSERT INTO contient(id_Cadeau,id_Liste) value($id_Cadeau,$idList)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$db->deconnection();
	}

	function addList($db,$nomList){
		$db->connection();
		$sql="INSERT INTO liste(nomListe,id_Membre) VALUES('$nomList',$this->id)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="SELECT id_Liste FROM liste WHERE nomListe = '$nomList'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$row= mysqli_fetch_assoc($sqlExecute);
		$list=$row['id_Liste'];

		$sql="INSERT INTO affilier (id_Liste, id_Groupe) VALUES ($idListe, 0) ";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$db->deconnection();
	}

	function deleteList($db,$id){
		$db->connection();
		$sql="DELETE FROM liste WHERE id_Liste = $id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="DELETE FROM affilier WHERE id_Liste = $id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="DELETE FROM contient WHERE id_Liste = $id";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$db->deconnection();
	}
	function deleteGift($db,$id_Liste,$id_Cadeau){
		$db->connection();
		$sql=" DELETE FROM contient WHERE id_Cadeau = $id_Cadeau AND id_Liste = $id_Liste";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql=" DELETE FROM cadeaux WHERE id_Cadeau = $id_Cadeau";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$db->deconnection();
	}

	function setGroupe($db,$nomGroupe){
		$db->connection();
		$sql="INSERT INTO groupe(nomGroupe,id_CreateurGroupe) VALUES('$nomGroupe',$this->id)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="SELECT id_Groupe FROM Groupe WHERE nomGroupe = '$nomGroupe'";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$row= mysqli_fetch_assoc($sqlExecute);
		$id_Groupe = $row['id_Groupe'];

		$sql="INSERT INTO appartenir (id_Membre,id_Groupe) VALUES ($this->id, $id_Groupe)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$db->deconnection();
	}

	function listPossibleGroup($db){
		$db->connection();
		
		$sql="SELECT gp.id_Groupe,gp.nomGroupe from membre mb,appartenir ap, groupe gp WHERE ap.id_Groupe = gp.id_Groupe AND ap.id_Membre = mb.id_Membre AND mb.id_Membre = $this->id AND gp.id_Groupe NOT IN(SELECT gp.id_Groupe FROM groupe gp , affilier af WHERE gp.id_Groupe = af.id_Groupe)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;

		$db->deconnection();
	}

	function addListToGroup($db,$idGroupe,$idListe){
		$db->connection();
		
		$sql="INSERT INTO affilier (id_Liste, id_Groupe) VALUES ($idListe, $idGroupe)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);


		$db->deconnection();
	}

	function isAdministrator($db,$idGroupe){
		$db->connection();
		
		$sql="SELECT gp.id_Groupe FROM groupe gp , membre mb WHERE gp.id_CreateurGroupe = mb.id_Membre AND mb.id_Membre = $this->id AND gp.id_Groupe = $idGroupe";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$row= mysqli_fetch_assoc($sqlExecute);
		if ($row['id_Groupe'] == $idGroupe) {
			return true;
		}else{
			return false;
		}
		$db->deconnection();
	}

	function giftInfo($db,$idGift){
		$db->connection();
		$sql="SELECT * FROM cadeaux WHERE id_Cadeau = $idGift";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}

	function book($db,$idGfit){
		$db->connection();
		$sql="UPDATE contient SET id_MembreAcheteur = $this->id WHERE id_Cadeau = $idGfit ";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$db->deconnection();
	}

	function deleteGroup($db,$idGroup){
		$db->connection();
		$sql="DELETE FROM groupe WHERE id_Groupe = $idGroup";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="DELETE FROM affilier WHERE id_Groupe = $idGroup";
		$sqlExecute = mysqli_query($db->getCo(),$sql);

		$sql="DELETE FROM affilier WHERE id_Groupe = $idGroup";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$db->deconnection();
	}

	function listPossibleMember($db,$idGroup){
		$db->connection();
		$sql="SELECT id_Membre, loginMembre FROM membre WHERE id_Membre NOT IN(SELECT id_Membre FROM `appartenir` WHERE id_Groupe= $idGroup )";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		return $sqlExecute;
		$db->deconnection();
	}
	function AddMemberGroup($db,$idGroup,$idMember){
		$db->connection();
		$sql="INSERT INTO appartenir (id_Membre, id_Groupe) VALUES ($idMember,$idGroup)";
		$sqlExecute = mysqli_query($db->getCo(),$sql);
		$db->deconnection();
	}

	function deconnection(){
		session_destroy();
	}
}
?>