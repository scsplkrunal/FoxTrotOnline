<?php

/**
 * Connect to DB
 * If successful, put connection obj in globals
 * If failed, throw an exception
 * @throws Exception
 */
function db_connect(){

	// Create connection
	$conn = new mysqli("sandbox", "root", "alonba2358", "tag_leagues");

	// Check connection
	if(!$conn->connect_error){
		$GLOBALS['db_conn'] = $conn;
	} else{
		throw new Exception("Connection failed: {$conn->connect_errno}, {$conn->connect_error}");
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
		throw new exception("Query failed: {$GLOBALS['db_conn']->errno}, {$GLOBALS['db_conn']->error}");
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
}

function show_top_navigation_bar(){

	$html_return_str = <<<HEREDOC_STRING
	<nav class="navbar-dark d-xs-block d-md-none">
		<button class="navbar-toggler" style="position: absolute; top: 7px; right: 7px; z-index: 2000;" type="button">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">

		<a class="navbar-brand col-sm-4 col-md-2 col-xs-1 mr-0" href="dashboard.php" style="padding-top: 7px; padding-bottom: 7px;">
			<img src="lib/logo.png" alt="LOGO" style="height: 40px; padding: 0;">
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
			<div class="sidebar-sticky">
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
							Reports
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link '.$documents_active.'" href="documents.php">
							'.show_sidebar_icon('document').'
							Documents
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link '.$messages_active.'" href="messages.php">
							'.show_sidebar_icon('envelope').'
							Messages
						</a>
					</li>
				</ul>
			</div>
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
	}
}