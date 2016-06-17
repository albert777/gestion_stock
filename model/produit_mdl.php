<?php
	include_once(dirname(__DIR__)."/dao/connection.php");
	include_once(dirname(__DIR__)."/dao/dao.php");
    class Produit_mdl
    {
    	private $idproduit;
    	private $nom;
		private $codeproduit;
    	private $quantite;
		
		
		public function getProduit($attribut)
		{
			switch($attribut)
			{
				case "idproduit": return $this->idproduit;
				break;
				case "nom":return $this->nom;
				break;
				case "codeproduit": return $this->codeproduit;
				break;
				case "quantite":return $this->quantite;
				break;
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function setProduit($attribut,$value)
		{
			switch($attribut)
			{
				case "idproduit": $this->idproduit=$value;
				break;
				case "nom": $this->nom=$value;
				break;
				case "codeproduit": $this->codeproduit=$value;
				break;
				case "quantite": $this->quantite=$value;
				break;
				
				
				default:echo "L'attribut ".$attribut." n'existe";
			}
		}
		
		public function addProduit_mdl($produit_object)
		{	
			$produit_array=array();
			foreach ($produit_object as $key => $value) {
				if($key=="password")
				{
					array_push($produit_array,array($key=>md5($produit_object->getProduit($key))));
				}
				else
				{
					array_push($produit_array,array($key=>$produit_object->getProduit($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateInsertQuery($produit_array,"produit");
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
		
		public function get_All_produits_mdl()
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("produit",array("ASC"=>array("idproduit")));
			$resultats=$connection->query($requette);
			$produits_array=array();
			while ($reponse=$resultats->fetch()) {
				
				$produit=new Produit_mdl();
				foreach ($reponse as $key => $value) {
					if(!is_int($key) && $key!="idgroupe")
						$produit->setProduit($key, $value);
				}
				array_push($produits_array,$produit);
			}
			return $produits_array;
		}
		
		public function get_produit_values_mdl($idproduit)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateSelectQuery("produit",null,array("idproduit"=>$idproduit));
			$resultats=$connection->query($requette);
			while ($reponse=$resultats->fetch()) {
				
				$produit=new Produit_mdl();
				foreach ($reponse as $key => $value) 
				{
					if(!is_int($key) && $key!="idgroupe")
						$produit->setProduit($key, $value);
				}
			}
			return $produit;
		}
		
		public function update_Produit_mdl($produit)
		{
			$produit_array=array();
			foreach ($produit as $key => $value) {
				if($key=="password")
				{
					array_push($produit_array,array($key=>md5($produit->getProduit($key))));
				}
				else
				{
					array_push($produit_array,array($key=>$produit->getProduit($key)));
				}
				
			}
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generateUpdateQuery($produit_array,"produit",array("idproduit"=>$produit->getProduit("idproduit")));
			if($connection->exec($requette))
			{
				return true;
			}
			else
			{
				return FALSE;
			}
			
		}
		
		function delete_produit_mdl($idproduit)
		{
			$connection=new Connection();
			$connection=$connection->connectiondb();
			$dao_object=new Dao();
			$requette=$dao_object->generatedeleteQuery("produit",array("idproduit"=>$idproduit));
			if($connection->exec($requette))
			{
				header("location:http://localhost/gestionstock/view/gestion_access_produit.php");
				return true;
			}
			else
			{
				return FALSE;
			}
		}
    }
