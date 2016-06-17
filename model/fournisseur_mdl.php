<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Fournisseur_mdl
    {
    	private $idfournisseur;
    	private $nom;
		private $adresse;
		private $tel;
		private $NIF;
		
		
		public function getFournisseur($attribut)
		{
			switch($attribut)
			{
				case "idfournisseur": return $this->idfournisseur;
				break;
				case "nom":return $this->nom;
				break;
				case "adresse":return $this->adresse;
				break;
				case "tel":return $this->tel;
				break;
				case "NIF":return $this->NIF;
				break;
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setFournisseur($attribut,$value)
		{
			switch($attribut)
			{
				case "idfournisseur": $this->idfournisseur=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				case "adresse": $this->adresse=$value;
				break;
				case "tel": $this->tel=$value;
				break;
				case "NIF": $this->NIF=$value;
				break;
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addFournisseur_mdl($fournisseur_object)
		{	
			$fournisseur_array=array();
			foreach ($fournisseur_object as $key => $value) {
				if($key=="password")
				{
					array_push($fournisseur_array,array($key=>md5($fournisseur_object->getFournisseur($key))));
				}
				else
				{
					array_push($fournisseur_array,array($key=>$fournisseur_object->getFournisseur($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($fournisseur_array,"fournisseur");
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
		
		public function get_All_fournisseurs_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("fournisseur",array("ASC"=>array("idfournisseur")));
			$resultats=$connection->query($requette);
			$fournisseurs_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$fournisseur=new Fournisseur_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$fournisseur->setFournisseur($key, $value);
				}
				array_push($fournisseurs_array,$fournisseur);
			}
			return $fournisseurs_array;
		}
		
		public function get_fournisseur_values_mdl($idfournisseur)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("fournisseur",null,array("idfournisseur"=>$idfournisseur));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$fournisseur=new Fournisseur_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$fournisseur->setFournisseur($key, $value);
				}
			}
			return $fournisseur;
		}
		
		public function update_Fournisseur_mdl($fournisseur)
		{
			$fournisseur_array=array();
			foreach ($fournisseur as $key => $value) {
				if($key=="password")
				{
					array_push($fournisseur_array,array($key=>md5($fournisseur->getFournisseur($key))));
				}
				else
				{
					array_push($fournisseur_array,array($key=>$fournisseur->getFournisseur($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($fournisseur_array,"fournisseur",array("idfournisseur"=>$fournisseur->getFournisseur("idfournisseur")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_fournisseur_mdl($idfournisseur)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("fournisseur",array("idfournisseur"=>$idfournisseur));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_fournisseur.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
