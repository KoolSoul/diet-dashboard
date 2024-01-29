<?php
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food = mysqli_real_escape_string($mysqli, $_POST['food']);
    $fat = mysqli_real_escape_string($mysqli, $_POST['fat']);
    $carbs = mysqli_real_escape_string($mysqli, $_POST['carbs']);
    $protein = mysqli_real_escape_string($mysqli, $_POST['protein']);

    $sql = "INSERT INTO food_list (Food, Fat, Carbohydrate, Protein) VALUES ('$food', '$fat', '$carbs', '$protein')";

    if (mysqli_query($mysqli, $sql)) {
        echo "New food item added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Food Item</title>

</head>
<body>
    <h1>Add New Food Item</h1>
    <form action="add_food.php" method="post">
        <label for="food">Food Name:</label>
        <input type="text" id="food" name="food" required><br>
        <br>
        <label for="fat">Fat (g):</label>
        <input type="number" id="fat" name="fat" step="0.01" required><br>
        <br>
        <label for="carbs">Carbohydrates (g):</label>
        <input type="number" id="carbs" name="carbs" step="0.01" required><br>
        <br>
        <label for="protein">Protein (g):</label>
        <input type="number" id="protein" name="protein" step="0.01" required><br>
        <br>
        <input type="submit" value="Add Food Item">
    </form>
    <br>
    <button onclick="window.location.href='index.php';">Back to Home</button>

</body>
</html>