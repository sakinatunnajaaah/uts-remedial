<?php
require_once '../../../config/Database.php';
require_once '../../../app/Tamu.php';

$database = new Database();
$db = $database->dbConnection();

$tamu = new Tamu($db);

if(isset($_POST['update'])) {
    $tamu->id = $_POST['id'];
    $tamu->first_name = $_POST['first_name'];
    $tamu->last_name = $_POST['last_name'];
    $tamu->email = $_POST['email'];
    $tamu->phone = $_POST['phone'];


    $tamu->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $tamu->id = $_GET['id'];
    $stmt = $tamu->edit();
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
        <label for="first_name">Nama Depan:</label>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required>
        <br>
        <label for="last_name">Nama Belakang:</label>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required>
        <br>
        <label for="email">Alamat Email:</label>
        <input type="email" name="text" value="<?php echo $email; ?>" required>
        <br>
        <label for="phone">Nomer Handphone:</label>
        <input type="number" name="phone" value="<?php echo $phone; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>