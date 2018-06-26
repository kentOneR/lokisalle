<?php 
require_once('controller/frontend.php');
require_once('view/header.php'); 

if(adminConnect()) :
    if(isset($_GET)){
        foreach ($_GET as $key => $value) {
            $_GET[$key] = htmlentities(addslashes($value));
        }
    }

?>

<nav id="nav-admin">
    <ul class="d-flex flex-column flex-nowrap flex-sm-row">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-3">
                <?php require_once('view/admin/manage-stat.php'); ?>
                <?php require_once('view/admin/manage-member.php'); ?>
                <?php require_once('view/admin/manage-room.php'); ?>
                <?php require_once('view/admin/manage-order.php'); ?>
                <?php require_once('view/admin/manage-review.php'); ?>
            </div>
        </div>
    </div>
</div>

<?php else:

    header('location:index.php');

endif; ?>

<?php require_once('view/footer.php'); ?>