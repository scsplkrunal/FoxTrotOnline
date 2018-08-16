<?php
session_start();

/**
 * The head tag of each html document.
 */
define('HEAD', '
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>FoxTrot Online</title>

	<!-- JQuery -->
	<script src="lib/jquery-3.2.1.js"></script>

	<!-- Bootstrap core CSS and JS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<!-- ChartJS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

	<!-- Custom CSS and JS -->
	<link href="main_stylesheet.css" rel="stylesheet">
	<script src="main_js.js"></script>
	
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="lib/favicon.ico">
');

define('EXCEPTION_WARNING_CODE', 0);
define('EXCEPTION_DANGER_CODE', 1);
define('PIE_CHART_COLORS_ARRAY', [
	'rgb(38, 70, 83)',
	'rgb(42, 157, 143)',
	'rgb(233, 196, 106)',
	'rgb(244, 162, 97)',
	'rgb(231, 111, 81)',
	'rgb(144, 78, 85)',
	'rgb(191, 180, 143)',
	'rgb(50, 50, 50)'
]);

/**
 * Connect to DB
 * If successful, put connection obj in globals
 * If failed, throw an exception
 * @throws Exception
 */
function db_connect(){

	// Create connection
	//For local connection
	$conn = new mysqli("127.0.0.1:3304", 'root', 'alonba2358', $_SESSION['db_name']);

	//For online connection:
	//	if(isset($_SESSION['db_host'])){
	//		$conn = new mysqli($_SESSION['db_host'], 'jjixgbv9my802728', 'We3b2!12', $_SESSION['db_name']);
	//	}

	// Check connection
	if(!$conn->connect_error){
		$GLOBALS['db_conn'] = $conn;
	} else{
		throw new Exception("Connection failed: {$conn->connect_errno}, {$conn->connect_error}", EXCEPTION_DANGER_CODE);
	}
}

/**
 * Send a query to the DB
 * Return result
 * if failed, throw an exception
 * @param $sql_str
 * @return mysqli_result
 * @throws exception
 */
function db_query($sql_str){

	//Check if query sent successfully
	if($result = $GLOBALS['db_conn']->query($sql_str)){
		return $result;

		//If query failed
	} else{
		throw new Exception("Query failed: {$GLOBALS['db_conn']->errno}, {$GLOBALS['db_conn']->error}", EXCEPTION_DANGER_CODE);
	}
}

/**
 * Gets and array with the company name, and changes the constants db_username, db_pass and db_name to the right values.
 * @param $post
 */
function db_choose($post){
	switch($post['company_name']){
		case 'lifemark':
			$_SESSION['company_name'] = $post['company_name'];
			$_SESSION['db_host']      = 'sql5c40n.carrierzone.com';
			$_SESSION['db_name']      = $post['company_name'].'_jjixgbv9my802728';
			break;
		case 'lafferty':
			$_SESSION['company_name'] = $post['company_name'];
			$_SESSION['db_host']      = 'sql5c40d.carrierzone.com';
			$_SESSION['db_name']      = $post['company_name'].'_jjixgbv9my802728';
			break;
		default:
			if(!isset($_SESSION["permrep_obj"])){
				unset($_SESSION['db_name']);
			}
	}
}

/**
 * An object used to return data from the server to the client.
 * Class json_obj
 */
class json_obj{
	public $status;
	public $data_arr;
	public $error_message;
	public $error_level;
}

function show_top_navigation_bar(){

	$html_return_str = <<<HEREDOC_STRING
	<nav class="navbar-dark d-xs-block d-md-none">
		<button class="navbar-toggler" style="position: fixed; top: 7px; right: 7px; z-index: 2000;" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">

		<a class="navbar-brand col-sm-4 col-md-2 col-xs-1 mr-0" href="dashboard.php" style="padding-top: 7px; padding-bottom: 7px;">
			<img src="lib/logo.png" alt="logo" style="height: 40px; padding: 0;">
			FoxTrot Online
		</a>
	</nav>
HEREDOC_STRING;

	return $html_return_str;
}

/**
 * Gets the current page as an argument, and returns an HTML string with the side navigation bar, showing the current page as active.
 * @param $current_page
 * @return string
 */
function show_sidebar($current_page){
	${$current_page."_active"} = 'active';
	$html_return_str           = '
		<nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link '.$dashboard_active.'" href="dashboard.php">
						'.show_sidebar_icon('home').'
						Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$statements_active.'" href="statements.php">
						'.show_sidebar_icon('paper').'
						Statements
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$activity_active.'" href="activity.php">
						'.show_sidebar_icon('bar_chart').'
						Activity
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$reports_active.'" href="reports.php">
						'.show_sidebar_icon('pie_chart').'
						Graphs & Analytics
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link '.$documents_active.'" href="documents.php">
						'.show_sidebar_icon('document').'
						Documents
					</a>
				</li>
				<li class="nav-item">
						<span id="sign_out_fake_link" class="fake_link nav-link">
							'.show_sidebar_icon('sign_out').'
							Sign out
						</span>
				</li>
			</ul>
		</nav>
';

	return $html_return_str;

}

/**
 * Gets an icon as a parameter and returns the HTML string to output the specific icon
 * The HTML is a SVG tag.
 * @param $icon
 * @return string
 */
function show_sidebar_icon($icon){
	switch($icon){
		case 'home':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
					<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
					<polyline points="9 22 9 12 15 12 15 22"></polyline>
				</svg>';
		case 'paper':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
					<path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
					<polyline points="13 2 13 9 20 9"></polyline>
				</svg>';
		case 'bar_chart':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
							<line x1="18" y1="20" x2="18" y2="10"></line>
							<line x1="12" y1="20" x2="12" y2="4"></line>
							<line x1="6" y1="20" x2="6" y2="14"></line>
						</svg>';
		case 'pie_chart':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
								<path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
								<path d="M22 12A10 10 0 0 0 12 2v10z"></path>
							</svg>';
		case 'document':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
								<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
								<polyline points="14 2 14 8 20 8"></polyline>
								<line x1="16" y1="13" x2="8" y2="13"></line>
								<line x1="16" y1="17" x2="8" y2="17"></line>
								<polyline points="10 9 9 9 8 9"></polyline>
							</svg>';
		case 'envelope':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
							<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
							<polyline points="22,6 12,13 2,6"></polyline>
							</svg>';
		case 'sign_out':
			return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="sidebar_icon">
							<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
							<polyline points="16 17 21 12 16 7"/>
							<line x1="21" y1="12" x2="9" y2="12"/>
							</svg>';
		default:
			return false;
	}
}

class statement{
	public $pdf_name;
	public $pdf_url;
	public $year;
	public $month;
	public $payroll_sequence;
	public $broker_id;
	public $date;

	function __construct($pdf_name = null, $pdf_url = null){
		$this->pdf_name         = $pdf_name;
		$this->pdf_url          = $pdf_url;
		$this->year             = substr($pdf_name, 15, 4);
		$this->month            = date('F', strtotime(substr($pdf_name, 19, 3))); //Replace the 3 letter month with the full month name
		$payroll_sequence_int   = ord(substr($pdf_name, 22, 1)) - ord('A') + 1; //Replace the letter with a number
		$this->payroll_sequence = number_to_ordinal($payroll_sequence_int); //Replace the number with an word
		$this->broker_id        = substr($pdf_name, 23, 5);
		$this->date             = strtotime($this->month.' '.$this->year);
	}

	/**
	 * Gets the directory of the PDFs.
	 * Creates an array of objects of all the files.
	 * Sorts the array from most recent to oldest.
	 * Checks which files the user is authorized to see.
	 * Returns the list of statements as a string representing HTML Options objects.
	 * @param $dir
	 * @return string
	 */
	static function statements_list($dir){
		$files_array = scandir($dir);

		//Remove unnecessary array items.
		unset($files_array[array_search('.', $files_array, true)]);
		unset($files_array[array_search('..', $files_array, true)]);
		$files_array = array_values($files_array);

		foreach($files_array as $file){
			$file_obj_array [] = new statement($file, "{$_SESSION['company_name']}/data/$file");
		}
		$file_obj_array = self::sort_pdf_array_by_date($file_obj_array);

		foreach($file_obj_array as $file_obj){
			if(self::is_authorized($file_obj)){
				$option_content  = "{$file_obj->month} {$file_obj->year} {$file_obj->payroll_sequence} Payroll";
				$html_return_str .= "<option value='{$file_obj->pdf_name}'>$option_content</option>";
			}else{
				unset($file_obj);
			}
		}

		$first_file_url = $_SESSION['first_statement_url'] = $file_obj_array[0]->pdf_url;

		return $html_return_str;
	}

	/**
	 * Echoes a javaScript script that changes the button and pdf object to match the first pdf.
	 * @return string
	 */
	static function statement_buttons_pdf_url_changer(){
		return "<script type='text/javascript'>
						$( '.statement_toolbar' ).attr( 'href', '{$_SESSION['first_statement_url']}' );
						$( '#statement_pdf_object' ).attr( 'data',  '{$_SESSION['first_statement_url']}#view=Fit' );					
					</script>";
	}

	/**
	 * Gets a file object, and returns true/false if the logged in user is authorized to view the file.
	 * @param $file_obj
	 * @return bool
	 */
	static function is_authorized($file_obj){
		if($file_obj->broker_id == $_SESSION['permrep_obj']->permRepID){
			return true;
		} else{
			return false;
		}
	}

	/**
	 * Very not efficient sorting.
	 * Gets an array of PDF names, and bubble sorts from newest to oldest.
	 * @param $file_obj_array
	 * @return array
	 */
	static function sort_pdf_array_by_date($file_obj_array){
		for($j = 0; $j < count($file_obj_array); $j++){
			for($i = 0; $i < count($file_obj_array) - 1; $i++){ //Will run on all items except the last one
				if($file_obj_array[$i]->date < $file_obj_array[$i + 1]->date){
					array_splice($file_obj_array, $i + 2, 0, array($file_obj_array[$i]));
					unset($file_obj_array[$i]);
					$file_obj_array = array_values($file_obj_array);
				}
			}
		}

		return $file_obj_array;
	}

}

class permrep{
	public $permRepID;
	public $rep_no;
	public $clear_no;
	public $fname;
	public $lname;
	public $middle;
	public $suffix;
	public $h_addr;
	public $h_city;
	public $h_state;
	public $h_zip;
	public $m_addr;
	public $m_addr2;
	public $m_city;
	public $m_state;
	public $m_zip;
	public $w_phone;
	public $h_phone;
	public $fax;
	public $soc_sec;
	public $taxid;
	public $emp_date;
	public $crd_no;
	public $term_date;
	public $lp_states;
	public $mut_states;
	public $sec_states;
	public $va_states;
	public $fa_states;
	public $l_states;
	public $ria_states;
	public $branch;
	public $branch_no;
	public $override;
	public $over_rate;
	public $override2;
	public $over2_rate;
	public $override3;
	public $over3_rate;
	public $dob;
	public $paytype;
	public $notes;
	public $equi_acct;
	public $commbasis;
	public $frn_dom;
	public $seccalc;
	public $branch1;
	public $branch2;
	public $branch3;
	public $pay_tot;
	public $gross_tot;
	public $sec_calc;
	public $defer_rate;
	public $defer_amt;
	public $spl_rep;
	public $spl_rate;
	public $spl_rep2;
	public $spl2_rate;
	public $email;
	public $webpswd;
	public $insur;
	public $ria;
	public $cfp;
	public $cfa;
	public $clu;
	public $cpa;
	public $chfa;
	public $sal_no;
	public $username;
	public $accessLevel;
	public $customerID;
	public $lastModifiedDate;
	public $bnd_states;
	public $opt_states;
	public $rep_link;
	public $osjmgr;
	public $osjmgr2;

	function __construct($post = null){
		//escape user input for protection against sql injection
		foreach($post as $key => $value){
			$post[$key] = mysqli_real_escape_string($GLOBALS['db_conn'], $value);
		}
		$sql_str = "SELECT * FROM permrep WHERE BINARY username = '{$post['username_or_email']}' OR email = '{$post['username_or_email']}' LIMIT 1;";
		$result  = db_query($sql_str);
		if($result->num_rows != 0){ //in case there is an existing permrep with this username or email
			while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
				foreach($this as $attr_name => $attr_value){
					$this->$attr_name = $row[$attr_name];
				}
			}
		} else{
			foreach($this as $attr_name => $attr_value){
				$this->$attr_name = $post[$attr_name];
				$this->username   = '';
			}
		}
	}

	/**
	 * Logs in the account
	 * @param      $post
	 * @param bool $is_log_in_from_cookies
	 * @return json_obj
	 * @throws Exception
	 */
	function log_in($post, $is_log_in_from_cookies = false){
		if($this->username == ''){
			throw new Exception("Username or Email doesn't exist", EXCEPTION_WARNING_CODE);
		}

		if(!$is_log_in_from_cookies){
			if($this->webpswd != $post['password']){
				throw new Exception("Password is incorrect", EXCEPTION_WARNING_CODE);
			}
		} else{
			if(md5($this->webpswd) != $post['password']){
				throw new Exception("Password is incorrect", EXCEPTION_WARNING_CODE);
			}
		}

		$_SESSION['permrep_obj'] = $this;

		//Remember me (put cookies on computer)
		if($post['remember_me'] == 'on'){
			setcookie('foxtrot_online_password', md5($this->webpswd), time() + (86400 * 7), "/");
			setcookie('foxtrot_online_username', $this->username, time() + (86400 * 7), "/");
		}

		$json_obj         = new json_obj();
		$json_obj->status = true;

		return $json_obj;
	}

	/**
	 * Check if email exists, if so - send a mail to the user with the password.
	 * @return json_obj
	 * @throws Exception
	 */
	function forgot_password(){
		if($this->username == ''){
			throw new Exception("Email doesn't exist", EXCEPTION_WARNING_CODE);
		}

		//		The message
		$msg = "
		Hi {$this->fname}!\n
		Since you forgot your password or username, we are sending it to you!\n
		Your password is: {$this->webpswd}\n
		Your username is: {$this->username}\n
		Have a good day,\n
		FoxTrot Online system.
		";

		$headers = "From: FoxTrot Online <system@FoxTrotOnline.com>\n";

		//		Send email
		$flag     = mail($this->email, "FoxTrot Online Password and Username Recovery", $msg, $headers);
		$json_obj = new json_obj();
		if($flag){
			$json_obj->status = true;

			return $json_obj;
		} else{
			throw new Exception("The mail wasn't sent. Contact administrator.", EXCEPTION_DANGER_CODE);
		}
	}

	/**
	 * Checks if there are saved cookies with the credentials.
	 * If so - return true.
	 * If not - redirect to log in page.
	 */
	static function is_remembered(){
		if(isset($_COOKIE['foxtrot_online_username']) && isset($_COOKIE['foxtrot_online_password'])){
			$_GET["company_name"] = addslashes(htmlentities($_GET["company_name"]));
			$company_arr          = array('company_name' => $_GET["company_name"]);
			db_choose($company_arr);
			db_connect(); //open DB connection
			$credentials_arr ['username_or_email'] = $_COOKIE['foxtrot_online_username'];
			$credentials_arr ['password']          = $_COOKIE['foxtrot_online_password'];
			$permrep_obj                           = new permrep($credentials_arr);
			$log_in_result                         = $permrep_obj->log_in($credentials_arr, true);
			$GLOBALS['db_conn']->close(); //close DB connection
			if($log_in_result->status == true){
				return true;
			} else{ //in case there was some kind of error logging in
				header("Location: login.php");

				return false;
			}
		}

		return false;
	}
}

