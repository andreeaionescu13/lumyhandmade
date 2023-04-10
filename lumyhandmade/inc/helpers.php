<?php

function get_users() {
	global $link;

	$users = [];

	$sql = "SELECT * FROM `users`";

	$stmt = $link->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

	$result_i = 0;
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$users[$result_i][$fields[$index]->name] = $column;
		}

		$result_i++;
	}

	return $users;
}

function get_products() {
	global $link;

	$products = [];

	$sql = "SELECT * FROM `product`";

	$stmt = $link->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

	$result_i = 0;
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$products[$result_i][$fields[$index]->name] = $column;
		}

		$result_i++;
	}

	return $products;
}

function get_product($id) {
	global $link;

	$sql = "SELECT * FROM `product` WHERE ProductID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$product = [];

	if ( $row = $result->fetch_array(MYSQLI_NUM) ) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$product[$fields[$index]->name] = $column;
		}

		return $product;
	}

	return false;
}

function get_orders() {
	global $link;

	$orders = [];

	$sql = "SELECT * FROM `shop_order`";

	$stmt = $link->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();

	$result_i = 0;
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$orders[$result_i][$fields[$index]->name] = $column;
		}

		$result_i++;
	}

	return $orders;
}

function get_order_items($order_id) {
	global $link;

	$items = [];

	$sql = "SELECT * FROM `order_items` WHERE OrderID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $order_id);
	$stmt->execute();
	$result = $stmt->get_result();

	$result_i = 0;
	while ($row = $result->fetch_array(MYSQLI_NUM)) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$items[$result_i][$fields[$index]->name] = $column;
		}

		$result_i++;
	}

	return $items;
}

function get_product_price($product_id) {
	global $link;

	$sql = "SELECT Price FROM `product` WHERE ProductID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $product_id);
	$stmt->execute();
	$result = $stmt->get_result();

	if ( $row = $result->fetch_array(MYSQLI_NUM) ) {
		return $row[0];
	}

	return false;
}

function get_customer_by_id($customer_id) {
	global $link;

	$sql = "SELECT * FROM `customer` WHERE UserID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $customer_id);
	$stmt->execute();
	$result = $stmt->get_result();

	$customer = [];

	if ( $row = $result->fetch_array(MYSQLI_NUM) ) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$customer[$fields[$index]->name] = $column;
		}

		return $customer;
	}

	return false;
}

function get_user_by_id($id) {
	global $link;

	$sql = "SELECT * FROM `users` WHERE UserID = ?";

	$stmt = $link->prepare($sql);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	$user = [];

	if ( $row = $result->fetch_array(MYSQLI_NUM) ) {
		$fields = $result -> fetch_fields();

		foreach ($row as $index => $column) {
			$user[$fields[$index]->name] = $column;
		}

		return $user;
	}

	return false;
}

function get_upload_dir() {
	return 'C:/Applications/XAMPP/xamppfiles/htdocs/lumyhandmade/admin/uploads/';
}

function get_image_path($image_name) {
	return 'uploads/' . $image_name;
}

function validate_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

function customer_form_input_process($username, $password, $email, $name, $phone_number, $address) {
	$_SESSION['error_msg'] = [];
	$_SESSION['values'] = [];

	// Validate Username
	if ( !empty($username) && preg_match("/\\s/", $username) ) {
		$_SESSION['error_msg']['username'] = 'Username field cannot have white spaces.';
	} elseif ( empty($username) ) {
		$_SESSION['error_msg']['username'] = 'Username field cannot be empty.';
	} else {
		$_SESSION['form_values']['username'] = $username;
	}

	// Validate Password
	if ( !empty($password) && strlen($password) < 6 ) {
		$_SESSION['error_msg']['password'] = 'Password has to be at least 6 characters long.';
	} elseif ( empty($password) ) {
		$_SESSION['error_msg']['password'] = 'Password field cannot be empty.';
	} else {
		$_SESSION['form_values']['password'] = $username;
	}

	// Validate Email
	$pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
	if ( !empty($email) && !preg_match ($pattern, $email) ) {
		$_SESSION['error_msg']['email'] = 'Email does not have a valid format.';
	} elseif ( empty($email) ) {
		$_SESSION['error_msg']['email'] = 'Email field cannot be empty.';
	} else {
		$_SESSION['form_values']['email'] = $email;
	}

	// Validate Name
	if ( !empty($name) && !preg_match ("/^[a-zA-z ]*$/", $name) ) {
		$_SESSION['error_msg']['name'] = "Name can only have alphabets and whitespace characters.";
	} elseif ( empty($name) ) {
		$_SESSION['error_msg']['name'] = 'Name field cannot be empty.';
	} else {
		$_SESSION['form_values']['name'] = $name;
	}

	// Validate Phone Number
	if ( !empty($phone_number) && !preg_match ("/^[0-9]*$/", $phone_number) ) {
		$_SESSION['error_msg']['phone_number'] = "Phone number can only have numeric characters.";
	} else {
		$_SESSION['form_values']['phone_number'] = $phone_number;
	}

	// Save address to session
	if ( !empty($address) ) {
		$_SESSION['form_values']['address'] = $address;
	}
}

function product_form_input_process($product_name, $description, $price, $manufacturer_id) {
	$_SESSION['error_msg'] = [];
	$_SESSION['values'] = [];

	// Validate Product Name
	if ( empty($product_name) ) {
		$_SESSION['error_msg']['product_name'] = 'Product name cannot be empty.';
	} else {
		$_SESSION['form_values']['product_name'] = $product_name;
	}

	// Validate Price
	if ( !empty($price) && !preg_match ("/^[0-9]*$/", $price) ) {
		$_SESSION['error_msg']['price'] = "Price can only have numeric characters.";
	} elseif ( empty($price) ) {
		$_SESSION['error_msg']['price'] = 'Price cannot be empty.';
	} else {
		$_SESSION['form_values']['price'] = $price;
	}

	// Validate Manufacturer ID
	if ( !empty($manufacturer_id) && !preg_match ("/^[0-9]*$/", $manufacturer_id) ) {
		$_SESSION['error_msg']['manufacturer_id'] = "Manufacturer ID can only have numeric characters.";
	} elseif ( empty($manufacturer_id) ) {
		$_SESSION['error_msg']['manufacturer_id'] = 'Manufacturer ID cannot be empty.';
	} else {
		$_SESSION['form_values']['manufacturer_id'] = $manufacturer_id;
	}

	// Save address to session
	if ( !empty($description) ) {
		$_SESSION['form_values']['description'] = $description;
	}
}

function get_logged_in_user_id() {
	if ( !isset($_SESSION['id']) )
		return false;

	return $_SESSION['id'];
}

function is_user_logged_in() {
	if ( !isset($_SESSION['id']) )
		return false;

	return true;
}

function is_logged_in_user_admin() {
	if ( !isset($_SESSION['id']) )
		return false;

	$user = get_user_by_id($_SESSION['id']);

	if ( $user['admin'] === 1 )
		return true;

	return false;
}