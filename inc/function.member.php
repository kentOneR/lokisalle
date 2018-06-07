<?php

require_once('init.inc.php');

// Modification membre
if(isset($_POST['managemember'])) {
    $id_member = $_POST['admin-id-member'];
    var_dump($id_member);
    $req = $pdo->prepare("UPDATE membre SET 
        pseudo = '$_POST[adminpseudo]',
        nom = '$_POST[adminname]', 
        prenom = '$_POST[adminfirstname]', 
        email = '$_POST[adminemail]', 
        civilite = '$_POST[adminsexe]', 
        statut = '$_POST[adminstatut]'
        WHERE id_membre = ? ");
    $req->execute(array($id_member));
    
    $modifResult = true;


    header('location:../admin?action=edit-member&id_member='.$id_member.'.php');
}

?>