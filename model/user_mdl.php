<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class User_mdl
    {
    	private $idutisateur;
    	private $nom;
		private $email;
		private $tel;
		private $login;
		private $password;
		private $fonction;
		
		public function getUser($attribut)
		{
			switch($attribut)
			{
				case "idutisateur": return $this->idutisateur;
				break;
				case "nom":return $this->nom;
				break;
				case "email":return $this->email;
				break;
				case "tel":return $this->tel;
				break;
				case "login":return $this->login;
				break;
				case "password":return $this->password;
				break;
				case "fonction":return $this->fonction;
				break;
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setUser($attribut,$value)
		{
			switch($attribut)
			{
				case "idutisateur": $this->idutisateur=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				case "email": $this->email=$value;
				break;
				case "tel": $this->tel=$value;
				break;
				case "login": $this->login=$value;
				break;
				case "password": $this->password=$value;
				break;
				case "fonction": $this->fonction=$value;
				break;
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addUser_mdl($user_object)
		{	
			$user_array=array();
			foreach ($user_object as $key => $value) {
				if($key=="password")
				{
					array_push($user_array,array($key=>md5($user_object->getUser($key))));
				}
				else
				{
					array_push($user_array,array($key=>$user_object->getUser($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($user_array,"utilisateur");
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
			//$requette=
		}
		
		public function get_All_users_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("utilisateur",array("ASC"=>array("idutisateur")));
			$resultats=$connection->query($requette);
			$users_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$user=new User_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$user->setUser($key, $value);
				}
				array_push($users_array,$user);
			}
			return $users_array;
		}
		
		public function get_user_values_mdl($idutilisateur)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("utilisateur",null,array("idutisateur"=>$idutilisateur));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$user=new User_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$user->setUser($key, $value);
				}
			}
			return $user;
		}
		
		public function update_User_mdl($user)
		{
			$user_array=array();
			foreach ($user as $key => $value) {
				if($key=="password")
				{
					array_push($user_array,array($key=>md5($user->getUser($key))));
				}
				else
				{
					array_push($user_array,array($key=>$user->getUser($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($user_array,"utilisateur",array("idutisateur"=>$user->getUser("idutisateur")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_user_mdl($idutilisateur)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("utilisateur",array("idutisateur"=>$idutilisateur));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
