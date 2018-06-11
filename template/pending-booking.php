<?php

if(isset($_GET['action']) && $_GET['action'] == 'pending-booking') { ?>
<h2>Réservations en attente</h2>
<table class"table">
    <tr>
        <th>id</th>
        <th>Date arrivée</th>
        <th>Date de départ</th>
        <th>Prix</th>
        <th>Retirer</th>
        <th>Confirmer</th>
    </tr>
    <?php if(empty($_SESSION['basket'])) : ?>
        <tr>
            <td colspan="3">Aucune réservation</td>
        </tr>
    <?php else : 
        for ($i=0; $i < count($_SESSION['basket']['id-room']); $i++) { 
        $req = $pdo->prepare("SELECT prix FROM salle WHERE id_salle = ?");
        $req->execute(array($_SESSION['basket']['id-room'][$i]));
        $req = $req->fetch(PDO::FETCH_ASSOC);

        ?>
            <tr>
                <td><?= $_SESSION['basket']['id-room'][$i] ?></td>
                <td><?= $_SESSION['basket']['arrival'][$i] ?></td>
                <td><?= $_SESSION['basket']['departure'][$i] ?></td>
                <td>Montant total = <?= calcNbOfDays($_SESSION['basket']['arrival'][$i], $_SESSION['basket']['departure'][$i]) * $req['prix'] ?> €</td>
                <td><a href="?action=drop-room&id-room=<?= $_SESSION['basket']['id-room'][$i] ?>">Retirer</a></td>
                <td><a href="?action=confirm-room&id-room=<?= $_SESSION['basket']['id-room'][$i] ?>">Confirmer</a></td>
            </tr>
    <?php } ?>
        <?php if(userConnect()) : ?>
        <a href="?action=clear-basket"><button class="btn btn-default">Valider le panier</button></a>
        <?php else : ?>
            <tr>
                <td colspan="3">Veuillez vous <a href="connexion.php">connecter</a> ou vous <a href="subscribe.php">inscrire</a></td>
            </tr>
        <?php  endif; ?>
    <?php endif; ?>
</table>


<?php } ?>