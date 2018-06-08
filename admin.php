<?php require_once('inc/header.php'); ?>

<nav id="nav-admin">
    <ul>
        <li><a href="admin.php?action=show-member">Liste des membres</a></li>
        <li><a href="admin.php?action=add-member">Ajouter un membre</a></li>
        <li><a href="admin.php?action=show-room">Liste des salles</a></li>
        <li><a href="admin.php?action=add-room">Ajouter une salle</a></li>
    </ul>
</nav>

<?php require_once('template/manage-member.php'); ?>
<?php require_once('template/manage-room.php'); ?>


<?php require_once('inc/footer.php'); ?>