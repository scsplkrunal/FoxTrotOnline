<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";

if(permrep::is_remembered()){
	if(basename($_SERVER["PHP_SELF"], '.php') == 'login'){ //If URL page is login
		header("Location: dashboard.php"); //redirect to dashboard
	}
}else{
	if(basename($_SERVER["PHP_SELF"], '.php') != 'login'){
		header("Location: login.php");
	}
}