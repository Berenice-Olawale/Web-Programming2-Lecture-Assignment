<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReNew | Graph</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #1d2939;
            line-height: 1.6;
        }

        header {
            background: #142d4e;
            color: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        header h1 {
            font-size: 27px;
        }

        nav {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 6%;
        }

        .intro {
            margin-bottom: 28px;
        }

        .intro h2 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .intro p {
            color: #667085;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #142d4e0d;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 420px;
        }

        footer {
            background: #142d4e;
            color: white;
            text-align: center;
            padding: 22px;
        }

        @media (max-width: 600px) {
            main {
                padding: 28px 4%;
            }

            .intro h2 {
                font-size: 26px;
            }

            .chart-card {
                padding: 15px;
            }

            .chart-container {
                height: 350px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>ReNew</h1>

    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('database.index') }}">Database</a>
        <a href="{{ route('graph.index') }}">Graph</a>
        <a href="{{ url('/contact') }}">Contact</a>
    </nav>
</header>

<main>
    <section class="intro">
        <h2>Notebook Statistics</h2>
        <p>
            Explore the number of notebooks listed for each manufacturer.
            The chart is generated from our database.
        </p>
    </section>

    <section class="chart-card">
        <h3>Notebooks by Manufacturer</h3>

        <div class="chart-container">
            <canvas id="manufacturerChart"
                    role="img"
                    aria-label="Bar chart showing notebook counts by manufacturer">
                Your browser does not support the canvas element.
            </canvas>
        </div>
    </section>
</main>

<footer>
    <p>&copy; {{ date('Y') }} ReNew. Laptop catalogue project.</p>
</footer>

<script>
    const manufacturers = @json(
        $notebooksByManufacturer->pluck('manufacturer')->values()
    );

    const notebookCounts = @json(
        $notebooksByManufacturer->pluck('total')->values()
    );

    const canvas = document.getElementById('manufacturerChart');

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels: manufacturers,

            datasets: [{
                label: 'Number of notebooks',
                data: notebookCounts,
                backgroundColor: 'rgba(36, 99, 166, 0.75)',
                borderColor: 'rgba(20, 45, 78, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Number of notebooks'
                    }
                },

                x: {
                    title: {
                        display: true,
                        text: 'Manufacturer'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
