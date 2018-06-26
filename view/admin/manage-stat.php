<?php

require_once('model/manage.stat.php');

if(isset($_GET['action']) && $_GET['action'] == 'stat'):

// TOP 5 BEST ROOMS BY REVIEW
$topRoomReq = topRoomsStat(5);
$topRoomReq = $topRoomReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST ROOMS BY NB ORDER
$topOrderReq = topOrdersStat(5);
$topOrderReq = $topOrderReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST MEMBERS BY NB OF ORDER
$topMemberOrderReq = topMembersOrderStat(5);
$topMemberOrderReq = $topMemberOrderReq->fetchAll(PDO::FETCH_ASSOC);

// TOP 5 BEST MEMBERS BY PRICE
$topMemberBuyReq = topMembersOriceStat(5);
$topMemberBuyReq = $topMemberBuyReq->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="col-sm-6 mt-3">
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
</div>
<div class="col-sm-6 mt-3">
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
</div>
<div class="col-sm-6 mt-3">
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
</div>
<div class="col-sm-6 mt-3">
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
</div>

<?php endif; ?>