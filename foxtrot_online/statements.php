<?php
session_start();
require_once "backstage.php";
require_once "html_fragments.php";
?>

<html lang="en">
<head>
	<?php
	echo HEAD;
	?>
</head>

<body>
<!--Top Navigation Bar-->
<?php echo show_top_navigation_bar(); ?>

<!--Content-->
<div class="container-fluid">
	<div class="row">
		<!--Sidebar-->
		<?php echo show_sidebar(basename(__FILE__, '.php')); ?>

		<!--Main Content-->
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h2>
					<?php echo ucfirst(basename(__FILE__, '.php')) ?>
				</h2>
			</div>
			<div class="row">
				<form class="col-md-3">
					<label class="h6">Available Statements</label><br>
					<select name="pdfs">
						<option value="1">23/07/2018</option>
						<option value="3">24/07/2018</option>
						<option value="3">35/08/2019</option>
						<option value="4">49/15/2112</option>
					</select>
<!--					<div class="btn-toolbar" style="margin-top:20px">-->
<!--						<div class="btn-group">-->
<!--							<button class="btn btn-sm btn-outline-secondary" type="button">Save</button>-->
<!--							<button class="btn btn-sm btn-outline-secondary" type="button">Print</button>-->
<!--						</div>-->
<!--					</div>-->
				</form>
				<object class="col-md-9" data="data/hello_world.pdf?#zoom=40" type="application/pdf" height="470">
					<!--For wider browser compatibility-->
					<embed src="data/hello_world.pdf?#zoom=40" type="application/pdf" height="470">
						<p>A problem occurred trying to show you a preview of the PDF.</p>
					</embed>
				</object>
			</div>
		</main>
	</div>
</div>

</body>
</html>