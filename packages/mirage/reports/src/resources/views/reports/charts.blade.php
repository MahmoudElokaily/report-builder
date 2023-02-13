<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        canvas {
            padding: 0;
            margin: auto;
            display: block;
            width: 800px;
            height: 600px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
    <title>Charts</title>
</head>
<body>
<h1>{{$title}} Charts</h1>

<div>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: '<?php echo $type ?>',
        data: {
            labels: <?php echo $labels ?>,
            datasets: [{
                label: '<?php echo $title ?> Chart',
                data: <?php echo $chartData ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
