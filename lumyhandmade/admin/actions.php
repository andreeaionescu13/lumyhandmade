<?php

require_once "../config.php";

global $link;

if ( !isset($_SESSION) ) {
	session_start();
}

if ( !is_logged_in_user_admin() ) {
	header("Location: " . BASE_URL . "/lumyhandmade/index.php");
	exit();
}

if ( isset($_POST['add_customer']) ) {
	$username       = validate_input($_POST['username']);
	$password       = validate_input($_POST['password']);
	$email          = validate_input($_POST['email']);
	$name           = validate_input($_POST['name']);
	$phone_number   = validate_input($_POST['phone_number']);
	$address        = validate_input($_POST['address']);

	if ( !$phone_number )
		$phone_number = null;

	customer_form_input_process($username, $password, $email, $name, $phone_number, $address);

	if ( count($_SESSION['error_msg']) ) {
		header("Location: " . BASE_URL . "/lumyhandmade/admin/users.php#add-user");
		exit();
	}

	$sql = "INSERT INTO `users` (UserName, Password) VALUES (?, ?)";

	if($stmt = mysqli_prepare($link, $sql)) {
		$password = password_hash($password, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "ss", $username, $password);

		if(mysqli_stmt_execute($stmt)){
			$user_id = $link->insert_id;

			$sql = "UPDATE `users` SET UserName = ?, Password = ?, CustomerName = ?, CustomerPhoneNumber = ?, CustomerEmail = ?, CustomerAddress = ? WHERE UserID = ?";

			$stmt = $link->prepare($sql);
			$stmt->bind_param("sssissi", $username, $password, $name, $phone_number, $email, $address, $user_id);
			$stmt->execute();

			header("location: users.php");
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}

		mysqli_stmt_close($stmt);
	}

	$_SESSION['messages'][] = 'User successfully created!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/users.php");
	exit();
}

if ( isset($_POST['edit_customer']) ) {
	$user_id = $_POST['user_id'];

	$username       = validate_input($_POST['username']);
	$password       = validate_input($_POST['password']);
	$email          = validate_input($_POST['email']);
	$name           = validate_input($_POST['name']);
	$phone_number   = validate_input($_POST['phone_number']);
	$address        = validate_input($_POST['address']);

	if ( !$phone_number )
		$phone_number = null;

	customer_form_input_process($username, $password, $email, $name, $phone_number, $address);

	if ( count($_SESSION['error_msg']) ) {
		header("Location: " . BASE_URL . "/lumyhandmade/admin/users.php#edit-user-{$user_id}");
		exit();
	}

	$sql = "UPDATE `users` SET UserName = ?, Password = ?, CustomerName = ?, CustomerPhoneNumber = ?, CustomerEmail = ?, CustomerAddress = ? WHERE UserID = ?";

	if($stmt = mysqli_prepare($link, $sql)) {
		$password = password_hash($password, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "sssissi", $username, $password, $name, $phone_number, $email, $address, $user_id);

		if(mysqli_stmt_execute($stmt)){
			header("location: users.php");
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}

		mysqli_stmt_close($stmt);
	}

	$_SESSION['messages'][] = 'User successfully updated!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/users.php");
	exit();
}

if ( isset($_GET['delete_customer']) ) {
	$user_id = $_GET['id'];

	$sql = "DELETE FROM `customer` where UserID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();

	$sql = "DELETE FROM `users` where UserID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();

	$_SESSION['messages'][] = 'User successfully deleted!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/users.php");
	exit();
}

if ( isset($_POST['add_product']) ) {
	$product_name       = validate_input($_POST['product_name']);
	$description        = validate_input($_POST['description']);
	$price              = validate_input($_POST['price']);
	$manufacturer_id    = validate_input($_POST['manufacturer_id']);

	product_form_input_process($product_name, $description, $price, $manufacturer_id);

	if ( count($_SESSION['error_msg']) ) {
		header("Location: " . BASE_URL . "/lumyhandmade/admin/products.php#add-product");
		exit();
	}

	$file_name = basename($_FILES["product_image"]["name"]);

    $target_dir = BASE_PATH . "/admin/uploads/";
	$target_file = $target_dir . $file_name;
	$is_upload_ok = false;

	echo $target_file;

	if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
		$is_upload_ok = true;
		echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
	} else {
		$is_upload_ok = false;
		echo "Sorry, there was an error uploading your file.";
	}

	if ( !$is_upload_ok ) {
		$file_name = '';
	}

	$productID = time();

//	$sql = "UPDATE `product` SET ProductName = ?, Description = ?, ManufacturerID = ?, Price = ?, Image = ?";
	$sql = "INSERT INTO `product` (ProductID, ProductName, Description, ManufacturerID, Price, Image) VALUES (?, ?, ?, ?, ?, ?)";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("issids", $productID, $product_name,$description, $manufacturer_id, $price, $file_name);
	$stmt->execute();

	$_SESSION['messages'][] = 'Product successfully created!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/products.php");
	exit();
}

