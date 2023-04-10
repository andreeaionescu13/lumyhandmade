<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lumy Handmade</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../admin/css/admin.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	<style>
        .error-msg-wrapper {
            margin-bottom: 20px;
            padding: 10px;
            background: #f3766d;
            color: #fff;
            line-height: 20px;
        }

        .error-msg-wrapper p {
            margin: 0;
        }
	</style>
</head>

<body>

<?php if ( isset($_SESSION['messages']) ) : ?>
<div class="container" style="text-align: center;
    background: #8bc34a;
    color: #fff;
    line-height: 40px;"><?php echo $_SESSION['messages'][0] ?></div>
<?php unset($_SESSION['messages']); endif; ?>