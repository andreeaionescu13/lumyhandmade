<?php

session_start();

require_once 'config.php';
require_once 'inc/helpers.php';

$product_id = $_GET['id'];

$product = get_product($product_id);

if ( isset($_GET['action']) && $_GET['action'] == 'add_to_cart' ) {
	$product_id = $_GET['id'];

	$is_product_added = false;

	if ( $_SESSION['cart']['items'] ) {
		foreach ($_SESSION['cart']['items'] as $index => $item) {
			if ( $item['product_id'] == $product_id ) {
				$_SESSION['cart']['items'][$index]['qty']++;

				$is_product_added = true;
			}
		}
	}

	if ( !$is_product_added) {
		$_SESSION['cart']['items'][] = [
			'product_id' => $product_id,
			'price' => $product['Price'],
			'qty' => 1
		];
	}

	$total = 0;
	foreach ($_SESSION['cart']['items'] as $item) {
		$total += $item['price'] * $item['qty'];
	}

	$_SESSION['cart']['total'] = $total;

	$_SESSION['messages'][] = 'Product successfully added to cart!';

	header("Location: " . BASE_URL . "/lumyhandmade/product.php?id={$product_id}");
	exit();
}

if ( isset($_GET['action']) && $_GET['action'] = 'checkout' ) {
	global $link;

	if ( !is_user_logged_in() ) {
		header("Location: " . BASE_URL . "/lumyhandmade/login.php");
		exit();
	}

	$customer_id = get_logged_in_user_id();
	$status = 'pending';
	$order_total = $_SESSION['cart']['total'];
	$order_id = null;

	$sql = "INSERT INTO `shop_order` (CustomerID, TotalPrice, Status) VALUES (?, ?, ?)";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("ids", $customer_id, $order_total, $status);
	$stmt->execute();

	$order_id = $link->insert_id;

	if ( $order_id ) {
		foreach ($_SESSION['cart']['items'] as $index => $item) {
			if ( !$item['product_id'] || !$item['qty'] ) {
				continue;
			}

			$sql = "INSERT INTO `order_items` (OrderID, ProductID, Quantity) VALUES (?, ?, ?)";

			$stmt = $link->prepare($sql);
			$stmt->bind_param("iii", $order_id, $item['product_id'], $item['qty']);
			$stmt->execute();
		}
	}

	$_SESSION['cart'] = [];

	$_SESSION['messages'][] = 'Order #' . $order_id . ' successfully registered!';

	header("Location: " . BASE_URL . "/lumyhandmade/shop.php");
	exit();
}

?>