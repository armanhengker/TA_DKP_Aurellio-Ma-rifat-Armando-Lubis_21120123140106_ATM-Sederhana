<?php
require_once 'atm.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

$atm = $_SESSION['atm'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['withdraw'])) {
        $amount = intval($_POST['amount']);
        if ($atm->withdraw($amount)) {
            $message = "Penarikan berhasil!";
        } else {
            $message = "Penarikan gagal! Saldo tidak mencukupi.";
        }
    } elseif (isset($_POST['deposit'])) {
        $amount = intval($_POST['amount']);
        if ($atm->deposit($amount)) {
            $message = "Setoran berhasil!";
        } else {
            $message = "Setoran gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <title>ATM</title>
</head>
<body>
    <div class="container">
        <div class="img-container">
            <img src="assets/img/logo mybank.jpg">
        </div>
        <h2>Selamat Datang di MyBank</h2>
        <p>Saldo Anda: Rp <?= number_format($atm->getBalance(), 0, ',', '.') ?></p>
        <p style="color: green;"><?= $message ?></p>
        <div class="actions">
        <form method="post" action="">
            <input type="text" name="amount" placeholder="Jumlah" class="number-input">
            <input type="submit" name="withdraw" value="Tarik Tunai">
            <input type="submit" name="deposit" value="Setor Tunai">
        </form>

            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
