<?php
        
        require_once("../modeles/metier/Utilisateur_classe.php");
        require_once("../modeles/ConnexionBD_classe.php");
        
        class UtilisateurGateway {
                
                /** connexionBD est la référence a la classe permettant de contacter la BDD */
                private $connexionBD;
                
                public function __construct(ConnexionBD $bd = NULL) {
                        $this->connexionBD = $bd;
                }
                
                 /**
                 * description:
                 * trouverUtilisateur a pour but de trouver une tache répondant au critères de "colonneRestrictive",
                 * si on a aucune restriction, on retourne la totalité de la table
                 * paramètres:
                 *      colonneRestrictive : la colonne sur lequel le where s'applique, sans where si vide
                 *      valeurColonne : la valeur souhaité pour la colonne où se base le where de la requete
                 * return:
                 *      une array de Utilisateur satisfaisant la potentielle condition de la colonne restrictive
                 */
                public function trouverUtilisateur(string $colonneRestrictive = "", string $valeurColonne = "") : array {
                        $utlTrouves = [];
                        
                        if($colonneRestrictive == "") $query = "SELECT * FROM UTILISATEURS";
                        else $query = "SELECT * FROM UTILISATEURS WHERE :nomColonne = :valeurColonne;";
                        
                        $connexionBD->executerQuery($query, ["nomColonne" => [$colonneRestrictive, PDO::PARAM_STR],
                                                                ":valeurColonne" => [$valeurColonne, PDO::PARAM_STR]
                                                        ]);
                        
                        foreach($connexionBD->recupererResultatQuery() as $row) {
                                $utlTrouves[] = new Utilisateur($row['pseudo'], $row['email'], $row['dateNaissance'], $row['motDePasse']);
                        }
                        
                        return $utlTrouves;
                }
                
                /**
                 * description:
                 * ajouterUtilisateur a pour but d'ajouter unn utilisateur passée en paramètre a la bd
                 * paramètres:
                 *      ajout : Instance de la tache à ajouter
                 * return:
                 *      Un boolean.
                 * 		True: Commande exécutée avec succès
                 * 		False: Erreur
                 */
                public function ajouterUtilisateur(Utilisateur $ajout) {
                        $query = "INSERT INTO UTILISATEURS VALUES(:pseudo, :email, :dateNaissance, :motDePasse);";
                        
                        return $this->connexionBD->executeQuery($query, [":pseudo" => [$ajout->pseudo, PDO::PARAM_STR],
                                                                                ":email" => [$ajout->email, PDO::PARAM_STR],
                                                                                ":dateNaissance" => [$ajout->dateTache, PDO::PARAM_DATE],//pas sur ici
                                                                                ":motDePasse" => [$ajout->motDePasse, PDO::PARAM_STR]]);
                }
                
                /**
                 * description:
                 * supprimerUtilisateur a pour but de supprimer un utilisateur passée en paramètre
                 * paramètres:
                 *      suppression: l'instance de la tâche que l'on doit supprimer
                 * return:
                 *      Un boolean.
                 * 		True: Commande exécutée avec succès
                 * 		False: Erreur
                 */
                public function supprimerUtilisateur(Utilisateur $suppression) {
                        $query = "DELETE UTILISATEURS WHERE pseudo = :pseudo";
                        return $this->connexionBD->executerQuery($query, [":pseudo" => [$suppression->pseudo, PDO::PARAM_STR]]);
                }
                
        }
