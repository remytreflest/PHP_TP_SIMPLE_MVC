<?php

class MarqueManager extends BDD {

    /**
     * Récupère toutes les marques
     */
    public function getMarques(){
        try {
            $result = $this->sqlPrepare("SELECT * FROM marque", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère une marque
     */
    public function getMarque($id){
        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM marque WHERE id_marque = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__,"message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Créer une marque
     */
    public function createMarque(string $nom) : array {
        if(!empty($nom)){
            try {
                $this->sqlPrepare("INSERT INTO marque(nom) VALUE(?)", [$nom]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour une marque
     */
    public function updateMarque(string $id, string $nom) : array {
        if(!empty($nom) && !empty($id)){
            try {
                $this->sqlPrepare("UPDATE marque SET nom = ? WHERE id_marque = ?", [$nom, $id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer une marque
     */
    public function deleteMarque($id){
        if(!empty($id)){
            try {
                $this->sqlPrepare("DELETE FROM marque WHERE id_marque = ?", [$id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::INTERNAL_SERVER_ERROR, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::BAD_PARAMS, "method" => __METHOD__]);
        }
    }

}