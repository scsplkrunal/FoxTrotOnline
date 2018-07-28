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
			<div class="pt-3 pb-2 mb-2 border-bottom">
				<h2>
					<?php echo ucfirst(basename(__FILE__, '.php')) ?>
				</h2>
			</div>
			<div class="row">
				<form class="col-md-3">
					<label class="h6">Available Statements</label><br>
					<select id="statements_select" class="form-control" name="statements_select">
						<option value="none">Choose a PDF from the list</option>
						<?php
						echo statement::statements_list('company_abc/data');
						?>
					</select>
					<div style="margin-top: 20px;">
						<a class="statement_toolbar" href="none" download><button class="btn btn-sm btn-outline-secondary" type="button" disabled>Download</button></a>
						<a class="statement_toolbar" href="none" target="_blank"><button class="btn btn-sm btn-outline-secondary" type="button" disabled>Open</button></a>
					</div>
				</form>


				<object id="statement_pdf_object" class="col-md-9" data="none" type="application/pdf" height="450">
					<!--For wider browser compatibility-->
					<!--					<iframe class="col-md-9" data="data/hello_world.pdf?#view=Fit" type="application/pdf" height="450">-->
					<!--					</iframe>-->
				</object>
			</div>
		</main>
	</div>
</div>
<?php echo FOOTER ?>
</body>
</html>