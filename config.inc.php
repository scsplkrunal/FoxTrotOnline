<?php
if( !isset($_SESSION['initialized']) ||  !isset($_SESSION['webpath'])){
	$_SESSION['initialized'] = 1;
	$_SESSION['validUser'] = 0;
	$_SESSION['customerID'] = 0;
	$_SESSION['webpath'] = 'DEMO';
	$linkID = mysql_connect("localhost","root", "") or exit("Could not connect");
	mysql_select_db ("foxtrotonline",$linkID);
	$customer_sql ="select customerID, customerName, lastImportDate, logoFile, homeURL, accessPhone, webpath
	from customers
	where webpath = '".$_SESSION['webpath']."'";
	$customer = mysql_fetch_assoc(mysql_query($customer_sql));
	$_SESSION['customerID'] = $customer['customerID'];
	$_SESSION['webpath'] = $customer['webpath'];
	
	$linkID = mysql_connect("localhost","root", "") or exit("Could not connect");
	mysql_select_db ("foxtrotonline_".$customer['webpath'],$linkID);
}
define("defaultWebpath", '');
define("rootFolder", '/'.defaultWebpath);
define("systemPath", '');
define("curWebpath", '');
define("forgotPWMaxAttempts", 3);

?>
			