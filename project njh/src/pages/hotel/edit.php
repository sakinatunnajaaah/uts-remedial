<?php
require_once '../../../config/Database.php';
require_once '../../../app/Hotel.php';

$database = new Database();
$db = $database->dbConnection();

$hotel = new Hotel($db);

if(isset($_POST['update'])) {
    $hotel->id = $_POST['id'];
    $hotel->name = $_POST['name'];
    $hotel->address = $_POST['address'];
    $hotel->city = $_POST['city'];
    $hotel->country = $_POST['country'];


    $hotel->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $hotel->id = $_GET['id'];
    $stmt = $hotel->edit();
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
        <label for="name">Nama:</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>
        <br>
        <label for="address">Alamat:</label>
        <input type="text" name="address" value="<?php echo $address; ?>" required>
        <br>
        <label for="city">Kota:</label>
        <input type="text" name="city" value="<?php echo $city; ?>" required>
        <br>
        <label for="country">Negara:</label>
        <input type="text" name="country" value="<?php echo $country; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>