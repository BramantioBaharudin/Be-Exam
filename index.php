<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Alkalami&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Be-Smart</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img class="gambar" src="assets/inilogo.png" alt="">
        </div>
        <div class="menu">
            <a class="btn-home">Home</a>
            <a class="btn-category">Category</a>
            <a class="btn-about">About</a>
        </div>
        <div class="button-container">
            <a class="btn-l" href="login.php">Login</a>
            <a class="btn-r" href="register.php">Register</a>
        </div>
    </div>
    <div class="halaman">  
    </div>
    <div class="jumbotron">
        <div class="jumbotron-text">
            <h2>Get a Wide Selection of Quality Books For All Levels of Education.</h2>
            <button type="button" class="btn_getStarted">Get Started</button>
        </div>
        <div class="jumbotron-img">
            <img src="assets/tampilanbuku1.png" alt="" />
        </div>
    </div>
    <div class="cards-categories">
        <h2>Book Category</h2>
        <?php
					include 'koneksi.php';
					$sql = "SELECT * FROM tb_book";
					$result = mysqli_query($koneksi, $sql);
					if (mysqli_num_rows($result) == 0) {
						echo "
						<h3 style='text-align: center; color: red;'>Data Kosong</h3>
				";
					}
					while ($data = mysqli_fetch_assoc($result)) {
						echo "
						<div class='card'>
							<div class='card-image'>
								<img src='tempatgambar/$data[photo]' alt='tidak ada gambar' />
							</div>
							<div class='card-content'>
								<h5>$data[categories]</h5>
								<p class='description'>$data[description]</p>
								<button class='btn_belanja' type='submit' onclick='bukaModal(\"$data[categories]\")'>Beli</button>
							</div>
					</div>
                  ";
					}
					?>

    </div>
    <!--  Modal -->
    <div id="myModal" class="modal-container" onclick="tutupModal()">
				<div class="modal-dialog" onclick="event.stopPropagation()">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title " style="color:  #1B629A;">Formulir Data Diri</h1>
							<button type="button" class="btn-close" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form>
								<input type="hidden" name="category_id" id="category_id" value="">
								<input type="hidden" name="category_name" id="category_name" value="">
								<input type="hidden" name="price" id="price" value="">
								<div class="form-group">
									<label class="labelmodal" for="recipient-name" class="col-form-label">Nama :</label>
									<input class="inputdata" type="text" class="form-control" id="recipient-name">
								</div>
								<div class="form-group">
									<label class="labelmodal" for="handphone" class="col-form-label">No. Hp :</label>
									<input class="inputdata" type="text" class="form-control" id="handphone">
								</div>
								<div class="form-group">
									<label class="labelmodal" for="alamat-text" class="col-form-label">Alamat:</label>
									<textarea class="inputalamat" class="form-control" id="alamat-text"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" onclick="tutupModal()">Keluar</button>
							<button type="button" class="btn btn-yellow" onclick="bukaModal2()">Lanjutkan</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal 2 -->
			<div id="myModal2" class="modal-container" onclick="tutupModal2()">
				<div class="modal-dialog" onclick="event.stopPropagation()">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title" style="color:  #1B629A;">Data Transaksi</h1>
							<button type="button" class="btn-close" aria-label="Close" onclick="tutupModal2()"></button>
						</div>
						<form action="transaction/transaction-proses.php" method="post">
							<div class="modal-body">
								<h4> Kategori</h4>
								<div class="form-group">
									<label class="labelmodal" for="detail-kategori" class="col-form-label">Kategori
										:</label>
									<input class="inputdata" type="text" name="detail-kategori" class="form-control" id="detail-kategori" readonly>
								</div>
								<h4>Pembeli</h4>
								<div class="form-group">
									<label class="labelmodal" for="detail-nama" class="col-form-label">Nama :</label>
									<input class="inputdata" name="detail-nama" type="text" class="form-control" id="detail-nama" readonly>
								</div>
								<div class="form-group">
									<label class="labelmodal" for="detail-nomorhp" class="col-form-label">No. Hp
										:</label>
									<input class="inputdata" name="detail-nomor" type="text" class="form-control" id="detail-nomorhp" readonly>
								</div>
								<div class="form-group">
									<label class="labelmodal" for="detail-alamat" class="col-form-label">Alamat:</label>
									<textarea class="inputalamat" name="detail-alamat" class="form-control" id="detail-alamat" readonly></textarea>
								</div>
								<input type="hidden" name="detail-status" value="succes">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" onclick="kembaliKeModalPertama()">Kembali</button>
								<button name="simpan" type="submit" class="btn btn-yellow" onclick="lakukanPembayaran()">Selesai</button>
							</div>
						</form>
					</div>
				</div>
			</div>
      <script>
		// Fungsi Modal
		function bukaModal(kategori) {
			document.getElementById("myModal").style.display = "flex";

			document.getElementById("detail-kategori").value = kategori;

			document.getElementById("nama").value = "";
			document.getElementById("nomorhp").value = "";
			document.getElementById("alamat").value = "";
		}

		function tutupModal() {
			document.getElementById("myModal").style.display = "none";
		}

		function tutupModal2() {
			document.getElementById("myModal2").style.display = "none";
		}
		function bukaModal2() {
			tutupModal(); // Tutup modal pertama
			document.getElementById("myModal2").style.display = "flex";

			var nama = document.getElementById("recipient-name").value;
			var nomorhp = document.getElementById("handphone").value;
			var alamat = document.getElementById("alamat-text").value;

			document.getElementById("detail-nama").value = nama;
			document.getElementById("detail-nomorhp").value = nomorhp;
			document.getElementById("detail-alamat").value = alamat;
		}
		function kembaliKeModalPertama() {
			tutupModal2();
			bukaModal();
		}
		function lakukanPembayaran() {
			alert("Pembayaran berhasil!");
			tutupModal2();
		}

	</script>
</body>

</html>