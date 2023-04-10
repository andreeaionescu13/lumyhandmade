<?php

require_once 'config.php';
require_once 'inc/helpers.php';

if ( !isset($_SESSION) ) {
	session_start();
}

//$_SESSION['cart'] = [];

$cart_items_count = 0;
if ( isset($_SESSION['cart']['items']) ) {
	foreach ($_SESSION['cart']['items'] as $item) {
		$cart_items_count += $item['qty'];
	}
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lulmy Handmade</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="gettemplates.co" />

	<!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FreeHTML5.co

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet"> -->

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<div class="fh5co-loader"></div>

<div id="page">
	<?php if ( isset($_SESSION['messages']) ) : ?>
	<div class="container" style="text-align: center;
    background: #8bc34a;
    color: #fff;
    line-height: 40px;"><?php echo $_SESSION['messages'][0] ?></div>
	<?php unset($_SESSION['messages']); endif; ?>

	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-2">
					<div id="fh5co-logo"><a href="index.php">Lumy Handmade</a></div>
				</div>
				<div class="col-md-6 col-xs-6 text-center menu-1">
					<ul>
						<li><a href="shop.php">Products</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="services.php">Services</a></li>
						<li><a href="contact.php">Contact</a></li>
						<?php if ( !is_user_logged_in() ) : ?>
							<li class="has-dropdown">
								<a href="login.php">Login</a>
								<ul class="dropdown">
									<li><a href="login.php">Login</a></li>
									<li><a href="register.php">Register</a>
								</ul>
							</li>
						<?php else : ?>
							<li><a href="logout.php">Logout</a></li>
						<?php endif; ?>
				</div>
				<div class="col-md-3 col-xs-4 text-right hidden-xs menu-2">
					<ul>
						<li class="search">
							<div class="input-group">
								<input type="text" placeholder="Search..">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button"><i class="icon-search"></i></button>
								  </span>
							</div>
						</li>
						<li class="shopping-cart"><a href="#" class="cart"><span><small><?php echo $cart_items_count ?></small><i class="icon-shopping-cart"></i></span></a></li>
						<div id="cart-info" class="nav-info cart-info">
							<span class="cart-info__icon"><i class="fas fa-shopping-cart"></i></span>
						</div>

						<section class="cart hidden" id="cart">
							<h1 class="section-header">CART</h1>

							<?php if ( isset($_SESSION['cart']['items']) && !empty($_SESSION['cart']['items']) ) : ?>

								<table>
									<thead>
									<td>ITEM</td>
									<td>PRICE</td>
									<td>QUANTITY</td>
									</thead>

									<tbody>
									<?php foreach ($_SESSION['cart']['items'] as $item) :
										$cart_product = get_product($item['product_id']);
										?>
										<tr>
											<td><?php echo $cart_product['ProductName'] ?></td>
											<td>$<?php echo $item['price'] ?></td>
											<td class="quantity"><?php echo $item['qty'] ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>

									<tfoot>
									<tr>
										<td colspan="3">
											<div class="total-section">
												<strong>Total:</strong> $<?php echo $_SESSION['cart']['total'] ?>
											</div>
										</td>
									</tr>

									<tr>
										<td colspan="3">
											<a href="product.php?action=checkout" class="btn btn-primary btn-purchase">PURCHASE</a>
										</td>
									</tr>
									</tfoot>
								</table>

							<?php else : ?>

								<table>
									<tr><td>Cart is empty!</td></tr>
								</table>

							<?php endif; ?>
						</section>
					</ul>
				</div>
			</div>

		</div>
	</nav>