<?php

if(isset($_GET['action']) && $_GET['action'] == 'stat'):

// $topRoomRep =$pdo->prepare("SELECT s.id_salle, s.titre, a.note FROM salle s, avis a WHERE s.id_salle=a.id_salle ");
// $topRoomRep->execute();
// $topRoomRep = $topRoomRep->fetchAll(PDO::FETCH_ASSOC);
// var_dump($topRoomRep);

$topRoomRep =$pdo->prepare("SELECT id_salle, ROUND(AVG(note), 1) FROM avis GROUP BY id_salle");
$topRoomRep->execute();
$topRoomRep = $topRoomRep->fetchAll(PDO::FETCH_ASSOC);
var_dump($topRoomRep);

?>

<?php endif; ?>