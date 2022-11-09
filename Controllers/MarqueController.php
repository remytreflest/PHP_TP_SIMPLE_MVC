<?php

class MarqueController extends MarqueManager {

    /**
     * Récupère la liste des marques
     */
    public function ctrlGetMarques(){
        ob_start();
        $tupple = $this->getMarques();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            // Si cette méthode ne fonctionne pas, étant donné que c'est la "page d'accueil" de "Marque", je renvoie vers une page future d'erreur critique
            header("Location: index.php?page=error");
            return;
        } 
        $marques = $tupple[1];
        require "Views/Marques/index.php";
        $page = ob_get_clean();

        return $page;
    }

    /**
     * Renvoie la page de formulaire pour créer une marque
     */
    public function ctrlCreateMarqueForm(){
        require "Views/Marques/createMarque.php";
        return;
    }

    /**
     * Méthode permettant la création d'une marque via le Manager.php
     */
    public function ctrlCreateMarque($nom = null){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($nom) || !is_string($nom)){
            require "Views/Marques/createMarque.php";
            return;
        }
        
        $tupple = $this->createMarque($nom);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=marques&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
    }

    /**
     * Renvoie la page de formulaire pour mettre à jour une marque
     */
    public function ctrlUpdateMarqueForm($id){
        ob_start();
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=marques&action=GET&success=false");
            return;
        }
        $tupple = $this->getMarque($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Marques"
        $this->redirectMainPageMarqueIfError($tupple);
        
        $marque = $tupple[1];
        require "Views/Marques/updateMarque.php";
        $page = ob_get_clean();
        return $page;
    }

    /**
     * Méthode permettant la mise à jour d'une marque via le Manager.php
     */
    public function ctrlUpdateMarque($id, $nom){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($nom) || !is_string($nom) || empty($id) || intval($id) == 0){
            header("Location: index.php?page=marques&action=GET&success=false");
            return;
        }

        $tupple = $this->updateMarque($id, $nom);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Marques"
        $this->redirectMainPageMarqueIfError($tupple);

        header("Location: index.php?page=marques&action=GET");
        return;
    }

    /**
     * Méthode permettant la suppression d'une marque via le Manager.php
     */
    public function ctrlDeleteMarque($id){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=marques&action=GET&success=false");
            return;
        }

        $tupple = $this->deleteMarque($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=marques&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
        return;
    }

    /**
     * Permet une redirection vers la page principale qui concerne le manager (ici, index.php avec page=marques&action=GET)
     */
    private function redirectMainPageMarqueIfError($tupple){
        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=marques&action=GET&success=false");
            return;
        }
    }

}