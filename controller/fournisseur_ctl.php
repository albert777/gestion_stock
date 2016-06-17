<?php
	include_once (dirname(__DIR__)."/model/fournisseur_mdl.php");
    class Fournisseur_ctl
    {
		//add fournisseur
		public function addFournisseur($fournisseur_values)
		{
			$fournisseur=new Fournisseur_mdl();
			if(isset($fournisseur_values['idfournisseur']) && $fournisseur_values['idfournisseur']==0)
			{
				foreach ($fournisseur_values as $key => $value) 
				{
					$fournisseur->setFournisseur($key,$value);
				}
				$check=$fournisseur->addFournisseur_mdl($fournisseur);
			}
			else
			{	
				foreach ($fournisseur_values as $key => $value) 
				{
					$fournisseur->setFournisseur($key,$value);
				}
				$check=$fournisseur->update_fournisseur_mdl($fournisseur);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_fournisseur.php");
			return $check;
			//echo "<pre>";print_r($fournisseur);exit;
		}
		
		//display all fournisseurs
		
		public function get_All_fournisseurs()
		{
			$fournisseur=new Fournisseur_mdl();
			$all_fournisseurs=$fournisseur->get_All_fournisseurs_mdl();
			return $all_fournisseurs;
		}
		
		//get values for on fournisseur
		
		public function get_fournisseur_values($idfournisseur)
		{
			$fournisseur=new Fournisseur_mdl();
			$fournisseur_values=$fournisseur->get_fournisseur_values_mdl($idfournisseur);
			return $fournisseur_values;
		}
		
		//Delete fournisseur
		
		public function delete_fournisseur($idfournisseur)
		{
			$fournisseur=new Fournisseur_mdl();
			$fournisseur->delete_fournisseur_mdl($idfournisseur);
			return $fournisseur_values;
		}
    }
?>