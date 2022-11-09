<h1 class="title">LISTE MODELE PAR MARQUE</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=marques&action=GET">Retour</a>
<?php

if(!empty($modeles)){
    foreach($modeles as $modele){
    ?>
    <div class="card mt-3">
        <div class="card-body">
            <p>Nom du modèle : <?=$modele['nom'];?></p>
            <p>Prix : <?=$modele['prix'];?>€</p>
            <p>Id de la marque : <?=$modele['FK_id_marque'];?></p>
        </div>
    </div>
    <?php
    }
} else {
    ?>
    <div class="alert-alert-warning">Il n'y a aucun modèle</div>
    <?php
}
