<div class="container-fluid">
        <div class="row tm-banner-row" id="tm-section-search">
            <form action="show-room.php" method="post" class="tm-search-form tm-section-pad-2">
                <div class="col-lg-12 text-center">
                    <h3 class="section-subheading text-muted">Trouvez la salle qui vous convient</h3>
                </div>
                <br>
                <div class="form-row tm-search-form-row">
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="category">Choisissez votre catégorie</label>
                        <select name="category" type="text" class="form-control" id="select-category" placeholder="..." required>
                            <option value="all" selected>Toutes les categories</option>
                            <option value="réunion">Réunion</option>
                            <option value="séminaire">Séminaire</option>
                            <option value="formation">formation</option>
                        </select>
                    </div>
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="city">Choisissez votre ville</label>
                        <select name="city" type="text" class="form-control" id="select-city" placeholder="..." required>
                            <option value="all" selected>Toutes les villes</option>
                            <option value="Paris">Paris</option>
                            <option value="Lyon">Lyon</option>
                            <option value="Marseille">Marseille</option>
                        </select>
                    </div>
                </div>
                <div class="form-row tm-search-form-row">
                    <div class="form-group tm-form-group tm-form-group-1">
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-3">
                            <label for="inputAdult">Capacité</label>
                            <select name="capacity" class="form-control tm-select" id="inputAdult" required>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50" selected>50</option>
                                <option value="60">60</option>
                                <option value="70">70</option>
                                <option value="80">80</option>
                                <option value="90">90</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="form-group tm-form-group tm-form-group-pad col-9">
                            <label for="price">Prix (€)</label>
                            <input type="text" id="price" name="price" readonly style="border:0;" required>
                            <div id="slider-range-min"></div>
                        </div>
                    </div>
                    <div class="form-group tm-form-group tm-form-group-1">
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                            <label for="arrival-date">Date d'arrivée</label>
                            <input name="arrival-date" type="text" class="form-control" id="inputCheckIn" placeholder="Date arrivée" autocomplete="off"> 
                        </div>
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                            <label for="departure-date">Date de départ</label>
                            <input name="departure-date" type="text" class="form-control" id="inputCheckOut" placeholder="Date départ" autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- form-row -->
                <div class="form-row tm-search-form-row flex-row-reverse">
                    <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                        <label for="btnSubmit">&nbsp;</label>
                        <button type="submit" class="btn btn-primary tm-btn tm-btn-search text-uppercase" name="search-room" id="btnSubmit">Trouver une salle</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- row -->
    </div>