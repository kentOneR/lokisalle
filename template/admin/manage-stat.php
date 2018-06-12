<?php

if(isset($_GET['action']) && $_GET['action'] == 'stat'):

// TOP 5 BEST ROOMS BY REVIEW
$topRoomReq = $pdo->prepare("SELECT a.id_salle, s.titre, ROUND(AVG(a.note), 1) as avg_note FROM avis a, salle s WHERE s.id_salle=a.id_salle GROUP BY id_salle ORDER BY avg_note DESC LIMIT 5");
$topRoomReq->execute();
$topRoomReq = $topRoomReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST ROOMS BY NB ORDER
$topOrderReq = $pdo->prepare("SELECT c.id_salle, s.titre, COUNT(c.id_commande) as nb_order FROM commande c, salle s WHERE s.id_salle=c.id_salle GROUP BY id_salle ORDER BY nb_order DESC LIMIT 5");
$topOrderReq->execute();
$topOrderReq = $topOrderReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST MEMBERS BY NB OF ORDER
$topMemberOrderReq = $pdo->prepare("SELECT c.id_membre, m.pseudo, COUNT(c.id_commande) as nb_order FROM commande c, membre m WHERE c.id_membre=m.id_membre GROUP BY id_membre ORDER BY nb_order DESC LIMIT 5");
$topMemberOrderReq->execute();
$topMemberOrderReq = $topMemberOrderReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST MEMBERS BY PRICE
$topMemberBuyReq = $pdo->prepare("SELECT c.id_membre, m.pseudo, SUM((DATEDIFF(c.date_depart, c.date_arrivee)*s.prix)) as total_price FROM commande c, salle s, membre m WHERE s.id_salle=c.id_salle && m.id_membre=c.id_membre GROUP BY id_membre ORDER BY total_price DESC LIMIT 5");
$topMemberBuyReq->execute();
$topMemberBuyReq = $topMemberBuyReq->fetchAll(PDO::FETCH_ASSOC);

?>
<h5>Top 5 des salles les mieux notées</h5>
<table border="1" cellpadding="5">
    <tr>
        <th>id_salle</th>
        <th>titre</th>
        <th>note (avg)</th>
    </tr>
    <?php foreach ($topRoomReq as $key => $value) { ?>
    <tr>
        <th><?= $value['id_salle'] ?></th>
        <th><?= $value['titre'] ?></th>
        <th><?= $value['avg_note'] ?>/5</th>
    </tr>
    <?php } ?>
</table>
<h5>Top 5 des salles les plus commandées</h5>
<table border="1" cellpadding="5">
    <tr>
        <th>id_salle</th>
        <th>titre</th>
        <th>Nb Cde</th>
    </tr>
    <?php foreach ($topOrderReq as $key => $value) { ?>
    <tr>
        <th><?= $value['id_salle'] ?></th>
        <th><?= $value['titre'] ?></th>
        <th><?= $value['nb_order'] ?></th>
    </tr>
    <?php } ?>
</table>
<h5>Top 5 des membres par commande</h5>
<table border="1" cellpadding="5">
    <tr>
        <th>id_membre</th>
        <th>pseudo</th>
        <th>Nb Cde</th>
    </tr>
    <?php foreach ($topMemberOrderReq as $key => $value) { ?>
    <tr>
        <th><?= $value['id_membre'] ?></th>
        <th><?= $value['pseudo'] ?></th>
        <th><?= $value['nb_order'] ?></th>
    </tr>
    <?php } ?>
</table>
<h5>Top 5 des membres par prix</h5>
<table border="1" cellpadding="5">
    <tr>
        <th>id_membre</th>
        <th>pseudo</th>
        <th>Prix total</th>
    </tr>
    <?php foreach ($topMemberBuyReq as $key => $value) { ?>
    <tr>
        <th><?= $value['id_membre'] ?></th>
        <th><?= $value['pseudo'] ?></th>
        <th><?= $value['total_price'] ?></th>
    </tr>
    <?php } ?>
</table>

<?php endif; ?>