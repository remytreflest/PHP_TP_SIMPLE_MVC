<h1 class="title">INDEX MODELES</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=marques&view=GET">Retour</a>
<a class="mt-3 btn btn-success" href="index.php?page=modeles&action=CREATE">Ajouter un modèle</a>
<?php


if(!empty($modeles)){
    foreach($modeles as $modele){
    ?>
    <div class="card mt-3">
        <div class="card-body">
            <p>Nom du modèle : <?=$modele['nom'];?></p>
            <p>Prix : <?=$modele['prix'];?>€</p>
            <p>Id de la marque : <?=$modele['FK_id_marque'];?></p>
            <a class="btn btn-warning" href="index.php?page=modeles&action=UPDATE&id=<?=$modele['id_modele'];?>" class="card-link">Modifier</a>
            <a class="btn btn-danger" href="index.php?page=modeles&action=DELETE&id=<?=$modele["id_modele"];?>" class="card-link">Supprimer</a>
        </div>
    </div>
    <?php
    }
} else {
    ?>
    <div class="alert-alert-warning">Il n'y a aucun modèle</div>
    <?php
}


