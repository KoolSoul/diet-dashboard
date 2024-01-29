<?php
include_once 'database.php';

$totalFat = 0;
$totalCarbs = 0;
$totalProtein = 0;

$sql = "SELECT * FROM today;"; 
$result = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Today's Food List</title>

</head>
<body>

    <form action="remove_today.php" method="post">
        <table border="1">
            <tr>
                <th>Select</th>
                <th>Food</th>
                <th>Fat</th>
                <th>Carbohydrate</th>
                <th>Protein</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
               
                $totalFat += $row['Fat'];
                $totalCarbs += $row['Carbohydrate'];
                $totalProtein += $row['Protein'];

                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_items[]' value='" . $row['#'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['Food']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Fat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Carbohydrate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Protein']) . "</td>";
                echo "</tr>";
            }

            echo "<tr>
                    <th colspan='2'>Total</th>
                    <th>$totalFat g</th>
                    <th>$totalCarbs g</th>
                    <th>$totalProtein g</th>
                  </tr>";
            ?>
        </table>
        <br>
        <input type="submit" value="Remove from Today's List">
    </form>
</body>
</html>