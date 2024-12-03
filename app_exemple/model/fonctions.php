<?php  


function updateUsers($db, $nom, $prenom,$id){
	$reponse = $db->prepare("update users set nom = ?, prenom = ? where id = ?");
	$reponse->execute(array($_GET["nom"],$_GET["prenom"], $_GET["id"] ));
	return $reponse;
}

function insertUsers($db, $nom , $prenom){
	$reponse = $db->prepare("insert into users (nom,prenom) values (?,?)");
	$reponse->execute(array($_GET["nom"], $_GET["prenom"]));
	return $reponse;
}

function selectUser($db,$id){
	$reponse = $db->prepare("select * from users where id=?");
	$reponse->execute(array($_GET["id"]));
	return $reponse;
}
function selectAllUsers($db){
	$reponse = $db->prepare("select * from users ");
	$reponse->execute();
	return $reponse;
}

?>