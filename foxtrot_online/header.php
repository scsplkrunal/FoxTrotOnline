<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";

if(permrep::is_remembered()){
	if(basename($_SERVER["PHP_SELF"], '.php') == 'login'){ //If page is login
		header("Location: dashboard.php"); //redirect to dashboard
	}
} elseif(!isset($_SESSION['permrep_obj']) && basename($_SERVER["PHP_SELF"], '.php') != 'login'){
	header("Location: login.php"); //redirect to dashboard
}