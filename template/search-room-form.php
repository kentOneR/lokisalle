
<div class="container-fluid">
        <div class="row tm-banner-row" id="tm-section-search">
            <form action="show-room.php" method="post" class="tm-search-form tm-section-pad-2">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted">Trouvez la salle qui vous convient</h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label for="category">Choisissez votre catégorie</label>
                        <select name="category" type="text" class="form-control" id="select-category" placeholder="..." required>
                            <option value="all" <?= (!isset($category) || $category=='%%') ? 'selected' : '' ?> >Toutes les categories</option>
                            <option value="réunion" <?= (isset($category)&&$category=='réunion') ? 'selected' : '' ?> >Réunion</option>
                            <option value="séminaire" <?= (isset($category)&&$category=='séminaire') ? 'selected' : '' ?> >Séminaire</option>
                            <option value="formation" <?= (isset($category)&&$category=='formation') ? 'selected' : '' ?> >Formation</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="city">Choisissez votre ville</label>
                        <select name="city" type="text" class="form-control" id="select-city" placeholder="..." required>
                            <option value="all" <?= (!isset($city) || $city=='%%') ? 'selected' : '' ?> >Toutes les villes</option>
                            <option value="Paris" <?= (isset($city)&&$city=='Paris') ? 'selected' : '' ?> >Paris</option>
                            <option value="Lyon" <?= (isset($city)&&$city=='Lyon') ? 'selected' : '' ?> >Lyon</option>
                            <option value="Marseille" <?= (isset($city)&&$city=='Marseille') ? 'selected' : '' ?> >Marseille</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="">
                            <label for="inputAdult">Capacité</label>
                            <select name="capacity" class="form-control tm-select" id="inputAdult" required>
                                <?php for ($i=1; $i < 11; $i++) { ?>
                                    <option value="<?= $i * 10 ?>" <?= (isset($capacity)&&$capacity==($i*10)) ? 'selected' : '' ?>><?= $i * 10 ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="">
                            <label for="price">Prix (€)</label>
                            <input type="text" id="price" name="price" readonly style="border:0;" required>
                            <div id="slider-range-min"></div>
                        </div>
                    </div>
                        <div class="d-flex flex-column col-sm-6">
                            <label for="arrival-date">Date d'arrivée</label>
                            <input name="arrival-date" type="text" class="form-control" id="inputCheckIn" value="<?= (isset($_POST['arrival-date'])) ? $_POST['arrival-date'] : '' ?>" placeholder="Date arrivée" autocomplete="off" required> 
                            <label for="departure-date">Date de départ</label>
                            <input name="departure-date" type="text" class="form-control" id="inputCheckOut" value="<?= (isset($_POST['departure-date'])) ? $_POST['departure-date'] : '' ?>" placeholder="Date départ" autocomplete="off" required>
                        </div>
                </div>
                <!-- form-row -->
                <div class="row d-flex flex-row-reverse">
                    <div class="col-12 col-sm-6">
                        <label for="btnSubmit">&nbsp;</label>
                        <button type="submit" class="btn btn-green col-12" name="search-room" id="btnSubmit">Trouver une salle</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- row -->
    </div>