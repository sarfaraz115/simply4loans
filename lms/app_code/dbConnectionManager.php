<?php
date_default_timezone_set("Asia/Kolkata");
 class dbConnection
 {
			//var $dbDetails;
		var $dbLink;
	function __construct()
	{
			$this->dbDetails['_host']="localhost";
			 $this->dbDetails['_userName']="simply4l_loans";
			 $this->dbDetails['_password']="rawluv!@#123";
			 $this->dbDetails['_database']="simply4l_contaosa";
	}
	function connect()
	 {
		$this->dbLink=mysql_connect($this->dbDetails['_host'],$this->dbDetails['_userName'],$this->dbDetails['_password']) or die("Connection Error".mysql_error());
		mysql_select_db($this->dbDetails['_database'],$this->dbLink)or die(mysql_error());
		//print_r($this->dbLink);
	 }
	 function close()
	 {
			mysql_close($this->dbLink);
	  }
 }
?>