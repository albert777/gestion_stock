<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Tache_mdl
    {
    	private $idtache;
    	private $nom;
		
		
		
		public function getTache($attribut)
		{
			switch($attribut)
			{
				case "idtache": return $this->idtache;
				break;
				case "nom":return $this->nom;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setTache($attribut,$value)
		{
			switch($attribut)
			{
				case "idtache": $this->idtache=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addTache_mdl($tache_object)
		{	
			$tache_array=array();
			foreach ($tache_object as $key => $value) {
				if($key=="password")
				{
					array_push($tache_array,array($key=>md5($tache_object->getTache($key))));
				}
				else
				{
					array_push($tache_array,array($key=>$tache_object->getTache($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($tache_array,"tache");
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
		
		public function get_All_taches_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("tache",array("ASC"=>array("idtache")));
			$resultats=$connection->query($requette);
			$taches_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$tache=new Tache_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$tache->setTache($key, $value);
				}
				array_push($taches_array,$tache);
			}
			return $taches_array;
		}
		
		public function get_tache_values_mdl($idtache)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("tache",null,array("idtache"=>$idtache));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$tache=new Tache_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$tache->setTache($key, $value);
				}
			}
			return $tache;
		}
		
		public function update_Tache_mdl($tache)
		{
			$tache_array=array();
			foreach ($tache as $key => $value) {
				if($key=="password")
				{
					array_push($tache_array,array($key=>md5($tache->getTache($key))));
				}
				else
				{
					array_push($tache_array,array($key=>$tache->getTache($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($tache_array,"tache",array("idtache"=>$tache->getTache("idtache")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_tache_mdl($idtache)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("tache",array("idtache"=>$idtache));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_tache.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