/**
 * Gets the chart name as a parameter.
 * Outputs the chart data and labels as javascript variables (arrays) inside a script html tag
 * @param       $chart_name
 * @param array $post
 * @return string
 * @throws exception
 */
function pie_chart_data_and_labels($chart_name, $post = array('time_period' => 'all_dates')){
	switch($chart_name){
		case 'dashboard_pie_chart':
			$sql_str = "SELECT SUM(comm_rec) AS total_commission, trades.inv_type, prodtype.product
					FROM trades
					RIGHT JOIN prodtype ON trades.inv_type = prodtype.inv_type
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID} AND pay_date IS NULL
					GROUP BY inv_type;";
			$result  = db_query($sql_str);
			if($result->num_rows != 0){ //If there is a value returned
				while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
					$pie_chart_data_values [] = $row['total_commission'];
					$pie_chart_labels []      = $row['product'];
				}
			}
			break;
		case 'reports_pie_chart':
			switch($post['time_period']){
				case 'all_dates':
					unset($_SESSION['from_date']);
					unset($_SESSION['to_date']);
					break;
				case 'Year to Date':
					$from_date = strtotime('first day of January '.date('Y'));
					$from_date = date('Y-m-d H:i:s', $from_date);
					$to_date   = date('Y-m-d H:i:s');
					break;
				case  'Month to Date':
					$from_date = strtotime('midnight first day of this month');
					$from_date = date('Y-m-d H:i:s', $from_date);
					$to_date   = date('Y-m-d H:i:s');
					break;
				case  'Previous 12 Months':
					$from_date = strtotime('midnight 12 months ago');
					$from_date = date('Y-m-d H:i:s', $from_date);
					$to_date   = date('Y-m-d H:i:s');
					break;
				case  'Last Year':
					$last_year = date('Y') - 1;
					$from_date = strtotime('midnight first day of January '.$last_year);
					$from_date = date('Y-m-d H:i:s', $from_date);
					$to_date   = strtotime('first day of January '.date('Y'));
					$to_date   = date('Y-m-d H:i:s', $to_date);
					break;
				case  'Last Month':
					$from_date = strtotime('midnight first day of previous month');
					$from_date = date('Y-m-d H:i:s', $from_date);
					$to_date   = strtotime('midnight first day of this month');
					$to_date   = date('Y-m-d H:i:s', $to_date);
					break;
				case  'Custom':
					$from_date = date_format(date_create($post['from_date']), 'Y-m-d H:i:s');
					$to_date   = date_format(date_add(date_create($post['to_date']), date_interval_create_from_date_string("23 hours 59 minutes 59 seconds")), 'Y-m-d H:i:s');
					break;
			}
			if(isset($from_date) && isset($to_date)){
				$_SESSION['from_date'] = $from_date;
				$_SESSION['to_date']   = $to_date;
				$where_clause          = "AND dateTrade > '$from_date' AND dateTrade < '$to_date'";
			}
			$sql_str = "SELECT SUM(rep_comm) AS total_commission, trades.inv_type, prodtype.product
					FROM trades
					RIGHT JOIN prodtype ON trades.inv_type = prodtype.inv_type
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID} $where_clause
					GROUP BY inv_type;";
			$result  = db_query($sql_str);
			if($result->num_rows != 0){ //If there is a value returned
				while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
					$pie_chart_data_values []     = $row['total_commission'];
					$pie_chart_labels []          = $row['product'];
					$table_data [$row['product']] = $row['total_commission'];
				}
			} else{
				throw new Exception("No relevant records were found.", EXCEPTION_WARNING_CODE);
			}

			$post['from_date']  = $from_date;
			$post['to_date']    = $to_date;
			$reports_table_html = reports_table_html($post, $table_data);

			break;
	}

	$pie_chart_data = [
		'datasets' => [
			[
				'data'            => $pie_chart_data_values,
				'backgroundColor' => PIE_CHART_COLORS_ARRAY,
				'borderColor'     => 'rgb(255,255,255)',
				'borderWidth'     => 1
			],
		],
		'labels'   => $pie_chart_labels
	];

	$pie_chart_data = json_encode($pie_chart_data);

	$json_obj                                 = new json_obj();
	$json_obj->data_arr['pie_chart_data']     = $pie_chart_data;
	$json_obj->data_arr['reports_table_html'] = $reports_table_html;
	$json_obj->status                         = true;

	return $json_obj;
}

