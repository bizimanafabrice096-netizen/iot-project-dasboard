// Fetch last 20 rows for charts
fetch('api.php?type=recent')
  .then(res => res.json())
  .then(data => {
    // Temperature chart
    new Chart(document.getElementById('tempChart'), {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{ label: 'Temperature (°C)', data: data.temperature, borderColor: 'red', fill: false }]
      }
    });

    // Humidity chart
    new Chart(document.getElementById('humChart'), {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{ label: 'Humidity (%)', data: data.humidity, borderColor: 'blue', fill: false }]
      }
    });
    // Water chart
new Chart(document.getElementById('waterChart'), {
  type: 'line',
  data: {
    labels: data.labels,
    datasets: [{ label: 'Water (%)', data: data.water, borderColor: 'green', fill: false }]
  }
});

// Light chart
new Chart(document.getElementById('lightChart'), {
  type: 'line',
  data: {
    labels: data.labels,
    datasets: [{ label: 'Light (%)', data: data.light, borderColor: 'yellow', fill: false }]
  }
});


    // Gas chart
    new Chart(document.getElementById('gasChart'), {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{ label: 'Gas', data: data.gas, borderColor: 'orange', fill: false }]
      }
    });
  });

// Live status update
document.addEventListener("DOMContentLoaded", () => {
  const liveIndicator = document.querySelector(".live");
  if(liveIndicator){
    function updateLiveStatus() {
      const now = new Date();
      liveIndicator.textContent = `● Live • Updated at ${now.toLocaleTimeString()}`;
    }
    setInterval(updateLiveStatus, 30000);
  }
});
