<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Groupe_mdl
    {
    	private $idgroupe;
    	private $nom;
		
		
		
		public function getGroupe($attribut)
		{
			switch($attribut)
			{
				case "idgroupe": return $this->idgroupe;
				break;
				case "nom":return $this->nom;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setGroupe($attribut,$value)
		{
			switch($attribut)
			{
				case "idgroupe": $this->idgroupe=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addGroupe_mdl($groupe_object)
		{	
			$groupe_array=array();
			foreach ($groupe_object as $key => $value) {
				if($key=="password")
				{
					array_push($groupe_array,array($key=>md5($groupe_object->getGroupe($key))));
				}
				else
				{
					array_push($groupe_array,array($key=>$groupe_object->getGroupe($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($groupe_array,"groupe");
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
		
		public function get_All_groupes_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("groupe1",array("ASC"=>array("idgroupe")));
			$resultats=$connection->query($requette);
			$groupes_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$groupe=new Groupe_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe1")
						$groupe->setGroupe($key, $value);
				}
				array_push($groupes_array,$groupe);
			}
			return $groupes_array;
		}
		
		public function get_groupe_values_mdl($idgroupe)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("groupe",null,array("idgroupe"=>$idgroupe));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$groupe=new Groupe_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe1")
						$groupe->setGroupe($key, $value);
				}
			}
			return $groupe;
		}
		
		public function update_Groupe_mdl($groupe)
		{
			$groupe_array=array();
			foreach ($groupe as $key => $value) {
				if($key=="password")
				{
					array_push($groupe_array,array($key=>md5($groupe->getGroupe($key))));
				}
				else
				{
					array_push($groupe_array,array($key=>$groupe->getGroupe($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($groupe_array,"groupe",array("idgroupe"=>$groupe->getgroupe("idgroupe")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_groupe_mdl($idgroupe)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("groupe",array("idgroupe"=>$idgroupe));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_groupe.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
