<?php
	include_once (dirname(__DIR__)."/model/role_mdl.php");
    class Role_ctl
    {
		//add role
		public function addRole($role_values)
		{
			$role=new Role_mdl();
			if(isset($role_values['idrole']) && $role_values['idrole']==0)
			{
				foreach ($role_values as $key => $value) 
				{
					$role->setRole($key,$value);
				}
				$check=$role->addRole_mdl($role);
			}
			else
			{	
				foreach ($role_values as $key => $value) 
				{
					$role->setRole($key,$value);
				}
				$check=$role->update_Role_mdl($role);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_role.php");
			return $check;
			//echo "<pre>";print_r($role);exit;
		}
		
		//display all roles
		
		public function get_All_roles()
		{
			$role=new Role_mdl();
			$all_roles=$role->get_All_roles_mdl();
			return $all_roles;
		}
		
		//get values for on role
		
		public function get_role_values($idrole)
		{
			$role=new Role_mdl();
			$role_values=$role->get_role_values_mdl($idrole);
			return $role_values;
		}
		
		//Delete role
		
		public function delete_role($idrole)
		{
			$role=new Role_mdl();
			$role->delete_role_mdl($idrole);
			return $role_values;
		}
    }
?>