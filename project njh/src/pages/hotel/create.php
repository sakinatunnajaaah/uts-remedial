<?php
require_once '../../../config/Database.php';
require_once '../../../app/Hotel.php';

$database = new Database();
$db = $database->dbConnection();

$hotel = new Hotel($db);

if(isset($_POST['tambah'])){
    $hotel->name = $_POST['name'];
    $hotel->address = $_POST['address'];
    $hotel->city = $_POST['city'];
    $hotel->country = $_POST['country'];

    $hotel->store(); 
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
        <label for="name">Nama:</label>
        <input type="text" name="name" required>
        <br>
        <label for="address">Alamat:</label>
        <input type="text" name="address" required>
        <br>
        <label for="city">Kota:</label>
        <input type="text" name="city" required>
        <br>
        <label for="country">Negara:</label>
        <input type="text" name="country" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>