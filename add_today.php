<?php
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_items'])) {
    foreach ($_POST['selected_items'] as $itemId) {
        $insertSql = "INSERT INTO today (Food, Fat, Carbohydrate, Protein) SELECT Food, Fat, Carbohydrate, Protein FROM food_list WHERE `#` = ?";
        $stmt = $mysqli->prepare($insertSql);
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
    }

    echo "Selected items added to today's list.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add to Today's List</title>
</head>
<body>
    <h1>Add to Today's List</h1>

    <form action="add_today.php" method="post">
        <table border="1">
            <tr>
                <th>Select</th>
                <th>Food</th>
                <th>Fat</th>
                <th>Carbohydrate</th>
                <th>Protein</th>
            </tr>
            <?php
            $sql = "SELECT * FROM food_list;";
            $result = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_items[]' value='" . $row['#'] . "'></td>"; 
                echo "<td>" . htmlspecialchars($row['Food']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Fat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Carbohydrate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Protein']) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Add to Today's List">
    </form>
    <br>
    <button><a href="index.php" style="cursor: default; color: black; text-decoration:none;">Back to Dash</a></button>
</body>
</html>