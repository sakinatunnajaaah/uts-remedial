<?php
require_once '../../../config/Database.php';
require_once '../../../app/Ruangan.php';

$database = new Database();
$db = $database->dbConnection();

$ruangan = new Ruangan($db);

if(isset($_POST['update'])) {
    $ruangan->id = $_POST['id'];
    $ruangan->hotel_id = $_POST['hotel_id'];
    $ruangan->room_number = $_POST['room_number'];
    $ruangan->room_type = $_POST['room_type'];
    $ruangan->price = $_POST['price'];
    $ruangan->availability = $_POST['availability'];


    $ruangan->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $ruangan->id = $_GET['id'];
    $stmt = $ruangan->edit();
    $num = $stmt->rowCount();

    if($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="hotel_id">ID Hotel:</label>
        <input type="number" name="hotel_id" value="<?php echo $hotel_id; ?>" required>
        <br>
        <label for="room_number">Nomer Ruangan:</label>
        <input type="number" name="room_number" value="<?php echo $room_number; ?>" required>
        <br>
        <label for="room_type">Tipe Ruangan:</label>
        <input type="text" name="room_type" value="<?php echo $room_type; ?>" required>
        <br>
        <label for="price">Harga:</label>
        <input type="number" name="price" value="<?php echo $price; ?>" required>
        <br>
        <label for="availability">Ketersediaan:</label>
        <input type="number" name="availability" value="<?php echo $availability; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>