Architecture du code :

_ MVC basique
_ Déclaration des constantes utilisées (StatusCode et DEBUG) dans ce code faite dans le fichier Class/BDDphp


Définition(s) :

_ Un tupple : C'est de manière imagé un tableau, qui contient 2 données dans sa forme la plus simple et utilisé ici. En premier lieu un statusCode (qui permet de signer la réussite ou l'échec d'une méthode en fonction du nombre retourné), puis les données de retour de cette méthode.

Ex : $tupple = array(200, true) -> dans cet exemple, le statusCode 200 et un booléen sont renvoyés.

