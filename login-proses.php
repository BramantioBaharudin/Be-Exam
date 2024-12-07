<?php 

include 'koneksi.php';
header('Content-Type: application/json');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $requestUsername = $_POST['username'];
    $requestPassword = $_POST['password'];

    $sql = "SELECT * FROM tb_admin WHERE username = '$requestUsername'";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password']; // Ambil password yang di-hash dari database

        if (password_verify($requestPassword, $hashedPassword)) {
            session_start();
            $_SESSION['username'] = $row['username'];
            
            // Berikan respons JSON jika login berhasil
            echo json_encode([
                'success' => true,
                'message' => 'Login berhasil',
                'redirect' => 'dashboard.php'
            ]);
        } else {
            // Respons jika password salah
            echo json_encode([
                'success' => false,
                'message' => 'Password salah, silakan coba lagi.'
            ]);
        }
    } else {
        // Respons jika username tidak ditemukan
        echo json_encode([
            'success' => false,
            'message' => 'Username tidak ditemukan, silakan coba lagi.'
        ]);
    }
} else {
    // Respons jika data tidak lengkap
    echo json_encode([
        'success' => false,
        'message' => 'Harap isi username dan password.'
    ]);
}

?>