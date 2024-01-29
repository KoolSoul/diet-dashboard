<?php
include_once 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodToDelete = $_POST['food'];

    $stmt = $mysqli->prepare("DELETE FROM food_list WHERE Food = ?");
    if ($stmt === false) {
        die("Error preparing the statement: " . $mysqli->error);
    }

    $stmt->bind_param("s", $foodToDelete);
    if ($stmt->execute()) {
        echo "Food item deleted successfully.";
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }

    $stmt->close();
}

$sql = "SELECT Food FROM food_list;";
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Food Item</title>
</head>
<body>
    <h1>Delete a Food Item</h1>

    <form action="delete_food.php" method="post">
        <label for="food">Select Food:</label>
        <select name="food" id="food">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . htmlspecialchars($row['Food']) . "'>" . htmlspecialchars($row['Food']) . "</option>";
                }
            } else {
                echo "<option value=''>No food items available</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Delete Food Item">
    </form>
    <button><a href="index.php" style="cursor: default; color: black; text-decoration:none;">Back to Dash</a></button>
</body>
</html>
