<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styleregister.css">
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@400;700&display=swap" rel="stylesheet">
    <title>Register Form</title>
</head>
<body>

    <div class="register-container">
        <div class="logo">
            <img class="logo" src="assets/inilogo.png" alt="">
        </div>
        <h2 class="register">Register</h2>
        <form method="POST" id="register-form">
            <div class="section-title"></div>
            <input type="text"  name="username" placeholder="Username" required>
            <input type="email"  name="email" placeholder="Email" required>
            <input type="password"  name="password" placeholder="Password" required>
            <button type="submit" name="register" id="register">Submit</button>
            <p class="reg">
                <a href="login.php">
                    already have an account?
                </a>
            </p>
        </form>
    </div>
    <div id="snackbar">Register Successful!</div>
    <script>
        document.getElementById("register-form").addEventListener("submit", processRegister);

        function processRegister(e) {
            e.preventDefault(); // Mencegah form melakukan reload halaman default

            // Ambil elemen form
            const form = e.target;

            // Buat objek FormData untuk mengambil data dari form
            const formData = new FormData(form);

            // Kirim data menggunakan fetch
            fetch("register-proses.php", {
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
                            window.location.href = "login.php"; // Redirect ke dashboard
                        }, 5000)
                    } else {
                        // Login gagal, tampilkan pesan kesalahan
                        alert(data.message || "Register gagal, periksa kembali username dan password Anda.");
                    }
                })
                .catch(error => {
                    console.error("Terjadi kesalahan:", error);
                    alert("Terjadi kesalahan saat memproses register.");
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
