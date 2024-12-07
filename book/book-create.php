<?php 
	session_start();
	if($_SESSION['username'] == null) {
		header('location:login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<link rel="icon" href="assets/icon.png" />
	<link rel="stylesheet" href="../assets/css/dashstyle.css" />
	<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin</title>
</head>
<body>
	<div class="sidebar">
		<div class="logo-details">
			<img class="logo" src="../assets/inilogo.png" alt="Be-Smart">
		</div>
		<ul class="nav-links">
			<li>
				<a href="../dashboard.php" >
					<i class="bx bx-grid-alt"></i>
					<span class="links_name">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="../book/book.php" class="active">
					<i class="bx bx-box"></i>
					<span class="links_name">Book</span>
				</a>
			</li>
			<li>
				<a href="transaction/transaction.php">
					<i class="bx bx-list-ul"></i>
					<span class="links_name">Transaction</span>
				</a>
			</li>
			<li>
				<a href="../logout.php">
					<i class="bx bx-log-out"></i>
					<span class="links_name">Log out</span>
				</a>
			</li>
		</ul>
	</div>
	<section class="home-section">
		<nav>
			<div class="sidebar-button">
				<i class="bx bx-menu sidebarBtn"></i>
			</div>
			<div class="profile-details">
				<span class="admin_name">Admin</span>
			</div>
		</nav>
        <div class="home-content">
			<h3>Input Book</h3>
			<div class="form-login">
				<form action="book-proses.php" method="post" enctype="multipart/form-data">
					<label for="categories">Categories</label>
					<input class="input" type="text" name="categories" id="categories" placeholder="Categories" />
					<label for="categories">Description</label>
					<input class="input" type="text" name="description" id="description" placeholder="Description" />
					<label for="photo">Photo</label>
					<input type="file" name="photo" id="photo" style="margin-bottom: 20px" />
					<button type="submit" class="btn btn-simpan" name="simpan">
						Simpan
					</button>
				</form>
			</div>
		</div>
	</section>
</body>

</html>
