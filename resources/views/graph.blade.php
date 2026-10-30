<x-mainpage title="Home">

<section class="page-heading">
    <p class="eyebrow">DATA VISUALIZATION</p>
    <h2>Notebook Statistics</h2>
    <p>
        Explore the number of notebooks listed for each manufacturer.
        This interactive chart is generated directly from our database.
    </p>
</section>

<section class="card chart-card">
    <div class="chart-heading">
        <div>
            <p class="section-eyebrow">CATALOGUE ANALYTICS</p>
            <h3>Notebooks by Manufacturer</h3>
            <p class="chart-description">
                Compare how many notebook models are recorded for each manufacturer.
            </p>
        </div>

        <div class="chart-total">
            <span>Total notebook models</span>
            <strong>{{ $notebooksByManufacturer->sum('total') }}</strong>
        </div>
    </div>

    <div class="chart-container">
        <canvas
            id="manufacturerChart"
            role="img"
            aria-label="Bar chart showing notebook counts by manufacturer">
            Your browser does not support the canvas element.
        </canvas>
    </div>

    <p class="chart-note">
        <span class="note-dot"></span>
        Data source: ReNew notebook database
    </p>
</section>



@push('styles')
<style>
    .eyebrow {
        color: var(--accent);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
        margin-bottom: 8px;
    }

    .chart-card {
        padding: 0;
        overflow: hidden;
    }

    .chart-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        padding: 26px 28px;
        border-bottom: 1px solid var(--border);
    }

    .section-eyebrow {
        color: var(--muted);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.3px;
        margin-bottom: 5px;
    }

    .chart-heading h3 {
        margin-bottom: 6px;
        font-size: 21px;
    }

    .chart-description {
        color: var(--muted);
        font-size: 13px;
    }

    .chart-total {
        flex-shrink: 0;
        min-width: 150px;
        padding: 14px 17px;
        border-radius: 10px;
        background: #eaf1f9;
    }

    .chart-total span {
        display: block;
        color: var(--muted);
        font-size: 11px;
        margin-bottom: 4px;
    }

    .chart-total strong {
        color: var(--primary);
        font-size: 29px;
        line-height: 1.3;
    }

    .chart-container {
        position: relative;
        width: 100%;
        height: 420px;
        padding: 26px 28px 20px;
    }

    .chart-note {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted);
        font-size: 12px;
        padding: 0 28px 22px;
    }

    .note-dot {
        width: 8px;
        height: 8px;
        flex-shrink: 0;
        background: #3976b9;
        border-radius: 50%;
    }

    @media (max-width: 650px) {
        .chart-heading {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
            gap: 18px;
        }

        .chart-total {
            width: 100%;
        }

        .chart-container {
            height: 340px;
            padding: 20px 12px;
        }

        .chart-note {
            padding: 0 20px 20px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const manufacturers = @json(
        $notebooksByManufacturer->pluck('manufacturer')->values()
    );

    const notebookCounts = @json(
        $notebooksByManufacturer->pluck('total')->values()
    );

    const canvas = document.getElementById('manufacturerChart');

    if (canvas) {
        new Chart(canvas, {
            type: 'bar',

            data: {
                labels: manufacturers,

                datasets: [{
                    label: 'Number of notebooks',
                    data: notebookCounts,
                    backgroundColor: 'rgba(57, 118, 185, 0.78)',
                    borderColor: 'rgba(23, 54, 91, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                    maxBarThickness: 58
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRounded',
                            padding: 20
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Notebooks: ' + context.parsed.y;
                            }
                        }
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Number of notebooks'
                        },
                        grid: {
                            color: '#edf1f6'
                        }
                    },

                    x: {
                        title: {
                            display: true,
                            text: 'Manufacturer'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
</x-mainpage>