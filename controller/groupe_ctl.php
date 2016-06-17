<?php
	include_once (dirname(__DIR__)."/model/groupe_mdl.php");
    class Groupe_ctl
    {
		//add groupe
		public function addGroupe($groupe_values)
		{
			$groupe=new Groupe_mdl();
			if(isset($groupe_values['idgroupe']) && $groupe_values['idgroupe']==0)
			{
				foreach ($groupe_values as $key => $value) 
				{
					$groupe->setGroupe($key,$value);
				}
				$check=$groupe->addGroupe_mdl($groupe);
			}
			else
			{	
				foreach ($groupe_values as $key => $value) 
				{
					$groupe->setGroupe($key,$value);
				}
				$check=$groupe->update_Groupe_mdl($groupe);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_groupe.php");
			return $check;
			//echo "<pre>";print_r($groupe);exit;
		}
		
		//display all groupes
		
		public function get_All_groupes()
		{
			$groupe=new Groupe_mdl();
			$all_groupes=$groupe->get_All_groupes_mdl();
			return $all_groupes;
		}
		
		//get values for on groupe
		
		public function get_groupe_values($idgroupe)
		{
			$groupe=new Groupe_mdl();
			$groupe_values=$groupe->get_groupe_values_mdl($idgroupe);
			return $groupe_values;
		}
		
		//Delete groupe
		
		public function delete_groupe($idgroupe)
		{
			$groupe=new Groupe_mdl();
			$groupe->delete_groupe_mdl($idgroupe);
			return $groupe_values;
		}
    }
?>