<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Role_mdl
    {
    	private $idrole;
    	private $nom;
		
		
		
		public function getRole($attribut)
		{
			switch($attribut)
			{
				case "idrole": return $this->idrole;
				break;
				case "nom":return $this->nom;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setRole($attribut,$value)
		{
			switch($attribut)
			{
				case "idrole": $this->idrole=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addRole_mdl($role_object)
		{	
			$role_array=array();
			foreach ($role_object as $key => $value) {
				if($key=="password")
				{
					array_push($role_array,array($key=>md5($role_object->getRole($key))));
				}
				else
				{
					array_push($role_array,array($key=>$role_object->getRole($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($role_array,"role");
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
		
		public function get_All_roles_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("role",array("ASC"=>array("idrole")));
			$resultats=$connection->query($requette);
			$roles_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$role=new Role_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$role->setRole($key, $value);
				}
				array_push($roles_array,$role);
			}
			return $roles_array;
		}
		
		public function get_role_values_mdl($idrole)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("role",null,array("idrole"=>$idrole));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$role=new Role_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$role->setRole($key, $value);
				}
			}
			return $role;
		}
		
		public function update_Role_mdl($role)
		{
			$role_array=array();
			foreach ($role as $key => $value) {
				if($key=="password")
				{
					array_push($role_array,array($key=>md5($role->getRole($key))));
				}
				else
				{
					array_push($role_array,array($key=>$role->getRole($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($role_array,"role",array("idrole"=>$role->getrole("idrole")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_role_mdl($idrole)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("role",array("idrole"=>$idrole));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_role.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
