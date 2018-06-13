<?php require_once('init.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOKISALLE, le spécaliste de la location de salles pour vos réunion, formation, séminaire</title>
    <meta name="description" content="Créé en 2012, LokiSalle dispose d'un large choix de salles de réunion de différentes dimensions pouvant accueillir de 10 à 200 personnes sur Paris, Bordeaux, Marseille et Lyon. Nous proposons tous types de salles pour recevoir vos clients, ainsi que de très grandes salles pour les occasions d’exception."
    />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style/css/main.css">
</head>

<body>
    <!-- Navigation -->

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">[ L O K I S A L L E ]
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="intro.php">Qui sommes-nous?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="show-room.php">Les salles</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-user"></i> Espace membre
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!--CONNEXION COMPTE-->
                            <?php if(userConnect()) : ?>
                                <a class="dropdown-item" href="profil.php">Mon compte</a>
                                <a class="dropdown-item" href="index.php?action=logout">Déconnexion</a>
                            <?php else : ?>
                                <a class="dropdown-item" id="nav-link-signup" href="">Inscription</a>
                                <a class="dropdown-item" id="nav-link-login" href="">Connexion</a>
                            <?php endif; ?>
                            <!-- ADMIN -->
                            <?php if(adminConnect()) : ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="admin.php">Back-Office</a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php require_once('template/login.php'); ?>
    <?php require_once('template/signup.php'); ?>