/**
 * Gets the chart name as a parameter.
 * Outputs the chart data and labels as javascript variables (arrays) inside a script html tag
 * @param $post
 * @return string
 * @throws exception
 */
function line_chart_data_and_labels($post){
	if(isset($_SESSION["from_date"]) && isset($_SESSION["to_date"])){
		$where_clause = "AND dateTrade > '{$_SESSION["from_date"]}' AND dateTrade < '{$_SESSION["to_date"]}'";
	}
	switch($post['time_period']){
		case 'all_dates':
		case 'Year to Date':
		case  'Previous 12 Months':
		case  'Last Year':
			monthly:
			$sql_str      = "SELECT EXTRACT(YEAR_MONTH FROM dateTrade) as 'date_time', SUM(rep_comm) AS total_commission
					FROM trades
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
					$where_clause
					GROUP BY YEAR(dateTrade), MONTH(dateTrade);";
			$flag_monthly = true;
			break;
		case  'Month to Date':
		case  'Last Month':
			daily:
			$sql_str = "SELECT DATE(dateTrade) as date_time, SUM(rep_comm) as total_commission
					FROM trades
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
					$where_clause
					GROUP BY DATE(dateTrade);";
			break;
		case  'Custom':
			$to_date   = DateTime::createFromFormat('Y-m-d', $post['to_date']);
			$from_date = DateTime::createFromFormat('Y-m-d', $post['from_date']);
			$diff      = date_diff($to_date, $from_date);
			if($diff->days > 90){ //check the difference between the dates and refer to the matching sql
				goto monthly;
			} else{
				goto daily;
			}
			break;
		default:
			goto monthly;
			break;
	}

	$result = db_query($sql_str);
	while($row = $result->fetch_assoc()){
		$line_chart_values [] = $row['total_commission'];
		if($flag_monthly){
			$year                 = substr($row['date_time'], 0, 4);
			$month                = substr($row['date_time'], 4, 2);
			$month                = date('M', mktime(0, 0, 0, $month));
			$line_chart_labels [] = "$month-$year";
		} else{
			$line_chart_labels [] = $row['date_time'];
		}
	}

	$line_chart_data = [
		'datasets' => [
			[
				'data'                 => $line_chart_values,
				'lineTension'          => 0,
				'backgroundColor'      => 'transparent',
				'borderColor'          => '#007bff',
				'borderWidth'          => 4,
				'pointBackgroundColor' => '#007bff'
			],
		],
		'labels'   => $line_chart_labels
	];

	$line_chart_data = json_encode($line_chart_data);

	return $line_chart_data;

	//	$line_chart_data   = json_encode([
	//		15339,
	//		21345,
	//		18483,
	//		24003,
	//		23489,
	//		24092,
	//		12034
	//	]);
	//	$line_chart_labels = json_encode([
	//		"Sunday",
	//		"Monday",
	//		"Tuesday",
	//		"Wednesday",
	//		"Thursday",
	//		"Friday",
	//		"Saturday"
	//	]);
	//	$script            = "
	//			<script type='text/javascript'>
	//				var line_chart_data = $line_chart_data;
	//				var line_chart_labels = $line_chart_labels;
	//			</script>
	//			";
	//	echo $script;
}

