<?php
include 'koneksi.php';
header('Content-Type: application/json');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (empty($email) || empty($username) || empty($_POST["password"])) {
        // Respons jika data tidak lengkap
        echo json_encode([
            'success' => false,
            'message' => 'Pastikan Anda mengisi semua data.'
        ]);
    } else {
        $sql = "INSERT INTO tb_admin (id, email, password, username) VALUES (NULL, '$email', '$password', '$username')";

        if (mysqli_query($koneksi, $sql)) {
            // Respons jika registrasi berhasil
            echo json_encode([
                'success' => true,
                'message' => 'Registrasi berhasil. Silakan login.',
                'redirect' => 'login.php'
            ]);
        } else {
            // Respons jika terjadi kesalahan
            echo json_encode([
                'success' => false,
                'message' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.'
            ]);
        }
    }
} else {
    // Respons jika tidak ada data POST
    echo json_encode([
        'success' => false,
        'message' => 'Permintaan tidak valid.'
    ]);
}

?>
