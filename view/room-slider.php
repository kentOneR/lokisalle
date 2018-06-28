    <!--ROOMS SLIDER -->
    
    <h3 class="p-2">Toutes nos salles</h3>
    <div id="rooms-slider">
            <?php
        $roomListReq = showAllRooms();
        $roomListReq = $roomListReq->fetchAll(PDO::FETCH_ASSOC);

    foreach ($roomListReq as $key => $room) { ?>
                <div class="room-slide">
                    <a href="product-card.php?id-room=<?= $room['id_salle'] ?>">
                        <img src="img/room/<?= $room['photo'] ?>" alt="<?= $room['titre'] ?>">
                    </a>
                </div>
                <?php } ?>
        </div>

    </div>