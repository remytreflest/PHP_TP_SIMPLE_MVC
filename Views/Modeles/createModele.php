<h1 class="title">CREATE MODELE</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=modeles&view=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter un modèle</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=modeles&action=CREATE" method="POST">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Ex : Omega" />
            </div>
            <div class="form-group mt-3">
                <label for="nom">Prix :</label>
                <input type="number" step='0.01' class="form-control" name="prix" id="prix" placeholder="Ex : 1789" />
            </div>
            <div class="form-group mt-3">
                <label for="id_marque">Marque : </label>
                <select name="id_marque" class="form-control" id="id_marque">
                    <?php
                    foreach($marques as $marque){
                        ?>
                        <option value="<?=$marque['id_marque'];?>"><?=$marque['nom'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        </form>
    </div>
</div>