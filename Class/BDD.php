<?php

class BDD {

    private $dsn = "mysql:host=localhost;dbname=garage;charset=UTF8";
    private $username = "root";
    private $password = "";

    private $co = false;

    // Déclaration des différents statusCode que je souhaite utiliser au sein de ce code
    const STATUSCODE_500 = 500;
    const STATUSCODE_422 = 422;
    const STATUSCODE_400 = 400;
    const STATUSCODE_200 = 200;
    const INTERNAL_SERVER_ERROR = "INTERNAL_SERVER_ERROR";
    const UNPROCESSABLE_ENTITY = "UNPROCESSABLE_ENTITY";
    const BAD_PARAMS = "BAD_PARAMS";
    // Variables permettant de personnaliser le mode de débug et même de simuler des erreurs de retour type 400 ou 500 pour ainsi tester la réaction de notre code à ces cas là.
    const DEBUG = true;
    const EXIT_WHEN_ERROR = true;
    const SIMULATE_ERROR_500 = false;
    const SIMULATE_ERROR_400 = false;

    protected function getBdd()
    {
        if(!$this->co){
            try {

                $this->co = new PDO($this->dsn, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                return $this->co;
    
            } catch (Exception $ex){
                
                die($ex->getMessage());
            }
        } else {
            return $this->co;
        }
    }

    // Méthode rassemblant le "prepare" et le "execute" pour faire un appel SQL
    protected function sqlPrepare(string $requete, array $params) : PDOStatement {
        $query = $this->getBdd()->prepare($requete);
        $query->execute($params);
        return $query;
    }

    // Permet de tester si le statusCode de retour est 200 (donc si tout s'est bien passé)
    protected function isSuccessStatusCode($tupple){
        return $tupple[0] == self::STATUSCODE_200;
    }

    public static function requireErrorView($statusCode){
        require "Views/StatusCode/statusCode" . $statusCode . ".php";
    }

    protected function DEBUG($tupple){
        // Permet de simuler une erreur statusCode 400 pour les résultats des méthodes des Manager.php
        if(self::SIMULATE_ERROR_400){
            $tupple = $this->simulateError($tupple, self::STATUSCODE_400);
        }
        // Permet de simuler une erreur statusCode 500 pour les résultats des méthodes des Manager.php
        if(self::SIMULATE_ERROR_500){
            $tupple = $this->simulateError($tupple, self::STATUSCODE_500);
        }
        // En cas d'erreur, on affiche un tableau contenant l'erreur (sera plus visible si la const EXIT_WHEN_ERROR est à true car stop le déroulement ud programme)
        if(!$this->isSuccessStatusCode($tupple)){
            var_dump($tupple);
            if(self::EXIT_WHEN_ERROR){
                exit;
            }
        }
    }
    // Permet de simuler une erreur statusCode 400 pour les résultats des méthodes des Manager.php
    protected function simulateError($tupple, $statusCode){
        $tupple[0] = $statusCode;
        return $tupple;
    }

}