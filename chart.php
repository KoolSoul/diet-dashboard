<?php
include_once 'database.php';

$totalFat = 0;
$totalCarbs = 0;
$totalProtein = 0;

$sql = "SELECT * FROM today;";
$result = mysqli_query($mysqli, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $totalFat += $row['Fat'];
    $totalCarbs += $row['Carbohydrate'];
    $totalProtein += $row['Protein'];
}

$totalMacros = $totalFat + $totalCarbs + $totalProtein;
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Macronutrient', 'Percentage'],
                ['Fat', <?php echo ($totalFat / $totalMacros) * 100; ?>],
                ['Carbohydrates', <?php echo ($totalCarbs / $totalMacros) * 100; ?>],
                ['Protein', <?php echo ($totalProtein / $totalMacros) * 100; ?>]
            ]);

            var options = {
                title: 'Macronutrient Distribution',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>