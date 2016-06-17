<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Beneficiaire_mdl
    {
    	private $idbeneficiaire;
    	private $nom;
		private $fonction;
		private $institution;
		
		
		
		public function getBeneficiaire($attribut)
		{
			switch($attribut)
			{
				case "idbeneficiaire": return $this->idbeneficiaire;
				break;
				case "nom":return $this->nom;
				break;
				case "fonction":return $this->fonction;
				break;
				case "institution":return $this->institution;
				break;
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setBeneficiaire($attribut,$value)
		{
			switch($attribut)
			{
				case "idbeneficiaire": $this->idbeneficiaire=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				case "fonction": $this->fonction=$value;
				break;
				case "institution": $this->institution=$value;
				break;
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addBeneficiaire_mdl($beneficiaire_object)
		{	
			$beneficiaire_array=array();
			foreach ($beneficiaire_object as $key => $value) {
				if($key=="password")
				{
					array_push($beneficiaire_array,array($key=>md5($beneficiaire_object->getBeneficiaire($key))));
				}
				else
				{
					array_push($beneficiaire_array,array($key=>$beneficiaire_object->getBeneficiaire($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($beneficiaire_array,"beneficiaire");
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
		
		public function get_All_beneficiaires_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("beneficiaire",array("ASC"=>array("idbeneficiaire")));
			$resultats=$connection->query($requette);
			$beneficiaires_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$beneficiaire=new Beneficiaire_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$beneficiaire->setBeneficiaire($key, $value);
				}
				array_push($beneficiaires_array,$beneficiaire);
			}
			return $beneficiaires_array;
		}
		
		public function get_beneficiaire_values_mdl($idbeneficiaire)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("beneficiaire",null,array("idbeneficiaire"=>$idbeneficiaire));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$beneficiaire=new Beneficiaire_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$beneficiaire->setBeneficiaire($key, $value);
				}
			}
			return $beneficiaire;
		}
		
		public function update_Beneficiaire_mdl($beneficiaire)
		{
			$beneficiaire_array=array();
			foreach ($beneficiaire as $key => $value) {
				if($key=="password")
				{
					array_push($beneficiaire_array,array($key=>md5($beneficiaire->getBeneficiaire($key))));
				}
				else
				{
					array_push($beneficiaire_array,array($key=>$beneficiaire->getBeneficiaire($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($beneficiaire_array,"beneficiaire",array("idbeneficiaire"=>$beneficiaire->getBeneficiaire("idbeneficiaire")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_beneficiaire_mdl($idbeneficiaire)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("beneficiaire",array("idbeneficiaire"=>$idbeneficiaire));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_beneficiaire.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
