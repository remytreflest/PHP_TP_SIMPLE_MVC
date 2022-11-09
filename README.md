Architecture du code :

_ MVC basique
_ Déclaration des constantes utilisées (StatusCode et DEBUG) dans ce code faite dans le fichier Class/BDDphp

Foncitonnement des variables de DEBUG :
    _ const DEBUG = false; 
    --> Permet d'activer ou non le mode DEBUG

    _ const EXIT_WHEN_ERROR = false; 
    --> Permet de stopper l'execution du code avec affichage de l'erreur

    _ const SIMULATE_ERROR_500 = false; 
    --> Permet, dans le cas où le mode DEBUG est activé, de simuler le retour d'une erreur 500 sur la partie affichage de votre code (les views). Cele permet de vérifier si sa mise en place de gestion d'erreur est fonctionnelle.

    _ const SIMULATE_ERROR_400 = false; 
    --> Même fonctionnement mais avec une erreur 500. Attention, activer les deux ne sert à rien, seul l'erreur 500 sera simuler (car override via le déroulement naturel du code)

Définition(s) :

_ Un tupple : C'est de manière imagé un tableau, qui contient 2 données dans sa forme la plus simple et utilisé ici. En premier lieu un statusCode (qui permet de signer la réussite ou l'échec d'une méthode en fonction du nombre retourné), puis les données de retour de cette méthode.

Ex : $tupple = array(200, true) -> dans cet exemple, le statusCode 200 et un booléen sont renvoyés.

