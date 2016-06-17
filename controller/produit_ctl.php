<?php
	include_once (dirname(__DIR__)."/model/produit_mdl.php");
    class Produit_ctl
    {
		//add user
		public function addProduit($produit_values)
		{
			$produit=new Produit_mdl();
			if(isset($produit_values['idproduit']) && $produit_values['idproduit']==0)
			{
				foreach ($produit_values as $key => $value) 
				{
					$produit->setProduit($key,$value);
				}
				$check=$produit->addProduit_mdl($produit);
			}
			else
			{	
				foreach ($produit_values as $key => $value) 
				{
					$produit->setProduit($key,$value);
				}
				$check=$produit->update_Produit_mdl($produit);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_produit.php");
			return $check;
			//echo "<pre>";print_r($user);exit;
		}
		
		//display all users
		
		public function get_All_produits()
		{
			$produit=new Produit_mdl();
			$all_produits=$produit->get_All_produits_mdl();
			return $all_produits;
		}
		
		//get values for on user
		
		public function get_produit_values($idproduit)
		{
			$produit=new Produit_mdl();
			$produit_values=$produit->get_produit_values_mdl($idproduit);
			return $produit_values;
		}
		
		//Delete User
		
		public function delete_produit($idproduit)
		{
			$produit=new Produit_mdl();
			$produit->delete_produit_mdl($idproduit);
			return $produit_values;
		}
    }
?>