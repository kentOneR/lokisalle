<?php

require_once('init.inc.php');

// Modification membre
if(isset($_POST['managemember']) && !empty($_POST['admin-id-member'])) {
    $id_member = $_POST['admin-id-member'];
    $req = $pdo->prepare("UPDATE membre SET 
        pseudo = '$_POST[adminpseudo]',
        nom = '$_POST[adminname]', 
        prenom = '$_POST[adminfirstname]', 
        email = '$_POST[adminemail]', 
        civilite = '$_POST[adminsexe]', 
        statut = '$_POST[adminstatut]'
        WHERE id_membre = ? ");
    $req->execute(array($id_member));

    header('location:../admin?action=edit-member&id_member='.$id_member.'.php');

} else {
    $password = 'lokiwelcome';
    $password = password_hash($password, PASSWORD_DEFAULT);
    $req = $pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, statut) VALUES ('$_POST[adminpseudo]', ?, '$_POST[adminname]', '$_POST[adminfirstname]', '$_POST[adminemail]', '$_POST[adminsexe]', '$_POST[adminstatut]')");
    $req->execute(array($password));

    header('location:../admin?action=show-member');
}

?>