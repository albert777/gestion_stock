<?php
   class Dao
   {
   	public function generateInsertQuery($array_values,$table)
   	{
   		//echo "<pre>";print_r($array_values);exit;
   		$i=1;
   		$sql="INSERT INTO ".$table."(";
		foreach ($array_values as $arrays) {
			if($i<sizeof($array_values))
			{
				foreach ($arrays as $key => $value) {
					$sql.="".$key.",";
				}
			}
			else
			{
				foreach ($arrays as $key => $value) 
				{
					$sql.="".$key."";
				}
			}
		$i++;	
		}
		$i=1;
		$sql.=") VALUES(";
		foreach ($array_values as $arrays) {
			if($i<sizeof($array_values))
			{
				foreach ($arrays as $key => $value) {
					$sql.="'".$value."',";
				}
			}
			else
			{
				foreach ($arrays as $key => $value) {
					$sql.="'".$value."'";
				}
			}
		$i++;	
		}
	    $sql.=")";
		return $sql;
   	}
	
	public function generateSelectQuery($table,$order_by,$where_values=null,$select_values=null)
	{
		$sql="SELECT ";
		if(!isset($select_values))
		{
			$sql.="* ";
		}
		else
		{
			$i=1;
			foreach ($select_values as $key => $value) 
			{	if($i<sizeof())
					$sql.="".$value.",";
				else
					$sql.="".$value."";
			}
		}
		$sql.="FROM ".$table."";
		if(isset($where_values))
		{
			$sql.=" WHERE ";
			$i=1;
			foreach ($where_values as $key => $value) 
			{
				if($i<sizeof($where_values))
					$sql.=$key."="."".$value.",";
				else
					$sql.=$key."="."".$value."";	
			}
		}
		if(isset($order_by))
		{
			$sql.=" ORDER BY ";
			foreach ($order_by as $key => $value) 
			{
				
				$i=1;
				foreach ($value as $val) 
				{
					if($i<sizeof($val))
						$sql.=$val.",";
					else
						$sql.=$val."";
				}
				$sql.=" ".$key." ";
			}
		}
		return $sql;
	}
	
	public function generateUpdateQuery($user_values,$table,$where)
	{
		$sql="UPDATE ".$table." SET ";
		$i=1;
		foreach ($user_values as $key => $val) 
		{
			if($i<sizeof($user_values))
			{
				foreach ($val as $key => $value) {
					if($key=="password")
						$sql.=$key."='".md5($value)."',";
					else 
						$sql.=$key."='".$value."',";
				}
				
			}
			else
			{
				foreach ($val as $key => $value) {
					if($key=="password")
						$sql.=$key."='".md5($value)."'";
					else 
						$sql.=$key."='".$value."'";
				}
			}
			$i++;	
		}
		$sql.=" WHERE ";
		$i=1;
		foreach ($where as $key => $val) 
		{
			if($i<sizeof($where))
			{
				$sql.=$key."='".$val."',";
			}
			else
			{
				$sql.=$key."='".$val."'";
			}
			$i++;
		}
		return $sql;
	}
	
	function generatedeleteQuery($table,$where_array)
	{
		$sql="DELETE FROM ".$table." WHERE ";
		$i=1;
		foreach ($where_array as $key => $val) 
		{
			if($i<sizeof($where_array))
			{
				$sql.=$key."='".$val."',";
			}
			else
			{
				$sql.=$key."='".$val."'";
			}
			$i++;
		}
		return $sql;
	}
   }
