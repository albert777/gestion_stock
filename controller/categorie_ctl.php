<?php
	include_once (dirname(__DIR__)."/model/categorie_mdl.php");
    class Categorie_ctl
    {
		//add user
		public function addCategorie($categorie_values)
		{
			$categorie=new Categorie_mdl();
			if(isset($categorie_values['idcategorie']) && $categorie_values['idcategorie']==0)
			{
				foreach ($categorie_values as $key => $value) 
				{
					$categorie->setCategorie($key,$value);
				}
				$check=$categorie->addCategorie_mdl($categorie);
			}
			else
			{	
				foreach ($categorie_values as $key => $value) 
				{
					$categorie->setCategorie($key,$value);
				}
				$check=$categorie->update_Categorie_mdl($categorie);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_categorie.php");
			return $check;
			//echo "<pre>";print_r($user);exit;
		}
		
		//display all categories
		
		public function get_All_categories()
		{
			$categorie=new Categorie_mdl();
			$all_categories=$categorie->get_All_categories_mdl();
			return $all_categories;
		}
		
		//get values for on categorie
		
		public function get_categorie_values($idcategorie)
		{
			$categorie=new Categorie_mdl();
			$categorie_values=$categorie->get_categorie_values_mdl($idcategorie);
			return $categorie_values;
		}
		
		//Delete categorie
		
		public function delete_categorie($idcategorie)
		{
			$categorie=new Categorie_mdl();
			$categorie->delete_categorie_mdl($idcategorie);
			return $categorie_values;
		}
    }
?>