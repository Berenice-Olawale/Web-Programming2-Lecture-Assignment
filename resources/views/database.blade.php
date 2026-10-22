<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReNew | Database</title>

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
            max-width: 1400px;
            margin: auto;
            padding: 35px 5%;
        }

        .intro {
            margin-bottom: 30px;
        }

        .intro h2 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .intro p {
            color: #667085;
        }

        .section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 28px;
            box-shadow: 0 3px 12px #142d4e0d;
        }

        .section h3 {
            margin-bottom: 16px;
            font-size: 22px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eaecf0;
        }

        th {
            background: #eaf1f9;
            color: #142d4e;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        footer {
            background: #142d4e;
            color: white;
            text-align: center;
            padding: 22px;
        }

        @media (max-width: 600px) {
            .section {
                padding: 16px;
            }

            .intro h2 {
                font-size: 26px;
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
        <a href="{{ url('/graph') }}">Graph</a>
        <a href="{{ url('/contact') }}">Contact</a>
    </nav>
</header>

<main>
    <section class="intro">
        <h2>Database Explorer</h2>
        <p>
            Explore notebook specifications, processor details,
            and available operating systems from our database.
        </p>
    </section>

    <section class="section">
        <h3>Notebooks ({{ $notebooks->count() }})</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Manufacturer</th>
                        <th>Model</th>
                        <th>Display</th>
                        <th>Memory (MB)</th>
                        <th>Storage (GB)</th>
                        <th>Processor</th>
                        <th>Operating System</th>
                        <th>Price (Ft)</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($notebooks as $notebook)
                        <tr>
                            <td>{{ $notebook->manufacturer }}</td>
                            <td>{{ $notebook->type }}</td>
                            <td>{{ $notebook->display }}</td>
                            <td>{{ $notebook->memory }}</td>
                            <td>{{ $notebook->harddisk }}</td>
                            <td>
                                {{ $notebook->processor?->manufacturer }}
                                {{ $notebook->processor?->type }}
                            </td>
                            <td>
                                {{ $notebook->operatingSystem?->name }}
                            </td>
                            <td>
                                {{ number_format((float) $notebook->price, 0, ',', ' ') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No notebooks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <h3>Processors ({{ $processors->count() }})</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Manufacturer</th>
                        <th>Processor type</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($processors as $processor)
                        <tr>
                            <td>{{ $processor->id }}</td>
                            <td>{{ $processor->manufacturer }}</td>
                            <td>{{ $processor->type }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No processors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <h3>Operating Systems ({{ $operatingSystems->count() }})</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($operatingSystems as $system)
                        <tr>
                            <td>{{ $system->id }}</td>
                            <td>{{ $system->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No operating systems found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

<footer>
    <p>&copy; {{ date('Y') }} ReNew. Laptop catalogue project.</p>
</footer>

</body>
</html>
