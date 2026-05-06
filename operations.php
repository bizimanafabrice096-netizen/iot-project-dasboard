<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 20");
$data = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Operations Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Operations</h1>
  <canvas id="opsChart"></canvas>
  <script>
    const labels = <?php echo json_encode(array_column($data, 'created_at')); ?>;
    const gas = <?php echo json_encode(array_column($data, 'gas')); ?>;
    new Chart(document.getElementById('opsChart'), {
      type: 'line',
      data: { labels, datasets: [{ label: 'Gas Levels', data: gas, borderColor: 'orange', fill: false }] }
    });
  </script>
</body>
</html>
