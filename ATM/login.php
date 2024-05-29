<?php
// Load definisi kelas sebelum mengakses sesi
require_once 'atm.php';

// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi objek ATM jika belum ada dalam sesi
if (!isset($_SESSION['atm'])) {
    $_SESSION['atm'] = new ATM();
}

$atm = $_SESSION['atm'];
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pin = $_POST['pin'];
    // Validasi PIN hanya boleh angka
    if (!ctype_digit($pin)) {
        $error = "PIN hanya boleh terdiri dari angka!";
    } elseif ($atm->checkPin($pin)) {
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "PIN salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>Login ATM</title>
</head>
<body>
    <div class="container">
        <div class="img-container">
            <img src="assets/img/logo mybank.jpg">
        </div>
        <h2>Login MyBank</h2>
        <form method="post" action="">
            <input type="password" name="pin" placeholder="Masukkan PIN" required>
            <input type="submit" value="Login">
        </form>
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
