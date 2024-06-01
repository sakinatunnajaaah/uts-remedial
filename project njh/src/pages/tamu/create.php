<?php
require_once '../../../config/Database.php';
require_once '../../../app/Tamu.php';

$database = new Database();
$db = $database->dbConnection();

$tamu = new Tamu($db);

if(isset($_POST['tambah'])){
    $tamu->first_name = $_POST['first_name'];
    $tamu->last_name = $_POST['last_name'];
    $tamu->email = $_POST['email'];
    $tamu->phone = $_POST['phone'];

    $tamu->store(); 
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
        <label for="first_name">Nama Depan:</label>
        <input type="text" name="first_name" required>
        <br>
        <label for="last_name">Nama Belakang:</label>
        <input type="text" name="last_name" required>
        <br>
        <label for="email">Alamat Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="phone">Nomer Handphone:</label>
        <input type="number" name="phone" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>