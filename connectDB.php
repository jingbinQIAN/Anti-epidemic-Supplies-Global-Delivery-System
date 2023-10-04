<?php
	$servername="localhost";
	$username="2030026117";
	$password="2030026117";
	$db="2030026117";

	//create connection
	$conn= new mysqli($servername,$username,$password,$db);
	
	//check connection
	if ($conn->connect_error){
		die("connection failed: ".$conn->connect_error);
	}
	return ($conn);
?>
