<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
/*
   * Author: okeny patrick
   * Email: op58692@gmail.com
   * This is a Controller class 
*/

class Database
{
    // Hold an instance of the PDO class 
	private static $_mHandler;
	
	// Private constructor to prevent direct creation of object 
	private function __construct() { }
	
	// Return an initialized database handler 
	private static function GetHandler() {
     // Create a database connection only if one doesn't already exist
	    if (!isset(self::$_mHandler)) { 
	  // Execute code catching potential exceptions 
			  try { 
					self::$_mHandler = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
					// Configure PDO to throw exceptions
				    self::$_mHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  }catch (PDOException $e) { 
			  // Close the database handler and trigger an error
				   self::Close(); 
				   trigger_error($e->getMessage(), E_USER_ERROR);
			   }
		  }
		  return self::$_mHandler;
	 }
	 
	 // Clear the PDO class instance 
	 public static function Close() {
		  self::$_mHandler = null;
	 }

    
    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public static function select_row($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
		try { // Get the database handler 
				 $database_handler = self::GetHandler();
				 $sth = $database_handler->prepare($sql);
				 foreach ($array as $key => $value) {
				  $sth->bindValue("$key", $value);
				 }
				 $sth->execute();
				 $result = $sth->fetch($fetchMode);
				 
		 }catch(PDOException $e) {
			 // Close the database handler and trigger an error 
			     self::Close(); 
			     trigger_error($e->getMessage(), E_USER_ERROR);
		  }
        return $result;
    }
	
	public static function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
		try { // Get the database handler 
				 $database_handler = self::GetHandler();
				 $sth = $database_handler->prepare($sql);
				 foreach ($array as $key => $value) {
				  $sth->bindValue("$key", $value);
				 }
				 $sth->execute();
				 $result = $sth->fetchAll($fetchMode);
				 
		 }catch(PDOException $e) {
			 // Close the database handler and trigger an error 
			     self::Close(); 
			     trigger_error($e->getMessage(), E_USER_ERROR);
		  }
        return $result;
    }
    
	public static function select_one($sql, $array = array(), $fetchMode = PDO::FETCH_NUM)
    {
		try { // Get the database handler 
				 $database_handler = self::GetHandler();
				 $sth = $database_handler->prepare($sql);
				 foreach ($array as $key => $value) {
				  $sth->bindValue("$key", $value);
				 }
				 $sth->execute();
				 $result = $sth->fetch($fetchMode);
				 
		 }catch(PDOException $e) {
			 // Close the database handler and trigger an error 
			     self::Close(); 
			     trigger_error($e->getMessage(), E_USER_ERROR);
		  }
        return $result[0];
    }
	
    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public static function insert($table, $data)
    {   
	   try { // Get the database handler
	          $fieldNames = implode('`, `', array_keys($data));
			  $fieldValues = ':' . implode(', :', array_keys($data));
			  
			  $database_handler = self::GetHandler();
			  $sth = $database_handler->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
			  foreach ($data as $key => $value) {
				 $sth->bindValue(":$key", $value);
			  }
			  $sth->execute();
			  $return = true;
			  
		 }catch(PDOException $e) {
			 // Close the database handler and trigger an error 
			     self::Close(); 
			     trigger_error($e->getMessage(), E_USER_ERROR);
				 $return = false;
		 }
		 return $return;
    }
    
    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public static function update($table, $data, $where)
    {   
	    try { // Get the database handler 
				  $fieldDetails = NULL;
				  foreach($data as $key=> $value) {
					  $fieldDetails .= "`$key`=:$key,";
				  }
				  $fieldDetails = rtrim($fieldDetails, ',');
				  $database_handler = self::GetHandler();
				  $sth = $database_handler->prepare("UPDATE $table SET $fieldDetails WHERE $where");
				  foreach ($data as $key => $value) {
					  $sth->bindValue(":$key", $value);
				  }
				  $sth->execute();
				  $return = true;
			}catch(PDOException $e) { 
			     self::Close(); 
			     trigger_error($e->getMessage(), E_USER_ERROR);
				 $return = false;
		    }
			return $return;
    }
    
    /**
     * delete
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public static function delete($table, $where, $limit = 1)
    {
		try {
			$database_handler = self::GetHandler();
			$database_handler->exec("DELETE FROM $table WHERE $where LIMIT $limit");
			$return = true;
		}catch(PDOException $e) { 
		    self::Close(); 
		    trigger_error($e->getMessage(), E_USER_ERROR);
		    $return = false;
		}
		return $return;
    }
	
	public static function delete_all($table, $where)
    {
		try {
			$database_handler = self::GetHandler();
			$database_handler->exec("DELETE FROM $table WHERE $where");
			$return = true;
		}catch(PDOException $e) { 
		    self::Close(); 
		    trigger_error($e->getMessage(), E_USER_ERROR);
		    $return = false;
		}
		return $return;
    }
    
}