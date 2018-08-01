<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";

if(permrep::is_remembered()){
	header("Location: dashboard.php");
}
?>

<html lang="en">
<head>
	<?php echo HEAD; ?>
	<link href="login_stylesheet.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<div class="card card-container">
		<h4 style="text-align: center;">FoxTrot Online</h4>
		<div class="server_response_div mt-2">
			<div class="alert" role="alert"></div>
		</div>
		<form id="log_in_form" class="form-signin mb-0">
			<!--<span id="reauth-email" class="reauth-email"></span>-->
			<select name="company_name" class="form-control" autofocus>
				<option value="none">Choose a company</option>
				<option value="company_a">company_a</option>
				<option value="company_b">company_b</option>
				<option value="company_c">company_c</option>
			</select>
			<input name="username" type="text" class="form-control" placeholder="Username"
			       autocomplete="username" required>
			<input name="password" type="password" class="form-control" placeholder="Password"
			       autocomplete="current-password" required>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" name="remember_me" class="custom-control-input" id="remember_me_checkbox" checked>
				<label class="custom-control-label" for="remember_me_checkbox">Remember Me</label>
			</div>
			<input name="class" value="permrep" hidden>
			<input name="func" value="log_in" hidden>
			<input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" value="Sign in">
		</form><!-- /form -->
		<a href="#" class="forgot-password" data-toggle="modal" data-target="#forgot_password_modal">
			Forgot Username / Password?
		</a>
		<a href="dashboard.php">GO IN</a>
	</div><!-- /card-container -->
</div><!-- /container -->

<!-- Modal -->
<div class="modal fade" id="forgot_password_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="forgot_password_modal_title">Forgot Username / Password?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="forgot_password_form">
					<div class="server_response_div mt-2">
						<div class="alert" role="alert"></div>
					</div>
					<select name="company_name" class="form-control">
						<option value="none">Choose a company</option>
						<option value="company_a">company_a</option>
						<option value="company_b">company_b</option>
						<option value="company_c">company_c</option>
					</select>
					<input name="email" type="email" class="form-control mb-3" placeholder="Email address"
					       autocomplete="email" autofocus required>
					<div class="text-center">
						<input class="btn btn-lg btn-primary btn-block btn-signin" type="submit"
						       value="Send my password to my E-mail">
					</div>

					<input name="class" value="permrep" hidden>
					<input name="func" value="forgot_password" hidden>
				</form>
			</div>
		</div>
	</div>
</div>

<?php echo FOOTER ?>

</body>
</html>