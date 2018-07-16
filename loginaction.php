<?php
	
		$sql ="SELECT p.rep_no, p.branch_no, p.lname, p.fname, p.lname + ', ' + p.fname AS user_name, isnull(p.accessLevel,1) accessLevel, p.sal_no, isnull(p.rep_link,'') rep_link,
			case when b.branchID is not null then 1 else 0 end as branchMgr
		FROM permrep p
		LEFT JOIN branches b on b.rep_no=p.rep_no
		WHERE p.username = '".$_POST['username']."'
		AND p.webpswd = '".$_POST['webpswd']."'";
		 
$login = mysql_fetch_assoc(mysql_query($sql));
if(mysql_num_rows($sql)>0){
	$_SESSION['validUser'] = 1;
	$_SESSION['username'] = $login['lname'].", ".$login['lname'];
	$_SESSION['rep_no'] = $login['rep_no'];
	$_SESSION['branch_no'] = $login['branch_no'];
	$_SESSION['sal_no'] = $login['sal_no'];
	$_SESSION['branchMgr'] = $login['branchMgr'];
	$_SESSION['rep_link'] = $login['rep_link'];
	setcookie("FoxtrotOnline", $login['user_name']);
	$branches_sql = "SELECT b.branch_no
			  FROM branches b
			  WHERE b.rep_no = '".$_SESSION['rep_no']."'  AND b.customerID = '".$_SESSION['customerID']."'";
	if(mysql_num_rows($branches_sql)){
		include 'getrepno.php';
	}
	else{
		header('location:report_selection.php');
	}
}
else{
	header('location:login.php?error=1');
}


