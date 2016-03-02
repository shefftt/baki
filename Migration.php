<?php


/**
* this calss to creat and working with database

* this calss to creat and working with database
*/

include 'database.php';
class Migration extends database
{

	public function mysqli()
	{
		$mysqli =  new mysqli($this->host ,  $this->user, $this->password , $this->DB);
		if ($mysqli) {
			return $mysqli;
		}
		else
			return $mysqli->errno. "  ". $mysqli->error;
	}

	/*
	* this function to creat database 
	*/	
	public function CreateDB($database)
	{
		// database connencton
		$mysqli = $this->mysqli();
		//sql query creat databse name
		$sql    = 'CREATE DATABASE '.$database;
		$retval = $mysqli->query($sql);
		//if database exest
		if ($mysqli->errno == 1007) {

			echo "قاعدة البيانات موجوده مسبقا<br>";
		}
		else
			// if creation database sessefulley
			echo "تم انشاء قاعدة البيانات بنجاح<br>";
	
	}


/**
     *  creat databse table name
     *
     * @access public
     * @return string massege 
     * @param table name
**/
	public function creatTable($TableName)
	{
		
		$Tname = $TableName."_ID";
		// select database name 
		$mysqli = $this->mysqli();
		// SQL query
		$sql = "CREATE TABLE ".$TableName."( `".$Tname."` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`".$Tname."`)) ENGINE = InnoDB";
		// if query cration sessfulley 
		if($mysqli->query($sql))
		{

			echo "تم انشاء الجدول  بنجاح\n";
		}

		// if Table already exists 
		elseif ($mysqli->errno ==  1050) {
			echo "الجدول ".$TableName." موجود مسبقا ";
		}
		// if  database not selected
		elseif ($mysqli->errno  == 1046) {
			echo "اسم قاعدة البيات خاطئ ".$mysqli->errno."  ".$mysqli->error;
			
		}
		//You have an error in your SQL syntax
		elseif ($mysqli->errno == 1064) {
			echo "اسم الجدول خطائى  "; //.$mysqli->errno."  ".$mysqli->error;
		}
		else
		// the sesses massage of table creation 
		echo "خطاء غير متوقع".$mysqli->errno."  ".$mysqli->error;
	}

	/*
	* @var $TableName = name of table 
	* $column = name of column
	* $Type   = type of column varchr intger
	*/

	/**
     *  creat new column 
     *
     * @access public
     * @return string massege 
     * @param table name , $column , type of column
**/
	public function AddColumn($TableName , $column ,$Type)
	{
		$mysqli = $this->mysqli();
		$sql = "ALTER TABLE `".$TableName."` ADD `".$column."` VARCHAR(255) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL";
		// SQL query
		// $sql = "ALTER TABLE `".$tname."` ADD `".$fname."` INT NOT NULL";
		if($mysqli->query($sql))
			echo "تم اضافه الحقل بنجاح";
		
	}

// varchar 255
	public function string($TableName , $column)
	{
		if (isset($column) && isset($TableName)) {

		$mysqli = $this->mysqli();
		$sql = "ALTER TABLE `".$TableName."` ADD `".$column."` VARCHAR(255) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL";
		if($mysqli->query($sql))
		{
		//Table doesn't exist 1146 
		if ($mysqli->errno == 1146) {
			echo "عفوا اسم الجدول غير موجود";
		}
			
		elseif ($mysqli->errno == 0) {
		echo  "تم انشاء الجدول بنجاح ";
		}
		// Duplicate column name 1060  
		else {
			echo  "هذا الحقل موجود مسبقا";
		}
			

			
	      }
	   //     else
			 // echo  "$mysqli->error  $mysqli->errno";
		
		}
		else
			echo "Missing argument 2 for string()";
		
	}

	

	public function select($TableName , $id)
	{
		$mysqli = $this->mysqli();
		//$query = "select * from ".$TableName;
	  $query = "SELECT * FROM `$TableName` WHERE ".$TableName."_ID = $id ";
		// $query = "SELECT username FROM ".$TableName." ORDER BY ".$TableName."_ID ASC";
       if ($result = $mysqli->query($query)) {
       	if ($result->num_rows == 0) {
       		return -1;
       		exit();
       	}
       	else
	    return  $result->fetch_object();
	   
	    }
		
	}

	public function insert($TableName , $array)
	{
		$mysqli      = $this->mysqli();
		$keys        = "";
		$last_keys   = "";
		$values      = "";
		$last_values = "";
		$size        = sizeof($array);
		if (is_array($array)) {
			foreach ($array as $key => $value) {
				 $keys   .= " `".$key."` , ";
				 $values .= " '".$value."' , ";
			} 
		} // end if	
			$array_keys       = str_split($keys); // convert the key to the array 
			$keys_size        = sizeof($array_keys); // convert the key to the array 
			$array_values     = str_split($values);
			$values_size      = sizeof($array_values);
			
	 
	 for ($i= 0; $i < $values_size - 2; $i++) {
		$last_values .= $array_values[$i];
	}

	  for ($i=0; $i < $keys_size - 2; $i++) {
		$last_keys .= $array_keys[$i];
	}
		$query = "INSERT INTO `$TableName` (".$last_keys.") VALUES ( ".$last_values.")";

		if ($result = $mysqli->query($query)) {
	    return true;
	   
	    }
	    else
	    	return fulse;
	}

	public function update($TableName , $id , $array)
	{
		$mysqli   	 = $this->mysqli();
		$values  	 = "";
		$last_values = "";
		
		if (is_array($array)) {
			foreach ($array as $key => $value) {
				$values .= "`$key`  =  '$value' , ";
			}

			$array_val = str_split($values); // the value convert into array to delet last comm ,
			echo $size = sizeof($array_val);
			// confrit the 
	for ($i=0; $i < $size - 2; $i++) {
		$last_values .= $array_val[$i];
	}
			
		}
		$query = "UPDATE `$TableName` SET $last_values WHERE `".$TableName."_ID` = $id"; 
		if ($result = $mysqli->query($query)) {
	   return true;
	   
	    }
       else
		return fulse;
	}


	public function delete($TableName ,$id)
	{
		$mysqli = $this->mysqli();
		$select = "SELECT * FROM `$TableName` WHERE ".$TableName."_ID = $id";
		$query  = "DELETE FROM `$TableName` WHERE `".$TableName."_ID` = $id";
		if ($mysqli->query($select)) {
	   if ($result = $mysqli->query($query))
	   {
	   	return "تم الحزف بنجاح";
	   } 
	   else
	   {
	   	return "we have some problem";
	   }	   
	    }
       else
		return "الجدول غير موجود";
		//Do you really want to execute "DELETE FROM `ahmed`.`nilvalley` WHERE `nilvalley`.`nilvalley_ID` = 1"?
	   // ?
	}
	

}
