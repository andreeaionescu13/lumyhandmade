<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'config.php';
require_once 'inc/helpers.php';

$products = get_products();

?>

<?php require_once 'header.php' ?>

	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Candles</span>
					<h2>Products</h2>
					<p>Scented soy wax candles</p>
					<p>Non-toxic, Vegan friendly, Homemade</p>
				</div>
			</div>

			<div class="row">

				<?php foreach ($products as $product) : ?>

					<div class="col-md-4 text-center animate-box">
						<div class="product">
							<div class="product-grid" style="background-image:url(<?php echo 'admin/uploads/' . $product['Image'] ?>);">
								<div class="inner">
									<p>
										<a href="product.php?id=<?php echo $product['ProductID'] ?>" class="icon"><i class="icon-shopping-cart"></i></a>
										<a href="product.php?id=<?php echo $product['ProductID'] ?>" class="icon"><i class="icon-eye"></i></a>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="product.php?id=<?php echo $product['ProductID'] ?>"><?php echo $product['ProductName'] ?></a></h3>
								<span class="price">&pound<?php echo $product['Price'] ?></span>
							</div>
						</div>
					</div>

				<?php endforeach; ?>

			</div>
		</div>
	</div>

<?php require_once 'footer.php' ?>