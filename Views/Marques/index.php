<h1 class="title">INDEX MARQUES</h1>
<a class="mt-3 btn btn-success" href="index.php?page=marques&action=CREATE">Ajouter une marque</a>
<a class="mt-3 btn btn-info" href="index.php?page=modeles&action=GET">Gestion des modèles</a>
<?php


if(!empty($marques)){
    foreach($marques as $marque){
    ?>
    <div class="card mt-3">
        <div class="card-body">
            <p><?=$marque['nom'];?></p>
            <a class="btn btn-secondary" href="index.php?page=marque-modeles&id=<?=$marque["id_marque"];?>" class="card-link">Consulter les modèles</a>
            <a class="btn btn-warning" href="index.php?page=marques&action=UPDATE&id=<?=$marque["id_marque"];?>" class="card-link">Modifier</a>
            <a class="btn btn-danger" href="index.php?page=marques&action=DELETE&id=<?=$marque["id_marque"];?>" class="card-link">Supprimer</a>
        </div>
    </div>
    <?php
    }
} else {
    ?>
    <div class="alert-alert-warning">Il n'y a aucune marque</div>
    <?php
}