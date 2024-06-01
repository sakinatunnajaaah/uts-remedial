<?php
require_once '../../../config/Database.php';
require_once '../../../app/Reservasi.php';

$database = new Database();
$db = $database->dbConnection();

$reservasi = new Reservasi($db);

if(isset($_POST['tambah'])){
    $reservasi->guest_id = $_POST['guest_id'];
    $reservasi->room_id = $_POST['room_id'];
    $reservasi->check_in_date = $_POST['check_in_date'];
    $reservasi->check_out_date = $_POST['check_out_date'];

    $reservasi->store(); 
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="POST" action="">
        <label for="guest_id">ID Tamu:</label>
        <input type="number" name="guest_id" required>
        <br>
        <label for="room_id">ID Ruangan:</label>
        <input type="number" name="room_id" required>
        <br>
        <label for="check_in_date">Tanggal Masuk:</label>
        <input type="date" name="check_in_date" required>
        <br>
        <label for="check_out_date">Tanggal Keluar:</label>
        <input type="date" name="check_out_date" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>