/**
 * Gets as parameters the charts data and labels
 * Creates the required HTML table as a string.
 * Defines the string as a constant, for later use.
 * @param $post
 * @param $original_table_data
 * @return string
 * @throws exception
 */
function reports_table_html($post, $original_table_data){
	switch($post['time_period']){ //find the Last values
		case 'all_dates':
			break;
		case 'Year to Date':
			$last_from_date = date('Y-m-d H:i:s', strtotime("{$post["from_date"]} -1 year"));
			$last_to_date   = date('Y-m-d H:i:s', strtotime("{$post["to_date"]} -1 year"));
			break;
		case  'Month to Date':
			$last_from_date = date('Y-m-d H:i:s', strtotime("{$post["from_date"]} -1 month"));
			$last_to_date   = date('Y-m-d H:i:s', strtotime("{$post["to_date"]} -1 month"));
			break;
		case  'Previous 12 Months':
			$last_from_date = date('Y-m-d H:i:s', strtotime("{$post["from_date"]} -1 year"));
			$last_to_date   = date('Y-m-d H:i:s', strtotime("{$post["to_date"]} -1 year"));
			break;
		case  'Last Year':
			$last_from_date = date('Y-m-d H:i:s', strtotime("{$post["from_date"]} -1 year"));
			$last_to_date   = date('Y-m-d H:i:s', strtotime("{$post["to_date"]} -1 year"));
			break;
		case  'Last Month':
			$last_from_date = date('Y-m-d H:i:s', strtotime("{$post["from_date"]} -1 month"));
			$last_to_date   = date('Y-m-d H:i:s', strtotime("{$post["to_date"]} -1 month"));
			break;
		case  'Custom':
			break;
	}

	if(isset($last_from_date) && isset($last_to_date)){
		$where_clause = "AND dateTrade > '$last_from_date' AND dateTrade < '$last_to_date'";
		$sql_str      = "SELECT SUM(rep_comm) AS total_commission, trades.inv_type, prodtype.product
					FROM trades
					RIGHT JOIN prodtype ON trades.inv_type = prodtype.inv_type
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID} $where_clause
					GROUP BY inv_type;";
		$result       = db_query($sql_str);
		if($result->num_rows != 0){ //If there is a value returned
			while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
				$last_values [$row['product']] = $row['total_commission'];
			}
		}

		foreach($original_table_data as $product => $original_total_commission){
			$table_data [$product] = array(
				$original_table_data[$product],
				($last_values[$product] == null) ? '-' : $last_values[$product]
				//replace null with -
			);
			unset($last_values[$product]); //remove "used" rows
		}

		if(isset($last_values)){
			foreach($last_values as $last_product => $last_value){
				$table_data[$last_product] = array(
					'-',
					$last_value
				);
			}
		}
	}

	$html_table_string = '
				<div class="row mt-5 mb-5">
				<div class="col-lg-6">
					<table class="main-table table table-hover table-striped table-sm">
						<thead>
						<tr>
							<th>COLOR</th>
							<th>COMMISSION</th>
							<th>TOTAL</th>
							<th>LAST</th>
							<th>DIFFERENCE</th>
						</tr>
						</thead>
						<tbody>';

	$i          = 0;
	$table_data = (isset($table_data)) ? $table_data : $original_table_data;
	foreach($table_data as $product => $values_arr){
		$color = PIE_CHART_COLORS_ARRAY[$i];
		$i++;
		if(isset($last_values)){
			$difference = round((100 * $values_arr[1]) / $values_arr[0], 2);
			if(!is_numeric($difference) || is_nan($difference)){
				$difference = '-';
			}
		}
		if(!is_array($values_arr)){
			$values_arr = array(
				$values_arr,
				'-'
			);
		}
		$html_table_string .= "<tr>
						<td>
							<ul class='graph_legend'>
								<li style='color: $color;'></li>
							</ul>
						</td>
						<td>$product</td>
						<td>{$values_arr[0]}</td>
						<td>{$values_arr[1]}</td>
						<td>$difference</td>
						</tr>";
	}
	//	for($i = 0; $i < sizeof($chart_labels); $i++){
	//		$color = PIE_CHART_COLORS_ARRAY[$i];
	//		if(isset($last_values)){
	//			$difference = $last_values[$i] / $chart_data[$i] * 100;
	//		}
	//		$html_table_string .= "<tr>
	//						<td>
	//							<ul class='graph_legend'>
	//								<li style='color: $color;'></li>
	//							</ul>
	//						</td>
	//						<td>
	//							{$chart_labels[$i]}
	//						</td>
	//						<td>
	//							{$chart_data[$i]}
	//						</td>
	//						<td>
	//							{$last_values[$i]}
	//						</td>
	//						<td>
	//							{$difference}
	//						</td>
	//						";
	//		$html_table_string .= "</tr>";
	//	}
	$html_table_string .= '
						</tbody>
					</table>
				</div>
			</div>';

	return $html_table_string;
}

