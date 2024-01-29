<?php
include_once 'database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM food_list;";
$result = mysqli_query($mysqli, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Food</th>
            <th>Fat</th>
            <th>Carbohydrate</th>
            <th>Protein</th>
          </tr>";

    
    while ($food = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($food['Food']) . "</td>";
        echo "<td>" . htmlspecialchars($food['Fat']) . "</td>";
        echo "<td>" . htmlspecialchars($food['Carbohydrate']) . "</td>";
        echo "<td>" . htmlspecialchars($food['Protein']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";


    
    echo "<br><a href='add_food.php'><button>Add New Food Item</button></a><br><br>";

    echo "<br><a href='edit_food.php'><button>Edit Food Item</button></a><br><br>";
    
    echo "<br><a href='delete_food.php'><button>Delete Food Item</button></a><br><br>";

    echo "<br><a href='add_today.php'><button>Add to today's list</button></a><br><br>";

} else {
    echo "No food items found.";
}
?>