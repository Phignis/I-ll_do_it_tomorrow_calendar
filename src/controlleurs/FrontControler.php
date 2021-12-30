<?php
	namespace IllDoTomorrowCalendar\Controlleurs;
		
	class FrontControler {
		public function __construct(){
			session_start();

			$_SESSION['user'] = null;
			$listActions=['connexion', 'getListPv', 'getListPb', 'addListPb', 'addListPv', 'delListPb', 'delListPv', 'addTache', 'delTache'];


			if (is_null($_REQUEST['action'])){
				require("../vues/listpb.php");
			}
			try{
				if (in_array($_REQUEST['action'], $listActions)){
					switch ($_REQUEST['action']){
						case 'connexion':
							$controlUtl = new ControlleurUtl();
							$controlUtl->connexionUtl($_REQUEST['pseudo'], $_REQUEST['mdp']);
						case 'getListPb':
							$controlList = new ControlerList();
							$controlList->getListPb($_REQUEST['numPage']);
						case 'delListPb':
							$controlList = new ControlerList();
							$controlList->delListP
						default:
							//appel vue err
					}
				}
			}
			catch(Exception $e){
				//ajout message exception a tab erreur
				//appel vue erreur
			}
		}
		/*
		private getUtilisateur(string $pseudo){
			if($validateur->validerStr($pseudo)){
				return $utlGW->trouverUtilisateur("pseudo",$pseudo);
			}
			//tab err
		}
		
		public addUtilisateur(string $pseudo, string $email, string $ddn, string $mdp){
			if (validateur->validerStr($pseudo) && validateur->validerStr($email) && validateur->validerStr($ddn) && validateur->validerStr($mdp)){
				$utlGW->ajouterUtilisateur(new Utilisateur($pseudo, $email, $ddn, $mdp));
				return;
			}
			//tab err
		}
		
		public delUtilisateur(string $pseudo, string $email, string $ddn, string $mdp){
			if (validateur->validerStr($pseudo) && validateur->validerStr($email) && validateur->validerStr($ddn) && validateur->validerStr($mdp)){
				$utlGW->supprimerUtilisateur(new Utilisateur($pseudo, $email, $ddn, $mdp));
				return;
			}
			//tab err
		}*/
	}