/**
 * Returns a string representing the total commissions posted.
 */
function dashboard_posted_commissions(){
	$sql_str = "SELECT SUM(comm_rec) AS posted_commission FROM trades WHERE pay_date is NULL AND rep_no = {$_SESSION['permrep_obj']->permRepID} LIMIT 1;";
	$result  = db_query($sql_str);
	if($result->num_rows != 0){ //If there is a value returned
		while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
			$posted_commissions = ($row['posted_commission'] != null) ? $row['posted_commission'] : '0';
		}
	}

	return "Posted Commisions: $posted_commissions\$";
}

/**
 * Gets an integer as a parameter and transform it to a string (1 => first, 2 => second, etc.)
 * @param $num
 * @return string
 */
function number_to_ordinal($num){
	$first_word  = array(
		'eth',
		'First',
		'Second',
		'Third',
		'Fourth',
		'Fifth',
		'Sixth',
		'Seventh',
		'Eighth',
		'Ninth',
		'Tenth',
		'Eleventh',
		'Twelfth',
		'Thirteenth',
		'Fourteenth',
		'Fifteenth',
		'Sixteenth',
		'Seventeenth',
		'Eighteenth',
		'Nineteenth',
		'Twentieth'
	);
	$second_word = array(
		'',
		'',
		'Twenty',
		'Thirty',
		'Forty',
		'Fifty'
	);

	if($num <= 20)
		return $first_word[$num];

	$first_num  = substr($num, -1, 1);
	$second_num = substr($num, -2, 1);

	return $string = str_replace('y-eth', 'ieth', $second_word[$second_num].' '.$first_word[$first_num]);

}

