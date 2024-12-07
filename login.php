<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/stylelogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@400;700&display=swap" rel="stylesheet">
    <title>Login Form</title>
</head>

<body>

    <div class="login-container">
        <div class="logo">
            <img class="logo" src="assets/inilogo.png" alt="">
        </div>
        <h2>Login</h2>
        <form id="login-form" method="post" action="login-proses.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" id="login">Masuk</button>
            <p class="reg">
                <a href="register.php">
                    Don't Have Account Yet?
                </a>
            </p>
        </form>
    </div>
    <div id="snackbar">Login Successful!</div>

    <script>
        document.getElementById("login-form").addEventListener("submit", processLogin);

        function processLogin(e) {
            e.preventDefault(); // Mencegah form melakukan reload halaman default

            // Ambil elemen form
            const form = e.target;

            // Buat objek FormData untuk mengambil data dari form
            const formData = new FormData(form);

            // Kirim data menggunakan fetch
            fetch("login-proses.php", {
                method: "POST",
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Gagal menghubungi server");
                    }
                    return response.json(); // Asumsikan respons dari server berupa JSON
                })
                .then(data => {
                    if (data.success) {
                        // Login berhasil, lakukan sesuatu
                        showSnackbar();
                        setTimeout(() => {
                            window.location.href = "dashboard.php"; // Redirect ke dashboard
                        }, 5000)
                    } else {
                        // Login gagal, tampilkan pesan kesalahan
                        alert(data.message || "Login gagal, periksa kembali username dan password Anda.");
                    }
                })
                .catch(error => {
                    console.error("Terjadi kesalahan:", error);
                    alert("Terjadi kesalahan saat memproses login.");
                });
        }

        function showSnackbar() {
            var snackbar = document.getElementById("snackbar");
            snackbar.className = "show";
            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 3000);
        }
    </script>

</body>

</html>