<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 20");
$data = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Utilization Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Utilization</h1>
  <canvas id="utilChart"></canvas>

  <script>
    const labels = <?php echo json_encode(array_column($data, 'created_at')); ?>;
    const light = <?php echo json_encode(array_column($data, 'light')); ?>;

    if (labels.length === 0) {
      document.body.insertAdjacentHTML("beforeend", "<p>No data available in table.</p>");
    } else {
      new Chart(document.getElementById('utilChart'), {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Light (%)',
            data: light,
            borderColor: 'yellow',
            fill: false
          }]
        }
      });
    }
  </script>
</body>
</html>
