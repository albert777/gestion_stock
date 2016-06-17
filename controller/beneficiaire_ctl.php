<?php
	include_once (dirname(__DIR__)."/model/beneficiaire_mdl.php");
    class Beneficiaire_ctl
    {
		//add user
		public function addBeneficiaire($beneficiaire_values)
		{
			$beneficiaire=new Beneficiaire_mdl();
			if(isset($beneficiaire_values['idbeneficiaire']) && $beneficiaire_values['idbeneficiaire']==0)
			{
				foreach ($beneficiaire_values as $key => $value) 
				{
					$beneficiaire->setBeneficiaire($key,$value);
				}
				$check=$beneficiaire->addBeneficiaire_mdl($beneficiaire);
			}
			else
			{	
				foreach ($beneficiaire_values as $key => $value) 
				{
					$beneficiaire->setBeneficiaire($key,$value);
				}
				$check=$beneficiaire->update_Beneficiaire_mdl($beneficiaire);
			}
			header("location:http://localhost/gestionstock/view/gestion_access_beneficiaire.php");
			return $check;
			//echo "<pre>";print_r($user);exit;
		}
		
		//display all users
		
		public function get_All_beneficiaires()
		{
			$beneficiaire=new Beneficiaire_mdl();
			$all_beneficiaires=$beneficiaire->get_All_beneficiaires_mdl();
			return $all_beneficiaires;
		}
		
		//get values for on user
		
		public function get_beneficiaire_values($idbeneficiaire)
		{
			$beneficiaire=new Beneficiaire_mdl();
			$beneficiaire_values=$beneficiaire->get_beneficiaire_values_mdl($idbeneficiaire);
			return $beneficiaire_values;
		}
		
		//Delete User
		
		public function delete_beneficiaire($idbeneficiaire)
		{
			$beneficiaire=new Beneficiaire_mdl();
			$beneficiaire->delete_beneficiaire_mdl($idbeneficiaire);
			return $beneficiaire_values;
		}
    }
?>