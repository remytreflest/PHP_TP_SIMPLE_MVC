<h1 class="title">UPDATE MODELE</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=modeles&view=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter un modele</h5>
    </div>
    <div class="card-body mt-3">
        <form action="index.php?page=modeles&action=UPDATE" method="POST">
            <input type="hidden" name="id" value="<?=$modele['id_modele'];?>">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?=$modele['nom'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="nom">Prix :</label>
                <input type="number" class="form-control" step='0.01' name="prix" id="prix" value="<?=$modele['prix'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="id_marque">Marque : </label>
                <select name="id_marque" class="form-control" id="id_marque">
                    <?php
                    foreach($marques as $m){
                        ?>
                        <option value="<?=$m['id_marque'];?>" <?=$modele['FK_id_marque'] == $m['id_marque'] ? "selected" : "";?>><?=$m['nom'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Modifier</button>
        </form>
    </div>
</div>