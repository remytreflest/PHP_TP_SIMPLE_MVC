<?php

class ModeleController extends ModeleManager {

    /**
     * Récupère la liste des modèles
     */
    public function ctrlGetModeles(){
        ob_start();
        $tupple = $this->getModeles();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            // Si cette méthode ne fonctionne pas, étant donné que c'est la page d'accueil, je renvoie vers une page future d'erreur critique
            header("Location: index.php?page=error");
            return;
        }
        
        $modeles = $tupple[1];
        require "Views/Modeles/index.php";
        $page = ob_get_clean();
        return $page;
    }

    /**
     * Récupère la liste des modèles pour une marque
     */
    public function ctrlGetModelesByMarque(string $idMarque){
        ob_start();

        $tupple = $this->getModelesByMarque($idMarque);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageModeleIfError($tupple);

        $modeles = $tupple[1];
        require "Views/Modeles/listByMarque.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlCreateModeleForm(){
        ob_start();
        $manager = new MarqueManager();
        $tupple = $manager->getMarques();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageModeleIfError($tupple);

        $marques = $tupple[1];
        require "Views/Modeles/createModele.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlCreateModele($nom, $prix, $idMarque){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($nom) || !is_string($nom) || empty($prix) || floatval($prix) == 0 || empty($idMarque) || intval($idMarque) == 0){
            header("Location: index.php?page=modeles&action=GET&success=false");
            return;
        }

        $tupple = $this->createModele($nom, $prix, $idMarque);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=modeles&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
        return;
    }

    public function ctrlUpdateModeleForm($id){
        ob_start();

        $manager = new MarqueManager();
        $tupple = $manager->getMarques();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageModeleIfError($tupple);

        $marques = $tupple[1];

        $tupple = $this->getModele($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageModeleIfError($tupple);

        $modele = $tupple[1];
        require "Views/Modeles/updateModele.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlUpdateModele($id, $nom, $prix, $idMarque){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0 || empty($nom) || !is_string($nom) || empty($prix) || floatval($prix) == 0 || empty($idMarque) || intval($idMarque) == 0){
            header("Location: index.php?page=modeles&action=GET&success=false");
            return;
        }

        ob_start();
        $tupple = $this->updateModele($id, $nom, $prix, $idMarque);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        
        header("Location: index.php?page=modeles&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
        return;
    }

    public function ctrlDeleteModele($id){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=modeles&action=GET&success=false");
            return;
        }

        $tupple = $this->deleteModele($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=modeles&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
        return;
    }

    // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
    private function redirectMainPageModeleIfError($tupple){
        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=modeles&action=GET&success=false");
            return;
        }
    }


}