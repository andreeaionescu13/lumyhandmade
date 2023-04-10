<?php require_once "../inc/helpers.php" ?>
<?php require_once "actions.php" ?>

<?php

$products = get_products();

?>

<?php require_once "templates/header.php" ?>

<div class="container-xl">
	<div class="row">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo BASE_URL . '/lumyhandmade/admin/orders.php' ?>">Lumy Handmade</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="orders.php">Orders <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
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
						<h2>Products</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" id="add-product" class="btn btn-success" data-toggle="modal">
							<i class="material-icons">&#xE147;</i> <span>Add New Product</span>
						</a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>Product Name</th>
					<th>Price</th>
					<th>Manufacturer ID</th>
					<th>Image</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>

				<?php foreach ($products as $product) : ?>
					<tr>
						<td><?php echo $product['ProductName'] ?></td>
						<td><?php echo $product['Price'] ?></td>
						<td><?php echo $product['ManufacturerID'] ?></td>
						<td style="text-align: center">
							<?php if ( !empty($product['Image']) ) : ?>
								<img src="<?php echo get_image_path($product['Image']) ?>" alt="<?php echo $product['Image'] ?>" height="50">
							<?php else : ?>
								<i style="font-weight: lighter; font-size: 12px">No Image</i>
							<?php endif; ?>
						</td>
						<td>
							<a href="#editProductModal-<?php echo $product['ProductID'] ?>" id="edit-product-<?php echo $product['ProductID'] ?>" class="edit" data-toggle="modal">
								<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							</a>

							<a href="?delete_product&id=<?php echo $product['ProductID'] ?>" class="delete"
							   onclick="return confirm('Are you sure you want to delete product <?php echo $product['ProductName'] ?>?')">
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
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Add Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php if ( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) : ?>
						<div class="container error-msg-wrapper">

							<?php foreach ($_SESSION['error_msg'] as $msg) : ?>

								<p><?php echo $msg ?></p>

							<?php endforeach ?>

						</div>
					<?php endif; ?>

					<div class="form-group">
						<label>Product name*</label>
						<input type="text" class="form-control" name="product_name" value="<?php echo isset($_SESSION['form_values']['product_name']) ? $_SESSION['form_values']['product_name'] : '' ?>">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description">
<?php echo isset($_SESSION['form_values']['description']) ? $_SESSION['form_values']['description'] : '' ?>
						</textarea>
					</div>
					<div class="form-group">
						<label>Price*</label>
						<input type="text" class="form-control" name="price" value="<?php echo isset($_SESSION['form_values']['price']) ? $_SESSION['form_values']['price'] : '' ?>">
					</div>
					<div class="form-group">
						<label>Manufacturer ID*</label>
						<input type="text" class="form-control" name="manufacturer_id" value="<?php echo isset($_SESSION['form_values']['manufacturer_id']) ? $_SESSION['form_values']['manufacturer_id'] : '' ?>">
					</div>
					<div class="form-group">
						<label>Image</label>
						<br />
						<input type="file" name="product_image" id="image" accept="image/png, image/jpeg, image/jpg">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="add_product" value="Add Product">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
<?php foreach ($products as $index => $product) : ?>
<div id="editProductModal-<?php echo $product['ProductID'] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h4 class="modal-title">Edit Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php if ( isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg']) ) : ?>
						<div class="container error-msg-wrapper">

							<?php foreach ($_SESSION['error_msg'] as $msg) : ?>

								<p><?php echo $msg ?></p>

							<?php endforeach ?>

						</div>
					<?php endif; ?>

					<div class="form-group">
						<label>Product name*</label>
						<input type="text" class="form-control" name="product_name" value="<?php echo $product['ProductName'] ?>">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="description"><?php echo $product['Description'] ?></textarea>
					</div>
					<div class="form-group">
						<label>Price*</label>
						<input type="text" class="form-control" name="price" value="<?php echo $product['Price'] ?>">
					</div>
					<div class="form-group">
						<label>Manufacturer ID*</label>
						<input type="text" class="form-control" name="manufacturer_id" value="<?php echo $product['ManufacturerID'] ?>">
					</div>
					<div class="form-group">
						<label>Image</label>
						<br />
						<input type="file" name="product_image" id="image" accept="image/png, image/jpeg, image/jpg">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" name="edit_product" value="Save">
					<input type="hidden" name="product_id" value="<?php echo $product['ProductID'] ?>">
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php unset($_SESSION['form_values']); ?>
<?php unset($_SESSION['error_msg']); ?>

<?php require_once "templates/footer.php" ?>