function drill_down_pie_chart($post){
	switch($post["chart_id"]){ //Choose relevant chart and create SQL
		case 'dashboard_pie_chart':
			$sql_str = "SELECT dateTrade, comm_rec, rep_comm
					FROM trades
					RIGHT JOIN prodtype ON trades.inv_type = prodtype.inv_type
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
						AND pay_date IS NULL
						AND product = '{$post["label"]}'
					ORDER BY dateTrade DESC;";
			break;
		case 'reports_pie_chart':
			if(isset($_SESSION["from_date"]) && isset($_SESSION["to_date"])){
				$where_clause = "AND dateTrade > '{$_SESSION["from_date"]}' AND dateTrade < '{$_SESSION["to_date"]}'";
			}
			$sql_str = "SELECT dateTrade, comm_rec, rep_comm
					FROM trades
					RIGHT JOIN prodtype ON trades.inv_type = prodtype.inv_type
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
					$where_clause
					AND product = '{$post["label"]}'
					ORDER BY dateTrade DESC;";
			break;
	}

	//Create html table
	$drill_down_table_html = '<div class="row">
						<div class="col-12">
							<table class="main-table table table-hover table-striped table-sm">
								<thead>
								<tr>';
	$result                = db_query($sql_str); //create headers
	$headers               = $result->fetch_fields();
	foreach($headers as $col_obj){
		switch($col_obj->name){
			case 'dateTrade':
				$header = 'Trade Date';
				break;
			case 'comm_rec':
				$header = 'Gross Amount';
				break;
			case 'rep_comm':
				$header = 'Net Pay';
				break;
		}
		if($header == 'Trade Date'){
			$drill_down_table_html .= "<th>$header</th>";
		}else{
			$drill_down_table_html .= "<th class='text-right'>$header</th>";
		}
	}
	$drill_down_table_html .= '   </tr>
						</thead>
						<tbody>';
	if($result->num_rows != 0){ //If there is a value returned
		while($row = $result->fetch_assoc()){ //Fill up all properties from DB data
			$drill_down_table_html .= "<tr>";
			foreach($row as $column_name => $value){
				if($column_name == 'dateTrade'){
					$value                 = date('m/d/Y', strtotime($value));
					$drill_down_table_html .= "<td>$value</td>";
				} else{
					$value                 = number_format(floatval($value), 2);
					$drill_down_table_html .= "<td class='text-right'>\$$value</td>";
				}
			}
			$drill_down_table_html .= "</tr>";
		}
	}
	$drill_down_table_html .= '</tbody>
					</table>
				</div>
			</div>';

	$json_obj                               = new json_obj();
	$json_obj->data_arr['drill_down_table'] = $drill_down_table_html;
	$json_obj->status                       = true;

	return $json_obj;
}

