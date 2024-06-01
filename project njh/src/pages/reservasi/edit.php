<?php
require_once '../../../config/Database.php';
require_once '../../../app/Reservasi.php';

$database = new Database();
$db = $database->dbConnection();

$reservasi = new Reservasi($db);

if(isset($_POST['update'])) {
    $reservasi->id = $_POST['id'];
    $reservasi->guest_id = $_POST['guest_id'];
    $reservasi->room_id = $_POST['room_id'];
    $reservasi->check_in_date = $_POST['check_in_date'];
    $reservasi->check_out_date = $_POST['check_out_date'];


    $reservasi->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $reservasi->id = $_GET['id'];
    $stmt = $reservasi->edit();
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
        <label for="guest_id">ID Tamu:</label>
        <input type="number" name="guest_id" value="<?php echo $guest_id; ?>" required>
        <br>
        <label for="room_id">ID Ruangan:</label>
        <input type="number" name="room_id" value="<?php echo $room_id; ?>" required>
        <br>
        <label for="check_in_date">Tanggal Masuk:</label>
        <input type="date" name="check_in_date" value="<?php echo $check_in_date; ?>" required>
        <br>
        <label for="check_out_date">Tanggal Keluar:</label>
        <input type="date" name="check_out_date" value="<?php echo $check_out_date; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>