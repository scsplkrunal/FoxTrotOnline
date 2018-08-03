<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";

//Check if cookies are in use for log in
if(permrep::is_remembered()){
	if(basename($_SERVER["PHP_SELF"], '.php') == 'login'){ //If page is login
		header("Location: dashboard.php"); //redirect to dashboard
	}
} elseif(!isset($_SESSION['permrep_obj']) && basename($_SERVER["PHP_SELF"], '.php') != 'login'){
	header("Location: login.php"); //redirect to dashboard
}

//Security
$_GET["company_name"] = addslashes(htmlentities($_GET["company_name"]));

//Choose DB
if(!isset($_SESSION['db_details']) || ($_SESSION['db_details']['db_name'] != $_GET["company_name"])){
	db_choose($_GET);
}

echo "
<script>
window.company_name = '{$_SESSION['company_name']}';
</script>
";