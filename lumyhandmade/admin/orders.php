<?php require_once "../inc/helpers.php" ?>
<?php require_once "actions.php" ?>

<?php

$orders = get_orders();
$customers = get_users();
$products = get_products();

$statuses = [
	'active' => 'Active',
	'pending' => 'Pending',
	'canceled' => 'Canceled'
];

?>

<?php require_once "templates/header.php" ?>

<div class="container-xl">
	<div class="row">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo BASE_URL . '/clumyhandmade/admin/orders.php' ?>">Lumy Handmade</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="orders.php">Orders <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="products.php">Products</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="users.php">Users</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>

	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>All Orders</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addOrderModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Create New Order</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>OrderID</th>
					<th>Customer</th>
					<th>Purchase Date</th>
					<th>Total</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>

				<?php foreach ($orders as $index => $order) : ?>
				<tr>
					<td>#<?php echo $order['OrderID'] ?></td>
					<td><?php echo get_user_by_id($order['CustomerID'])['CustomerName'] ?></td>
					<td><?php echo $order['DatePurchase'] ?></td>
					<td>$<?php echo $order['TotalPrice'] ?></td>
					<td>
						<a href="#editOrderModal-<?php echo $index ?>" class="edit" data-toggle="modal">
							<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
						</a>
						<a href="?delete_order&id=<?php echo $order['OrderID'] ?>" class="delete">
							<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
						</a>
					</td>
				</tr>
				<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
<div id="addOrderModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="#">
				<div class="modal-header">
					<h4 class="modal-title">Create Order</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Customer</label>
						<select name="customer_id" id="customer-id" class="form-control">
							<option value="">-- Select Customer --</option>
							<?php foreach ( $customers as $customer) : ?>
								<option value="<?php echo $customer['UserID'] ?>"><?php echo $customer['CustomerName'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Status</label>
						<select name="status" id="status" class="form-control">
							<option value="">-- Select status --</option>
							<?php foreach ($statuses as $value => $label) : ?>
								<option value="<?php echo $value ?>"><?php echo $label ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<strong style="display:inline-block; font-size: 16px; margin-top: 20px">
							Products
						</strong>

						<hr />

						<div class="products-table">
							<table class="order-product">
								<tr>
									<td>
										Product 1
										<select name="products[1][product_id]" id="status" class="form-control">
											<option value="">-- No Product --</option>
											<?php foreach ( $products as $product) : ?>
												<option value="<?php echo $product['ProductID'] ?>"><?php echo $product['ProductName'] ?></option>
											<?php endforeach; ?>
										</select>
									</td>

									<td>
										Qty: <input type="number" name="products[1][qty]" value="1" min="0" class="form-control product-qty">
									</td>

									<td class="remove-order-item">
										<a href="#">Remove</a>
									</td>
								</tr>
							</table>
						</div>

						<button class="btn btn-info order-add-item">Add product</button>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="add_order" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
<?php foreach ($orders as $index => $order) :
	$order_items = get_order_items($order['OrderID']);

	?>
<div id="editOrderModal-<?php echo $index ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="#">
				<div class="modal-header">
					<h4 class="modal-title">Edit Order #<?php echo $order['OrderID'] ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label>Customer</label>
						<select name="customer_id" id="customer-id" class="form-control">
							<option value="">-- Select Customer --</option>
							<?php foreach ( $customers as $customer) : ?>

								<?php if ( $customer['UserID'] == $order['CustomerID'] ) : ?>
									<option value="<?php echo $customer['UserID'] ?>" selected="selected">
										<?php echo $customer['CustomerName'] ?>
									</option>
								<?php else : ?>
									<option value="<?php echo $customer['UserID'] ?>"><?php echo $customer['CustomerName'] ?></option>
								<?php endif; ?>

							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Status</label>
						<select name="status" id="status" class="form-control">
							<option value="">-- Select status --</option>
							<?php foreach ($statuses as $value => $label) : ?>

								<?php if ( $order['Status'] == $value ) : ?>
									<option value="<?php echo $value ?>" selected="selected"><?php echo $label ?></option>
								<?php else : ?>
									<option value="<?php echo $value ?>"><?php echo $label ?></option>
								<?php endif; ?>

							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<strong style="display:inline-block; font-size: 16px; margin-top: 20px">
							Products
						</strong>

						<hr />

						<div class="products-table">
							<?php foreach ( $order_items as $item_i => $item ) : ?>

								<table class="order-product">
									<tr>
										<td>
											Product <?php echo $item_i + 1 ?>
											<select name="products[<?php echo $item_i ?>][product_id]" id="status" class="form-control">
												<option value="">-- No Product --</option>

												<?php foreach ( $products as $product) : ?>
													<?php if ( $item['ProductID'] == $product['ProductID'] ) : ?>
														<option value="<?php echo $product['ProductID'] ?>" selected="selected">
															<?php echo $product['ProductName'] ?>
														</option>
													<?php else: ?>
														<option value="<?php echo $product['ProductID'] ?>">
															<?php echo $product['ProductName'] ?>
														</option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</td>

										<td>
											Qty: <input type="number" name="products[<?php echo $item_i ?>][qty]" min="0" class="form-control product-qty"
														value="<?php echo $item['Quantity'] ?>">
										</td>

										<td class="remove-order-item">
											<a href="#">Remove</a>
										</td>
									</tr>
								</table>

							<?php endforeach; ?>
						</div>

						<button class="btn btn-info order-add-item">Add product</button>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" name="edit_order" value="Save">
					<input type="hidden" name="order_id" value="<?php echo $order['OrderID'] ?>">
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<div id="order-product-template" style="display: none;">
	<table class="order-product">
		<tr>
			<td>
				<label>Product</label>

				<select name="" id="status" class="form-control product-select">
					<option value="">-- No Product --</option>
					<?php foreach ( $products as $product) : ?>
						<option value="<?php echo $product['ProductID'] ?>"><?php echo $product['ProductName'] ?></option>
					<?php endforeach; ?>
				</select>
			</td>

			<td>
				Qty:
				<input type="number" name="" value="1" class="form-control product-qty">
			</td>

			<td class="remove-order-item">
				<a href="#">Remove</a>
			</td>
		</tr>
	</table>
</div>

<?php require_once "templates/footer.php" ?>