if ( isset($_POST['edit_product']) ) {
	$product_id = $_POST['product_id'];

	$product_name       = validate_input($_POST['product_name']);
	$description        = validate_input($_POST['description']);
	$price              = validate_input($_POST['price']);
	$manufacturer_id    = validate_input($_POST['manufacturer_id']);

	product_form_input_process($product_name, $description, $price, $manufacturer_id);

	if ( count($_SESSION['error_msg']) ) {
		header("Location: " . BASE_URL . "/lumyhandmade/admin/products.php#edit-product-{$product_id}");
		exit();
	}

	$file_name = basename($_FILES["product_image"]["name"]);

	$target_dir = BASE_PATH . "/admin/uploads/";
	$target_file = $target_dir . $file_name;
	$is_upload_ok = false;

	if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
		$is_upload_ok = true;
		echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.";
	} else {
		$is_upload_ok = false;
		echo "Sorry, there was an error uploading your file.";
	}

	if ( !$is_upload_ok ) {
		$file_name = '';
	}

	$productID = time();

	$sql = "UPDATE `product` SET ProductName = ?, Description = ?, ManufacturerID = ?, Price = ?, Image = ? WHERE ProductID = ?";
//	$sql = "INSERT INTO `product` (ProductID, ProductName, Description, ManufacturerID, Price, Image) VALUES (?, ?, ?, ?, ?, ?)";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("ssidsi", $product_name, $description, $manufacturer_id, $price, $file_name, $product_id);
	$stmt->execute();

	$_SESSION['messages'][] = 'Product successfully updated!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/products.php");
	exit();
}

if ( isset($_GET['delete_product']) ) {
	$product_id = $_GET['id'];

	$sql = "DELETE FROM `product` where ProductID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $product_id);
	$stmt->execute();

	$_SESSION['messages'][] = 'Product successfully deleted!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/products.php");
	exit();
}

if ( isset($_POST['add_order']) ) {
	$customer_id = $_POST['customer_id'];
	$status = $_POST['status'];
	$products = $_POST['products'];

	$order_total = 0;
	foreach ($products as $product) {
		if ( !$product['product_id'] || !$product['qty'] ) {
			continue;
		}

		$price = get_product_price($product['product_id']);

		$order_total += ($price * $product['qty']);
	}

	$sql = "INSERT INTO `shop_order` (CustomerID, TotalPrice, Status) VALUES (?, ?, ?)";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("ids", $customer_id, $order_total, $status);
	$stmt->execute();

	$order_id = $link->insert_id;

	if ( $order_id ) {
		foreach ($products as $product) {
			if ( !$product['product_id'] || !$product['qty'] ) {
				continue;
			}

			$sql = "INSERT INTO `order_items` (OrderID, ProductID, Quantity) VALUES (?, ?, ?)";

			$stmt = $link->prepare($sql);
			$stmt->bind_param("iii", $order_id, $product['product_id'], $product['qty']);
			$stmt->execute();
		}
	}

	$_SESSION['messages'][] = 'Order successfully created!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/orders.php");
	exit();
}

if ( isset($_POST['edit_order']) ) {
	$order_id = $_POST['order_id'];
	$customer_id = $_POST['customer_id'];
	$status = $_POST['status'];
	$products = $_POST['products'];

	$order_total = 0;
	foreach ($products as $product) {
		if ( !$product['product_id'] || !$product['qty'] ) {
			continue;
		}

		$price = get_product_price($product['product_id']);

		$order_total += ($price * $product['qty']);
	}

	$sql = "UPDATE `shop_order` SET CustomerID = ?, TotalPrice = ?, Status = ? WHERE OrderID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("idsi", $customer_id, $order_total, $status, $order_id);
	$stmt->execute();

	$sql = "DELETE FROM `order_items` WHERE OrderID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();

	foreach ($products as $product) {
		if ( !$product['product_id'] || !$product['qty'] ) {
			continue;
		}

		$sql = "INSERT INTO `order_items` (OrderID, ProductID, Quantity) VALUES (?, ?, ?)";

		$stmt = $link->prepare($sql);
		$stmt->bind_param("iii", $order_id, $product['product_id'], $product['qty']);
		$stmt->execute();
	}

	$_SESSION['messages'][] = 'Order successfully updated!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/orders.php");
	exit();
}

if ( isset($_GET['delete_order']) ) {
	$order_id = $_GET['id'];

	$sql = "DELETE FROM `order_items` where OrderID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $user_id);
	$stmt->execute();

	$sql = "DELETE FROM `shop_order` where OrderID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();

	$_SESSION['messages'][] = 'Order successfully deleted!';

	header("Location: " . BASE_URL . "/lumyhandmade/admin/orders.php");
	exit();
}