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
	<title><?=$_SESSION['username']?></title>
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
				<a href="../book/book.php">
					<i class="bx bx-box"></i>
					<span class="links_name">Book</span>
				</a>
			</li>
			<li>
				<a href="transaction/transaction.php" class="active">
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
				<span class="admin_name"><?=$_SESSION['username']?></span>
			</div>
		</nav>
		<div class="home-content">
		<h3>Transaction</h3>
         <a class="btn_detail" href="transaction-cetak.php">Cetak</a>
         <table class="table-data">
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>`
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               include '../koneksi.php';
               $sql = "SELECT * FROM tb_transaction";
               $result = mysqli_query($koneksi, $sql);
               if (mysqli_num_rows($result) == 0) {
                  echo "
                  <h3 style='text-align: center; color: red;'>Data Kosong</h3>
               ";
               } else {
                  while ($data = mysqli_fetch_assoc($result)) {
                     echo "
                     <tr>
                         <td>$data[tanggal]</td>
                         <td>$data[nama]</td>
                         <td>$data[jenis]</td>
                         <td><p class='success'>$data[status]</p></td>
                         <td style='display: none;'>$data[nomorhp]</td>
                         <td>
                         <button class='btn_detail' data-nomorhp='$data[nomorhp]' onclick='showDetails(\"$data[tanggal]\", \"$data[nama]\", \"$data[jenis]\", \"$data[status]\")'>Detail</button>
                         </td>
                     </tr>
                     ";
                  }
               }
               ?>
            </tbody>
         </table>
		</div>
	</section>
</body>

</html>
