<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 20");
$data = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Maintenance Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Maintenance</h1>
  <canvas id="maintChart"></canvas>
  <script>
    const labels = <?php echo json_encode(array_column($data, 'created_at')); ?>;
    const water = <?php echo json_encode(array_column($data, 'water')); ?>;
    new Chart(document.getElementById('maintChart'), {
      type: 'line',
      data: { labels, datasets: [{ label: 'Water (%)', data: water, borderColor: 'green', fill: false }] }
    });
  </script>
</body>

</html>
