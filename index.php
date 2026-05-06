<?php
// Connect to MariaDB
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest sensor data for KPI cards
$res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 1");
$metrics = $res ? $res->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Industrial IoT Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- Top Navigation -->
  <nav class="topnav">
    <ul class="tabs">
      <a href="index.php"><li class="active">Overview</li></a>
      <a href="operations.php"><li>Gas Level</li></a>
      <a href="maintenance.php"><li>Water Level</li></a>
      
      <a href="energy.php"><li>temperature</li></a>
      <a href="quality_safety.php"><li>humidiy</li></a>
    </ul>
    <div class="topnav-right">
      <span class="live">● Live • Updated Just now</span>
      <input type="text" placeholder="Search..." class="search">
      <button class="icon">🔔<span class="badge">3</span></button>
      <button class="icon">⬇️</button>
    </div>
  </nav>

  <!-- KPI Cards -->
  <main class="grid">
    <div class="card green"><h2>Temperature</h2><p><?php echo $metrics ? $metrics["temperature"]." °C" : "No data"; ?></p></div>
    <div class="card blue"><h2>Humidity</h2><p><?php echo $metrics ? $metrics["humidity"]." %" : "No data"; ?></p></div>
    <div class="card orange"><h2>Gas</h2><p><?php echo $metrics ? $metrics["gas"] : "No data"; ?></p></div>
    <div class="card purple"><h2>Water</h2><p><?php echo $metrics ? $metrics["water"]." %" : "No data"; ?></p></div>
    <div class="card red"><h2>Light</h2><p><?php echo $metrics ? $metrics["light"]." %" : "No data"; ?></p></div>
  </main>

  <!-- Dashboard Panels -->
  <div class="dashboard">
    <div class="panel"><h2>Temperature Trend</h2><canvas id="tempChart"></canvas></div>
    <div class="panel"><h2>Humidity Trend</h2><canvas id="humChart"></canvas></div>
    <div class="panel"><h2>Gas Levels</h2><canvas id="gasChart"></canvas></div>
    <div class="panel"><h2>Water Levels</h2><canvas id="waterChart"></canvas></div>
    <!-- <div class="panel"><h2>Utilization</h2><canvas id="utilChart"></canvas></div> -->

<div class="panel"><h2>Light Levels</h2><canvas id="lightChart"></canvas></div>

  </div>

  <script src="script.js"></script>
</body>
</html>
