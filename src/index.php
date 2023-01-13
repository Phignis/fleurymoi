<?php
	require_once("./config/config.php"); // get all global variables
	require_once("./programmation/menu.php");
	require_once("./database/dataBase.php");
	
	/* 
	 * uncomment if you don't want to show warning anymore
	 * usefull for bdd connexion when bad credentials are given
	 * 
	 */
	// error_reporting(E_ALL ^ E_WARNING);
	
	menu();
?>
