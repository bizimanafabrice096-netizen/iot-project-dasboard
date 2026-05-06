<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 20");
$data = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Energy Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Energy</h1>
  <canvas id="energyChart"></canvas>
  <script>
    const labels = <?php echo json_encode(array_column($data, 'created_at')); ?>;
    const temp = <?php echo json_encode(array_column($data, 'temperature')); ?>;
    new Chart(document.getElementById('energyChart'), {
      type: 'line',
      data: { labels, datasets: [{ label: 'Temperature (°C)', data: temp, borderColor: 'red', fill: false }] }
    });
  </script>
</body>
</html>
