<?php

include ('db_con.php');

class Query extends Database
{

	public function select($table,$field,$cond)
	{
		$condition='1=1';
		$condition.=$cond;

		$sql="SELECT $field FROM $table WHERE $cond";

		try
		{
			$stmt 	= $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function custQry($qry)
	{
		try
		{
			$stmt 	= $this->db->prepare($qry);
			$stmt->execute();
			$result	= $stmt->fetchAll();
			return $result;
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function selectAll($table,$cond)
	{
		$condition 		= '1=1';
		$condition 		.= $cond;

		$sql    = "SELECT * FROM $table WHERE $cond";
		// return $sql;
		try
		{
			$stmt   = $this->db->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}
		catch(PDOException $e)
		{
			return die($e->getMessage());
		}
	}

	public function update($table,$set_value,$cond)
	{

		$query		="UPDATE $table SET $set_value WHERE $cond";
		// return $query;

		try
		{
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			return die($e->getMessage());
		}
	}

	public function insert($table,$set_value)
	{
		$query = "INSERT INTO $table set $set_value";
 		// return $query;
		try
		{
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			return die($e->getMessage());
		}
	}

	public function delete($table,$cond)
	{
		$query = "DELETE FROM $table WHERE $cond";
 		// return $query;
		try
		{
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			return die($e->getMessage());
		}
	}

	public function getLastId($table,$field,$field_order = "")
	{
		$field_order = ($field_order == "") ? $field : $field_order;
		$query = "SELECT $field from $table order by $field_order desc limit 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();

		return $result[0][$field];
	}

	public function find($table,$return_field,$field,$value)
	{
		$query = "SELECT $return_field from $table where $field = '$value'";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if(count($result) > 0){
			return $result[0][$return_field];
		}
		return false;
	}
}
