<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReNew | Laptop Catalogue</title>

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
            gap: 22px;
            flex-wrap: wrap;
        }

        nav a {
            color: white;
            text-decoration: none;
        }

        .hero {
            background: #e3edf8;
            padding: 55px 7%;
        }

        .hero h2 {
            font-size: clamp(30px, 5vw, 46px);
            max-width: 650px;
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .hero p {
            max-width: 600px;
            color: #475467;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 28px 7%;
        }

        .stat, .laptop-card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #142d4e0d;
        }

        .stat strong {
            display: block;
            font-size: 28px;
            color: #2463a6;
        }

        .catalogue {
            padding: 20px 7% 60px;
        }

        .catalogue h2 {
            margin-bottom: 20px;
        }

        .laptop-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .laptop-card h3 {
            font-size: 19px;
            margin-bottom: 10px;
        }

        .spec {
            color: #667085;
            font-size: 14px;
            margin: 5px 0;
            overflow-wrap: anywhere;
        }

        .price {
            font-size: 21px;
            font-weight: bold;
            color: #2463a6;
            margin-top: 15px;
        }

        footer {
            padding: 25px 7%;
            text-align: center;
            background: #142d4e;
            color: white;
        }

        @media (max-width: 850px) {
            .laptop-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 560px) {
            .stats, .laptop-grid {
                grid-template-columns: 1fr;
            }

            header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>ReNew</h1>

    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="#catalogue">Laptops</a>
        <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/login') }}">Login</a>
    </nav>
</header>

<section class="hero">
    <h2>Find your next laptop with ReNew.</h2>
    <p>
        Explore our notebook catalogue and compare specifications,
        processors, operating systems, and prices.
    </p>
</section>

<section class="stats">
    <div class="stat">
        <strong>{{ $notebookCount }}</strong>
        <span>Notebooks listed</span>
    </div>

    <div class="stat">
        <strong>{{ $processorCount }}</strong>
        <span>Processor types</span>
    </div>

    <div class="stat">
        <strong>{{ $operatingSystemCount }}</strong>
        <span>Operating systems</span>
    </div>
</section>

<main class="catalogue" id="catalogue">
    <h2>Explore our laptops</h2>

    <div class="laptop-grid">
        @forelse ($notebooks as $notebook)
            <article class="laptop-card">
                <h3>
                    {{ $notebook->manufacturer }}
                    {{ $notebook->type }}
                </h3>

                <p class="spec">
                    <strong>Display:</strong>
                    {{ $notebook->display }}
                </p>

                <p class="spec">
                    <strong>Memory:</strong>
                    {{ $notebook->memory }} MB
                </p>

                <p class="spec">
                    <strong>Storage:</strong>
                    {{ $notebook->harddisk }} GB
                </p>

                <p class="spec">
                    <strong>Graphics:</strong>
                    {{ $notebook->videocontroller }}
                </p>

                <p class="spec">
                    <strong>Processor:</strong>
                    {{ $notebook->processor?->manufacturer }}
                    {{ $notebook->processor?->type }}
                </p>

                <p class="spec">
                    <strong>Operating system:</strong>
                    {{ $notebook->operatingSystem?->name }}
                </p>

                <p class="price">
                    {{ number_format((float) $notebook->price, 0, ',', ' ') }} Ft
                </p>
            </article>
        @empty
            <p>No laptops are available yet. Please check back soon.</p>
        @endforelse
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} ReNew. Laptop catalogue project.</p>
</footer>

</body>
</html>
