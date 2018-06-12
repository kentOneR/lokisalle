<?php 
if(isset($_GET['action']) && $_GET['action'] == "show-review"):

    $r = $pdo->prepare("SELECT * FROM avis");
    $r->execute();
    $columnReview = $r->columnCount();
    $reviewReq = $r->fetchAll(PDO::FETCH_ASSOC);

?>


    <h2>Liste des avis</h2>
    <table border="1" cellpadding="5">
        <tr>
        <?php for ($i=0; $i < $columnReview  ; $i++) { 
            $column = $r->getColumnMeta($i); ?>
            <th><?=$column['name']?></th>
        <?php } ?>
            <th>action</th>
        </tr>
        <?php foreach ($reviewReq as $key => $review) { ?>
            <tr>
                <?php foreach ($review as $key => $value) { ?>
                        <td> <?= $value ?></td>
                <?php } ?>
                <td>
                    <a href="?action=edit-review&id_review=<?= $review['id_avis'] ?>"><i class="far fa-edit"></i></a>
                    <a href="?action=delete-review&id_review=<?= $review['id_avis'] ?>" onClick="confirm(\'En êtes vous sur?\')"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php } ?>
    </table>

<?php endif; ?>