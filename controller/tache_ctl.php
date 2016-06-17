<?php
	include_once (dirname(__DIR__)."/model/tache_mdl.php");
    class Tache_ctl
    {
		//add user
		public function addTache($tache_values)
		{
			$tache=new Tache_mdl();
			if(isset($tache_values['idtache']) && $tache_values['idtache']==0)
			{
				foreach ($tache_values as $key => $value) 
				{
					$tache->setTache($key,$value);
				}
				$check=$tache->addTache_mdl($tache);
			}
			else
			{	
				foreach ($tache_values as $key => $value) 
				{
					$tache->setTache($key,$value);
				}
				$check=$tache->update_Tache_mdl($tache);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_tache.php");
			return $check;
			//echo "<pre>";print_r($user);exit;
		}
		
		//display all users
		
		public function get_All_taches()
		{
			$tache=new Tache_mdl();
			$all_taches=$tache->get_All_taches_mdl();
			return $all_taches;
		}
		
		//get values for on user
		
		public function get_tache_values($idtache)
		{
			$tache=new Tache_mdl();
			$tache_values=$tache->get_tache_values_mdl($idtache);
			return $tache_values;
		}
		
		//Delete User
		
		public function delete_tache($idtache)
		{
			$tache=new Tache_mdl();
			$tache->delete_tache_mdl($idtache);
			return $tache_values;
		}
    }
?>