<?php

class ModeleManager extends BDD {

    /**
     * Récupère toutes les marques
     */
    public function getModeles(){
        try {
            $result = $this->sqlPrepare("SELECT * FROM modele", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère tous les modèles pour une marque
     */
    public function getModelesByMarque(string $idMarque){
        if(!empty($idMarque)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM modele WHERE FK_id_marque = ?", [$idMarque]);
                return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Récupère une marque
     */
    public function getModele($id){
        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM modele WHERE id_modele = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Créer un modèle
     */
    public function createModele(string $nom, float $prix, string $idMarque) : array {
        if(!empty($nom) && !empty($prix) && !empty($idMarque)){
            try {
                $this->sqlPrepare("INSERT INTO modele(nom, prix, FK_id_marque) VALUE(?, ?, ?)", [$nom, $prix, $idMarque]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour un modèle
     */
    public function updateModele(string $idModele, string $nom, float $prix, string $idMarque) : array {
        if(!empty($idModele) && !empty($nom) && !empty($prix) && !empty($idMarque)){
            try {
                $this->sqlPrepare("UPDATE modele SET nom = ?, prix = ?, FK_id_marque = ? WHERE id_modele = ?", [$nom, $prix, $idMarque, $idModele]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer un modèle
     */
    public function deleteModele($idModele){
        if(!empty($idModele)){
            try {
                $this->sqlPrepare("DELETE FROM modele WHERE id_modele = ?", [$idModele]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

}