/**
 * Logs out from the account
 * @return json_obj
 */
function sign_out(){
	setcookie('foxtrot_online_password', md5($_SESSION['permrep_obj']->webpswd), 1, '/');
	setcookie('foxtrot_online_username', $_SESSION['permrep_obj']->username, 1, '/');
	$json_obj                           = new json_obj();
	$json_obj->status                   = true;
	$json_obj->data_arr['company_name'] = $_SESSION['company_name'];
	unset($_SESSION);

	return $json_obj;
}

/**
 * Returns an HTML string for a modal with the logos and a script to show the modal.
 */
function logo_html_modal(){
	$modal_html = '
	<div class="modal fade" id="select_company_modal" tabindex="-1" role="dialog" aria-labelledby="select_company_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="select_company_label">Select a Company</h5>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
	';

	$logos = scandir('lib/logos');
	unset($logos[array_search('.', $logos, true)]);
	unset($logos[array_search('..', $logos, true)]);
	unset($logos[array_search('foxtrot_online.png', $logos, true)]);
	foreach($logos as $logo){
		$company_name = pathinfo($logo, PATHINFO_FILENAME);
		$modal_html   .= "<div class='col-md-4'><a href='login.php?company_name=$company_name'><img class='logo' src='lib/logos/$logo' alt='logo'></a></div>";
	}

	$modal_html .= '
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$( "#select_company_modal" ).modal( \'show\' );
	</script>
	';

	return $modal_html;
}

/**
 * Gets the dates period as a parameter in the $post array.
 * Gets 2 flags, that determine if needed to create boxes or table or both.
 * Returns an HTML string with the table and boxes data inside the json_obj.
 * @param      $post
 * @param bool $create_boxes_flag
 * @param bool $create_table_flag
 * @return json_obj
 * @throws Exception
 */
function activity_update($post, $create_boxes_flag = true, $create_table_flag = true){
	//Activity table:
	if($create_table_flag){
		if($post['from_date'] > $post['to_date']){
			throw new Exception("Start date cannot be after the end date.", EXCEPTION_WARNING_CODE);
		}

		if(isset($post["from_date"]) && isset($post["to_date"]) && $post['all_dates'] != 'on'){
			$where_clause = "AND dateTrade > '{$post['from_date']}' AND dateTrade < '{$post['to_date']}'";
		}

			if($post['from_date'] == $post['to_date'] && isset($post["from_date"]) && isset($post["to_date"]) && isset($post['all_dates'])){
				$post['from_date'] = substr_replace($post['from_date'], ' 00:00:00', 10);
				$post['to_date']   = substr_replace($post['to_date'], ' 23:59:59', 10);
			} else{
				$sql_str = "SELECT dateTrade, clearing, cli_name, invest, cusip_no, net_amt, comm_rec, rep_rate, rep_comm, date_rec, pay_date
					FROM trades
					WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
					$where_clause;";
			}

		$result = db_query($sql_str);
		if($result->num_rows != 0){
			while($row = $result->fetch_assoc()){
				$table_html_return_str .= "<tr>";
				foreach($row as $col => $value){
					switch($col){
						case 'cli_name':
						case 'invest':
						case 'clearing':
						case 'cusip_no':
							$table_html_return_str .= "<td class='text-left'>$value</td>";
							break;
						case 'rep_rate':
							$value                 = number_format(floatval($value), 2);
							$table_html_return_str .= "<td class='text-right'>$value</td>";
							break;
						case 'net_amt':
						case 'comm_rec':
						case 'rep_comm':
							$value                 = number_format(floatval($value), 2);
							$table_html_return_str .= "<td class='text-right'>\$$value</td>";
							break;
						case 'dateTrade':
						case 'date_rec':
						case 'pay_date':
							if($value != null){
								$value                 = date('Y-m-d', strtotime($value));
								$table_html_return_str .= "<td class='text-left'>$value</td>";
							} else{
								$table_html_return_str .= "<td>-</td>";
							}
							break;
						default:
							$table_html_return_str .= "<td>$value</td>";
							break;
					}
				}
				$table_html_return_str .= "</tr>";
			}
		} else{
			throw new Exception("No relevant records were found.", EXCEPTION_WARNING_CODE);
		}
	}

	//Activity Boxes:
	if($create_boxes_flag){

		//Trail Commissions
		$sql_str = "SELECT SUM(comm_rec) as total_commission, rep_no
				FROM trades
				WHERE (source LIKE '%1' OR source LIKE '%2')
				AND rep_no = {$_SESSION["permrep_obj"]->permRepID}
				$where_clause;";
		$result  = db_query($sql_str);
		if($result->num_rows != 0){
			$row               = $result->fetch_assoc();
			$trail_commissions = floatval($row['total_commission']);
		} else{
			$trail_commissions = 0;
		}

		//Clearing Commissions
		$sql_str = "SELECT SUM(comm_rec) as total_commission
				FROM trades
				WHERE (source LIKE '%PE%' OR source LIKE '%NF%' OR source LIKE '%IN%' OR source LIKE '%DN%' OR source LIKE '%FC%' OR source LIKE '%HT%' OR source LIKE '%LG%' OR source LIKE '%PN%' OR source LIKE '%RE%' OR source LIKE '%SW%')
				AND rep_no = {$_SESSION["permrep_obj"]->permRepID}
				$where_clause;";
		$result  = db_query($sql_str);
		if($result->num_rows != 0){
			$row                  = $result->fetch_assoc();
			$clearing_commissions = floatval($row['total_commission']);
		} else{
			$clearing_commissions = 0;
		}

		//Regular_commissions
		$sql_str = "SELECT SUM(comm_rec) as total_commission
				FROM trades
				WHERE rep_no = {$_SESSION["permrep_obj"]->permRepID}
				$where_clause;";
		$result  = db_query($sql_str);
		if($result->num_rows != 0){
			$row                 = $result->fetch_assoc();
			$total_commissions   = floatval($row['total_commission']);
			$regular_commissions = $total_commissions - $clearing_commissions - $trail_commissions;
		} else{
			$regular_commissions = 0;
		}

		$regular_commissions   = number_format($regular_commissions, 2);
		$trail_commissions     = number_format($trail_commissions, 2);
		$clearing_commissions  = number_format($clearing_commissions, 2);
		$boxes_html_return_str = "<div class='col-sm-4'>
							<div class='alert alert-info'>
								<strong>Regular Commissions \$$regular_commissions</strong>
							</div>
						</div>
						<div class='col-sm-4'>
							<div class='alert alert-info'>
								<strong>Trail Commissions \$$trail_commissions</strong>
							</div>
						</div>
						<div class='col-sm-4'>
							<div class='alert alert-info'>
								<strong>Clearing Commissions \$$clearing_commissions</strong>
							</div>
						</div>";
	}

	$json_obj                             = new json_obj();
	$json_obj->data_arr['activity_table'] = $table_html_return_str;
	$json_obj->data_arr['activity_boxes'] = $boxes_html_return_str;
	$json_obj->status                     = true;

	return $json_obj;
}

///**
// * Gets the dates in an array, adn present the corresponding values inside HTML template.
// * @param $post
// * @return json_obj
// */
//function activity_boxes($post){
//
//
//	$json_obj                             = new json_obj();
//	$json_obj->data_arr['activity_boxes'] = $boxes_html_return_str;
//	$json_obj->status                     = true;
//
//	return $json_obj;
//}

/**
 * Updates the reports charts and table
 * @param $post
 * @return string
 * @throws exception
 */
function reports_update($post){
	$json_obj                              = pie_chart_data_and_labels('reports_pie_chart', $post);
	$json_obj->data_arr['line_chart_data'] = line_chart_data_and_labels($post);

	return $json_obj;
}