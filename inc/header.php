<?php require_once('init.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOKISALLE, le spécaliste de la location de salles pour vos réunion, formation, séminaire</title>
    <meta name="description" content="Créé en 2012, LokiSalle dispose d'un large choix de salles de réunion de différentes dimensions pouvant accueillir de 10 à 200 personnes sur Paris, Bordeaux, Marseille et Lyon. Nous proposons tous types de salles pour recevoir vos clients, ainsi que de très grandes salles pour les occasions d’exception."/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a id="nav-link-login" href="">Connexion</a>
            </li>
            <li>
                <a id="nav-link-signup" href="">Inscription</a>
            </li>
        </ul>
    </nav>

<?php require_once('template/login.php'); ?>
<?php require_once('template/signup.php'); ?>