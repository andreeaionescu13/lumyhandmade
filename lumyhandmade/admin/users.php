<?php require_once "../inc/helpers.php" ?>
<?php require_once "actions.php" ?>

<?php
$users = get_users();
//
//echo '<pre>';
//print_r($users);
//echo '</pre>';

?>

<?php require_once "templates/header.php" ?>

	<div class="container-xl">
		<div class="row">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="<?php echo BASE_URL . '/lumyhandmade/admin/orders.php' ?>">Lumy Handmade</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="orders.php">Orders <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="products.php">Products</a>
						</li>
						<li class="nav-item active">
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
							<h2>Customers</h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" id="add-user" class="btn btn-success" data-toggle="modal">
								<i class="material-icons">&#xE147;</i> <span>Add New Customer</span>
							</a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ($users as $index => $user) : ?>
					<tr>
						<td><?php echo $user['CustomerName'] ?></td>
						<td><?php echo $user['CustomerEmail'] ?></td>
						<td><?php echo $user['CustomerAddress'] ?></td>
						<td><?php echo $user['CustomerPhoneNumber'] ?></td>
						<td>
							<a href="#editEmployeeModal-<?php echo $user['UserID'] ?>" id="edit-user-<?php echo $user['UserID'] ?>" class="edit" data-toggle="modal">
								<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							</a>

							<a href="?delete_customer&id=<?php echo $user['UserID'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete user <?php echo $user['CustomerName'] ?>?')">
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
			<form method="POST" action="#">
				<div class="modal-header">
					<h4 class="modal-title">Add Customer</h4>
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
						<label>Username*</label>
						<input type="text" class="form-control" name="username" value="<?php echo isset($_SESSION['form_values']['username']) ? $_SESSION['form_values']['username'] : '' ?>">
					</div>

					<div class="form-group">
						<label>Password*</label>
						<input type="password" class="form-control" name="password" value="<?php echo isset($_SESSION['form_values']['password']) ? $_SESSION['form_values']['password'] : '' ?>">
					</div>

					<div class="form-group">
						<label>Email*</label>
						<input type="email" class="form-control" name="email" value="<?php echo isset($_SESSION['form_values']['email']) ? $_SESSION['form_values']['email'] : '' ?>">
					</div>

					<div class="form-group">
						<label>Name*</label>
						<input type="text" class="form-control" name="name" value="<?php echo isset($_SESSION['form_values']['name']) ? $_SESSION['form_values']['name'] : '' ?>">
					</div>

					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address">
<?php echo isset($_SESSION['form_values']['address']) ? $_SESSION['form_values']['address'] : '' ?>
						</textarea>
					</div>

					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" name="phone_number" value="<?php echo isset($_SESSION['form_values']['phone_number']) ? $_SESSION['form_values']['phone_number'] : '' ?>">
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name="add_customer" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Edit Modal HTML -->
<?php foreach ($users as $index => $user) : ?>
<div id="editEmployeeModal-<?php echo $user['UserID'] ?>" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="#">
				<div class="modal-header">
					<h4 class="modal-title">Edit Customer</h4>
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
						<label>Username</label>
						<input type="text" class="form-control" name="username" value="<?php echo $user['UserName'] ?>">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" value="<?php echo $user['CustomerName'] ?>">
					</div>

					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="<?php echo $user['CustomerName'] ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $user['CustomerEmail'] ?>">
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address"><?php echo $user['CustomerAddress'] ?></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" name="phone_number" value="<?php echo $user['CustomerPhoneNumber'] ?>">
					</div>
				</div>

				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" name="edit_customer" value="Save">
					<input type="hidden" name="user_id" value="<?php echo $user['UserID'] ?>">
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php unset($_SESSION['form_values']); ?>
<?php unset($_SESSION['error_msg']); ?>

<?php require_once "templates/footer.php" ?>