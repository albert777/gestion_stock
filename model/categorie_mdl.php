<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Categorie_mdl
    {
    	private $idcategorie;
    	private $nom;
		
		
		
		public function getCategorie($attribut)
		{
			switch($attribut)
			{
				case "idcategorie": return $this->idcategorie;
				break;
				case "nom":return $this->nom;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setCategorie($attribut,$value)
		{
			switch($attribut)
			{
				case "idcategorie": $this->idcategorie=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addCategorie_mdl($categorie_object)
		{	
			$categorie_array=array();
			foreach ($categorie_object as $key => $value) {
				if($key=="password")
				{
					array_push($categorie_array,array($key=>md5($categorie_object->getCategorie($key))));
				}
				else
				{
					array_push($categorie_array,array($key=>$categorie_object->getCategorie($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($categorie_array,"categorie");
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
		
		public function get_All_categories_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("categorie",array("ASC"=>array("idcategorie")));
			$resultats=$connection->query($requette);
			$categories_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$categorie=new Categorie_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$categorie->setCategorie($key, $value);
				}
				array_push($categories_array,$categorie);
			}
			return $categories_array;
		}
		
		public function get_categorie_values_mdl($idcategorie)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("categorie",null,array("idcategorie"=>$idcategorie));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$categorie=new Categorie_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$categorie->setCategorie($key, $value);
				}
			}
			return $categorie;
		}
		
		public function update_Categorie_mdl($categorie)
		{
			$categorie_array=array();
			foreach ($categorie as $key => $value) {
				if($key=="password")
				{
					array_push($categorie_array,array($key=>md5($categorie->getCategorie($key))));
				}
				else
				{
					array_push($categorie_array,array($key=>$categorie->getCategorie($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($categorie_array,"categorie",array("idcategorie"=>$categorie->getCategorie("idcategorie")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_categorie_mdl($idcategorie)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("categorie",array("idcategorie"=>$idcategorie));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_categorie.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
