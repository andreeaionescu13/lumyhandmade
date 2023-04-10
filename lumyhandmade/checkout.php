<?php

require_once 'config.php';
require_once 'inc/helpers.php';

session_start();

if ( !isset($_SESSION['cart']['items']) || !isset($_SESSION['messages']) ) {
	header("Location: http://localhost:8080/lumyhandmade/shop.php");
	exit();
}

?>

<?php require_once 'header.php' ?>

	<div id="fh5co-product">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<?php echo $_SESSION['messages'][0]; ?>
				</div>
			</div>
		</div>
	</div>

<?php require_once 'footer.php' ?>