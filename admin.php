<?php require_once('inc/header.php'); 

if(adminConnect()) :
    if(isset($_GET)){
        // foreach ($_GET as $key => $value) {
        //     $_GET[$key] = htmlentities(addslashes($value));
        // }
    }

?>

<nav id="nav-admin">
    <ul>
        <li><a href="admin.php?action=stat">Statistique</a></li>
        <li><a href="admin.php?action=show-member">Liste des membres</a></li>
        <li><a href="admin.php?action=add-member">Ajouter un membre</a></li>
        <li><a href="admin.php?action=show-room">Liste des salles</a></li>
        <li><a href="admin.php?action=add-room">Ajouter une salle</a></li>
        <li><a href="admin.php?action=show-order">Liste des commandes</a></li>
        <li><a href="admin.php?action=show-review">Liste des avis</a></li>
    </ul>
</nav>

<div class="admin-container">
    <?php require_once('template/admin/manage-stat.php'); ?>
    <?php require_once('template/admin/manage-member.php'); ?>
    <?php require_once('template/admin/manage-room.php'); ?>
    <?php require_once('template/admin/manage-order.php'); ?>
    <?php require_once('template/admin/manage-review.php'); ?>
</div>

<?php else:

    header('location:index.php');

endif; ?>

<?php require_once('inc/footer.php'); ?>