<?php
require_once '../../../config/Database.php';
require_once '../../../app/Ruangan.php';

$database = new Database();
$db = $database->dbConnection();

$ruangan = new Ruangan($db);

if(isset($_POST['tambah'])){
    $ruangan->hotel_id = $_POST['hotel_id'];
    $ruangan->room_number = $_POST['room_number'];
    $ruangan->room_type = $_POST['room_type'];
    $ruangan->price = $_POST['price'];
    $ruangan->availability = $_POST['availability'];

    $ruangan->store(); 
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
        <label for="hotel_id">ID Hotel:</label>
        <input type="number" name="hotel_id" required>
        <br>
        <label for="room_number">Nomer Ruangan:</label>
        <input type="number" name="room_number" required>
        <br>
        <label for="room_type">Tipe Ruangan:</label>
        <input type="text" name="room_type" required>
        <br>
        <label for="price">Harga:</label>
        <input type="number" name="price" required>
        <br>
        <label for="availability">Ketersediaan:</label>
        <input type="number" name="availability" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>