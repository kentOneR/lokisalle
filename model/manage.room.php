<?php

require_once('init.inc.php');
require_once('../controller/config.php');

if($_POST){
    $photoDB = '';
    if ($_SESSION['token'] == $token) {
        if(isset($_POST['photo-old'])){
            $photoDB = $_POST['photo-old'];
        }
        if(!empty($_FILES['photo']['name'])) {

            $error = false;
            $tempFile = $_FILES['photo']['tmp_name'];
            $actualSize = $_FILES['photo']['size'];

            $newName = bin2hex(mcrypt_create_iv(8, MCRYPT_DEV_URANDOM));
            $legalExtensions = array("JPG", "PNG", "jpg", "png");
            $legalSize = "1000000"; // 1000000 Octets = 1 MO

            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photoName = $_POST['id-room'].'_'.strtolower($_POST['title']).'_'.$newName.'.'.$extension;
            $photoFolder = 'www/lokisalle/img/room/'.$photoName;
            $photoDB = $photoName;

            // On s'assure que le fichier n'est pas vide
            if ($actualSize == 0) {
                $error = true;
            }

            // On vérifie qu'un fichier portant le même nom n'est pas présent sur le serveur
            if (file_exists($photoFolder)) {
                $error = true;
            }

            // On effectue nos vérifications réglementaires
            if (!$error) {
                if ($actualSize < $legalSize) {
                    if (in_array($extension, $legalExtensions)) {
                        // copy($tempFile, $photoFolder);

                        // Mise en place d'une connexion
                        $conn_id = ftp_connect($ftp_server) or die("Impossible de se connecter au serveur $ftp_server");
                        // Identification avec un nom d'utilisateur et un mot de passe
                        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("Impossible de s'identifier $ftp_server");

                        if(ftp_pasv($conn_id, true)) // La valeur « true » signifie qu'on l'active, false qu'on le désactive
                        {
                            // Charge un fichier
                            if (ftp_put($conn_id, $photoFolder, $tempFile, FTP_BINARY)) {
                            echo "Le fichier a té chargé avec succès\n";
                            } else {
                            echo "Il y a eu un problème lors du chargement du fichier $file\n";
                            }
                        }

                        // Fermeture de la connexion
                        ftp_close($conn_id);
                    }
                }
            } else {
                @unlink($photoFolder);
                echo "Une erreur s'est produite";
            }
        }
        foreach ($_POST as $key => $value) {
            if($key != 'category') {
                $_POST[$key] = htmlentities(addslashes($value));
            }
        }
        if(isset($_POST['id-room']) && !empty($_POST['id-room'])){
            $idRoom = $_POST['id-room'];
            $roomReq = $pdo->prepare("UPDATE salle SET 
                titre = '$_POST[title]',
                description = '$_POST[description]',
                photo = '$photoDB',
                pays = '$_POST[country]',
                ville = '$_POST[city]',
                adresse = '$_POST[address]',
                cp = '$_POST[cp]',
                capacite = '$_POST[capacity]',
                categorie = '$_POST[category]'
            WHERE id_salle = ? ");
            $roomReq->execute(array($idRoom));
        } else {
            $roomReq = $pdo->prepare("INSERT INTO salle( titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES
            (:title, :description, :photo, :country, :city, :address, :cp, :capacity, :category)");
            $roomReq->execute(array(
                "title" => $_POST['title'], 
                "description" => $_POST['description'],
                "photo" => $photoDB,
                "country" => $_POST['country'],
                "city" => $_POST['city'],
                "address" => $_POST['address'],
                "cp" => $_POST['cp'],
                "capacity" => $_POST['capacity'],
                "category" => $_POST['category']
            ));
        }
        header('location:../admin?action=show-room');
    }
} else {

    // Les token ne correspondent pas
    echo "Erreur de vérification";
}


?>