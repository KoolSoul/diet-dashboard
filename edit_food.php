
<?php
include_once 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT `#`, Food FROM food_list;"; 
$result = mysqli_query($mysqli, $sql);

$foodToEdit = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_food'])) {
    $foodId = $_POST['food_id'];  
   
    $editSql = "SELECT * FROM food_list WHERE `#` = ?"; 
    $stmt = $mysqli->prepare($editSql);
    $stmt->bind_param("i", $foodId); 
    $stmt->execute();
    $editResult = $stmt->get_result();
    $foodToEdit = $editResult->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_food'])) {
    $id = $_POST['id'];
    $food = $_POST['food'];
    $fat = $_POST['fat'];
    $carbs = $_POST['carbs'];
    $protein = $_POST['protein'];

    $updateSql = "UPDATE food_list SET Food = ?, Fat = ?, Carbohydrate = ?, Protein = ? WHERE `#` = ?"; 
    $updateStmt = $mysqli->prepare($updateSql);
    $updateStmt->bind_param("sdddi", $food, $fat, $carbs, $protein, $id);
    if ($updateStmt->execute()) {
        echo "Food item updated successfully.";
        header("Location: edit_food.php");
        exit;
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
    $updateStmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Food Item</title>
</head>
<body>
    <h1>Edit Food Item</h1>

    <form action="edit_food.php" method="post">
        <label for="food_id">Select Food:</label>
        <select name="food_id" id="foodSelect"> 
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = (isset($foodToEdit) && $foodToEdit['#'] == $row['#']) ? 'selected' : '';
                    echo "<option value='" . $row['#'] . "' $selected>" . htmlspecialchars($row['Food']) . "</option>";
                }
            }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" name="select_food" value="Select Food Item">
    </form>

    <?php if (isset($foodToEdit)): ?>
        <form action="edit_food.php" method="post">
            <input type="hidden" name="id" value="<?php echo $foodToEdit['#']; ?>">
            <br>
            <label for="food">Food Name:</label>
            <input type="text" id="food" name="food" value="<?php echo htmlspecialchars($foodToEdit['Food']); ?>" required><br>
            <br>
            <label for="fat">Fat (g):</label>
            <input type="number" id="fat" name="fat" value="<?php echo $foodToEdit['Fat']; ?>" required><br>
            <br>
            <label for="carbs">Carbohydrates (g):</label>
            <input type="number" id="carbs" name="carbs" value="<?php echo $foodToEdit['Carbohydrate']; ?>" required><br>
            <br>
            <label for="protein">Protein (g):</label>
            <input type="number" id="protein" name="protein" value="<?php echo $foodToEdit['Protein']; ?>" required><br>
            <br>
            <input type="submit" name="edit_food" value="Edit Food Item">
            <br>
            <br>
            <button><a href="index.php" style="cursor: default; color: black; text-decoration:none;">Back to Dash</a></button>
        </form>
    <?php endif; ?>
</body>
</html>


