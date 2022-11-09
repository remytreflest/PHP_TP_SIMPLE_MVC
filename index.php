<?php
require_once "Views/header.php";
require_once "Class/Autoload.php";
Autoload::load();

if(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == "true"){
    BDD::requireErrorView(BDD::STATUSCODE_200);
}
if(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == "false"){
    BDD::requireErrorView(BDD::STATUSCODE_400);
}

if(isset($_GET['page'])){

    switch ($_GET['page']) {

        case 'marques':

            if(isset($_GET['action']) && !empty($_GET['action'])){
                $controller = new MarqueController();
                switch ($_GET['action']){
                    case 'CREATE':
                        if(isset($_POST) && !empty($_POST)){
                            echo $controller->ctrlCreateMarque($_POST['nom']);
                        } else {
                            echo $controller->ctrlCreateMarqueForm();
                        }
                        break;
                    case 'UPDATE':
                        if(isset($_POST['id']) && !empty($_POST['id']) || isset($_GET['id']) && !empty($_GET['id'])){
                            if(isset($_POST['id']) && !empty($_POST['id'])){
                                echo $controller->ctrlUpdateMarque($_POST['id'], $_POST['nom']);
                            } else {
                                echo $controller->ctrlUpdateMarqueForm($_GET['id']);
                            }
                        } else {
                            header("Location: index.php?page=marques&action=GET");
                        }
                        break;
                    case 'DELETE':
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            echo $controller->ctrlDeleteMarque($_GET['id']);
                        } else {
                            header("Location: index.php?page=marques&action=GET");
                        }
                        break;
                    default:
                        echo $controller->ctrlGetMarques();
                        break;
                }
            } else {
                header("Location: index.php?page=marques&action=GET");
            }
            break;


        case 'marque-modeles':
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $controller = new ModeleController();
                echo $controller->ctrlGetModelesByMarque($_GET['id']);
            }
            break;


        case 'modeles':
            
            if(isset($_GET['action']) && !empty($_GET['action'])){
                $controller = new ModeleController();
                switch ($_GET['action']){
                    case 'CREATE':
                        if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['id_marque']) && !empty($_POST['id_marque'])){
                            echo $controller->ctrlCreateModele($_POST['nom'], $_POST['prix'], $_POST['id_marque']);
                        } else {
                            echo $controller->ctrlCreateModeleForm();
                        }
                        break;
                    case 'UPDATE':
                        if(isset($_POST['id']) && !empty($_POST['id']) || isset($_GET['id']) && !empty($_GET['id'])){
                            if(isset($_POST['id']) && !empty($_POST['id'])){
                                echo $controller->ctrlUpdateModele($_POST['id'], $_POST['nom'], $_POST['prix'], $_POST['id_marque']);
                            } else {
                                echo $controller->ctrlUpdateModeleForm($_GET['id']);
                            }
                        } else {
                            header("Location: index.php?page=modeles&action=GET");
                        }
                        break;
                    case 'DELETE':
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            echo $controller->ctrlDeleteModele($_GET['id']);
                        } else {
                            header("Location: index.php?page=modeles&action=GET");
                        }
                        break;
                    default:
                        echo $controller->ctrlGetModeles();
                        break;
                }
            } else {
                header("Location: index.php?page=modeles&action=GET");
            }
            break;


        case "error" :
            echo "<p>ERREUR CRITIQUE !</p>";
            break;

        default:
        // INDEX
            break;
    }
} else {
    header("Location: index.php?page=marques&action=GET");
}

require_once "Views/footer.php";