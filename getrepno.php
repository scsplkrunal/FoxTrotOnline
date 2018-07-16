<?php include "header.inc.php"?>
	
<!-- BEGIN Border Table -->
<TABLE WIDTH="600" CELLSPACING="0" CELLPADDING="0" BORDER="0" ALIGN="CENTER">

<TR>
<TD WIDTH="50">&nbsp;</TD>
<TD BGCOLOR="#000000" WIDTH="500">

	<?php
    $tablewidth 	= 500;
	$colspan		= 3;
	$colwidth		= array();
	$colwidth[1]	= 400;
	$colwidth[2]	= 10;
	$colwidth[3]	= $tablewidth - $colwidth[1] - $colwidth[2];
	$inputLong		= 20;
	?>
	<TABLE WIDTH="500" CELLSPACING="1" CELLPADDING="0" BORDER="0">
	<CFOUTPUT>
	
	<TR>
	<TH BGCOLOR="#000099" WIDTH="484"><FONT COLOR="#FFFFFF" FACE="Arial, Helvetica, Sans Serif" SIZE="-1">Branch\OSJ Manager - Rep Selection</FONT></TH>
	<TH BGCOLOR="#000099"><A HREF="login.php"><IMG SRC="images/close.bmp" WIDTH="16" HEIGHT="15" BORDER="0" ALT="Logout"></A></TH>
	</TR>
	
	<TR>
	<TD ALIGN="CENTER" BGCOLOR="#CCCCCC" WIDTH="500" COLSPAN="2">
	<FONT FACE="Arial, Helvetica, Sans Serif" SIZE="-1">
	<FONT SIZE="-5"><BR></FONT>
	<B>LOGIN AS REP</B><BR>
	<FONT SIZE="-5"><BR></FONT>
	
	<!-- BEGIN FORM Table -->
	<TABLE WIDTH="350" CELLSPACING="0" CELLPADDING="0" BORDER="0">
	<FORM NAME="getrepno" ACTION="loginaction2.cfm" METHOD="POST">
	

	
	<?php
	$sql = "
		SELECT rep_no, 
		       sort =
			    CASE 
			      WHEN p.rep_no = #Session.rep_no# THEN 0
			      ELSE 1
			    END,
               rep_name = 
                 CASE WHEN fname IS NULL THEN RTRIM(lname) 
                      WHEN lname IS NULL THEN RTRIM(fname)
                      ELSE RTRIM(lname) + ', ' + fname 
                 END
 		FROM permrep p
		WHERE (p.rep_no = '".$_SESSION['rep_no']."'
		       OR p.branch_no IN (SELECT branch_no FROM branches b WHERE b.rep_no = '".$_SESSION['rep_no']."' AND b.customerID = '".$_SESSION['customerID']."'
		  AND p.customerID = '".$_SESSION['customerID']."'
		ORDER BY sort, rep_name, rep_no";
		$qBrokers_sql = mysql_query($sql);
	?>
	
	<TR>
	<TD ALIGN="RIGHT" WIDTH="<?=colwidth[1]?>"><FONT FACE="Arial, Helvetica, Sans Serif" SIZE="-1"><B>Broker:</B></FONT></TD>
	<TD WIDTH="<?=colwidth[2]?>">&nbsp;</TD>
	<TD WIDTH="<?=colwidth[3]?>">
	<FONT FACE="Arial, Helvetica, Sans Serif" SIZE="-1">

	<SELECT name="Brokers">
	<? while($qBrokers = mysql_fetch_assoc(mysql_query($sql))){?>
		<OPTION value="<?=$qBrokers['rep_name']?> ....<?=$qBrokers['rep_no']?>"><?=$qBrokers['rep_name']?> ....<?=$qBrokers['rep_no']?>
	<? }?>
	</SELECT>
	

	<TR>
	<TD ALIGN="CENTER" COLSPAN="3" WIDTH="500">
	<FONT SIZE="-5"><BR></FONT>
	<FONT FACE="Arial, Helvetica, Sans Serif" SIZE="-1">
	<INPUT TYPE="SUBMIT" NAME="Operation" VALUE="Login as Selected Rep">	
	</FONT>
	</TD>
	</TD>
	</TR>	

	</FORM>	
		
	</TABLE>
	<!-- END FORM Table -->	
		
	<FONT SIZE="-5"><BR></FONT>		
	</FONT>
	</TD>
	</TR>
	
	</TABLE>
	<!-- END WINDOW Table -->
</TD>
<TD WIDTH="50">&nbsp;</TD>
</TR>

<TR>
<TD COLSPAN="3" WIDTH="500"><BR></TD>
</TR>

</TABLE>
<!-- END BORDER Table -->

<?php include 'footer.inc.php'?>
