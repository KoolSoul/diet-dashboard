<?php
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['selected_items'])) {
    
    $placeholders = implode(',', array_fill(0, count($_POST['selected_items']), '?'));
    $sql = "DELETE FROM today WHERE `#` IN ($placeholders)"; 
    $stmt = $mysqli->prepare($sql);

    $types = str_repeat('i', count($_POST['selected_items']));
    $stmt->bind_param($types, ...$_POST['selected_items']);

    if ($stmt->execute()) {
        echo "Selected items removed successfully.";
    } else {
        echo "Error removing items: " . $mysqli->error;
    }

    $stmt->close();
} else {
    echo "No items selected for removal.";
}

header("Location: index.php");
exit;
?>
