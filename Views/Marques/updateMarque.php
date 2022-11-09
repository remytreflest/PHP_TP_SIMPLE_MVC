<h1 class="title">UPDATE MARQUES</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=marques&action=GET">Retour</a>

<?php
if(!empty($marque)){
?>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Mettre à jour la marque <?=$marque['nom'];?></h5>
        </div>
        <div class="card-body">
            <form action="index.php?page=marques&action=UPDATE" method="POST">
                <div class="form-group">
                    <label for="nom">Nouveau nom :</label>
                    <input type="text" class="form-control mt-3" name="nom" id="nom" value="<?=$marque['nom'];?>" />
                </div>
                <input type="hidden" name="id" id="id" value="<?=$marque['id_marque'];?>" />
                <button type="submit" class="btn btn-warning mt-3">Modifier</button>
            </form>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="alert alert-warning">Marque non trouvée pour une mise à jour.</div>
    <?php
}