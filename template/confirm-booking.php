<?php

if(isset($_GET['action']) && $_GET['action'] == 'confirm-booking') { 
    $orderReq = $pdo->prepare("SELECT c.*, s.prix FROM commande c, salle s WHERE c.id_salle=s.id_salle && c.id_membre= ? ");
    $orderReq->execute(array($_SESSION['membre']['id_membre']));
    $orderReq = $orderReq->fetchAll(PDO::FETCH_ASSOC);
    ?>
<h2>Réservations confirmées</h2>
<table class"table">
    <tr>
        <th>Id commande</th>
        <th>Id salle</th>
        <th>Date arrivée</th>
        <th>Date de départ</th>
        <th>Prix</th>
    </tr>
    <?php if(empty($orderReq)) : ?>
        <tr>
            <td colspan="3">Aucune réservation confirmé</td>
        </tr>
    <?php else : 
        foreach ($orderReq as $key => $order) { ?>
            <tr>
                <td><?= $order['id_commande'] ?></td>
                <td><?= $order['id_salle'] ?></td>
                <td><?= $order['date_arrivee'] ?></td>
                <td><?= $order['date_depart'] ?></td>
                <td><?= calcNbOfDays($order['date_arrivee'], $order['date_depart']) * $order['prix'] ?> €</td>
            </tr>

    <?php } 
    endif; ?>
</table>


<?php } ?>