<?php
	include_once (dirname(__DIR__)."/model/user_mdl.php");
    class User_ctl
    {
		//add user
		public function addUser($user_values)
		{
			$user=new User_mdl();
			if(isset($user_values['idutisateur']) && $user_values['idutisateur']==0)
			{
				foreach ($user_values as $key => $value) 
				{
					$user->setUser($key,$value);
				}
				$check=$user->addUser_mdl($user);
			}
			else
			{	
				foreach ($user_values as $key => $value) 
				{
					$user->setUser($key,$value);
				}
				$check=$user->update_User_mdl($user);
			}
			header("location:http://localhost/gestionstock/view/gestion_access.php");
			return $check;
			//echo "<pre>";print_r($user);exit;
		}
		
		//display all users
		
		public function get_All_users()
		{
			$user=new User_mdl();
			$all_users=$user->get_All_users_mdl();
			return $all_users;
		}
		
		//get values for on user
		
		public function get_user_values($idutilisateur)
		{
			$user=new User_mdl();
			$user_values=$user->get_user_values_mdl($idutilisateur);
			return $user_values;
		}
		
		//Delete User
		
		public function delete_user($idutilisateur)
		{
			$user=new User_mdl();
			$user->delete_user_mdl($idutilisateur);
			return $user_values;
		}
    }
?>