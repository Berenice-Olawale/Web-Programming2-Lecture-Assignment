<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ReNew') | ReNew</title>

    <style>
        :root {
            --primary: #17365b;
            --primary-hover: #244d7b;
            --accent: #3976b9;
            --background: #f4f7fb;
            --surface: #ffffff;
            --text: #1d2939;
            --muted: #667085;
            --border: #e4eaf1;
            --radius: 14px;
            --shadow: 0 5px 20px rgba(23, 54, 91, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.65;
        }

        a {
            color: var(--accent);
        }

        .site-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 5%;
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            color: var(--primary);
            text-decoration: none;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .brand span {
            color: var(--accent);
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .main-nav a {
            color: var(--muted);
            text-decoration: none;
            padding: 9px 13px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }

        .main-nav a:hover,
        .main-nav a.active {
            background: #eaf1f9;
            color: var(--primary);
        }

        .page-container {
            width: 90%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 42px 0 64px;
            min-height: calc(100vh - 160px);
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h2 {
            color: var(--primary);
            font-size: clamp(28px, 4vw, 38px);
            line-height: 1.25;
            letter-spacing: -0.8px;
            margin-bottom: 10px;
        }

        .page-heading p {
            color: var(--muted);
            max-width: 720px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }

        .card h3 {
            color: var(--primary);
            font-size: 19px;
            margin-bottom: 16px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 13px 15px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        th {
            background: #edf3fa;
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fafd;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        
        .site-footer {
            background: var(--primary);
            color: #dce7f5;
            text-align: center;
            padding: 28px 5%;
            font-size: 13px;
        }

        .footer-title {
            font-weight: 600;
            margin-bottom: 16px;
        }

        .project-team {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
        }

.team-heading {
    color: #a9c8e8;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-size: 10px;
    font-weight: 800;
    margin-bottom: 3px;
}

.project-team p:not(.team-heading) {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
}

.project-team strong {
    color: white;
}

.project-team span {
    color: #c3d3e6;
}

@media (max-width: 500px) {
    .project-team p:not(.team-heading) {
        flex-direction: column;
        gap: 0;
    }
}


        @media (max-width: 700px) {
            .header-inner {
                padding: 14px 5%;
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .main-nav {
                gap: 4px;
            }

            .main-nav a {
                padding: 8px 10px;
            }

            .page-container {
                padding-top: 30px;
            }

            .card {
                padding: 17px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="{{ route('home') }}">
            Re<span>New</span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <a href="{{ route('home') }}"
               @class(['active' => request()->routeIs('home')])
               @if(request()->routeIs('home')) aria-current="page" @endif>
                Home
            </a>

            <a href="{{ route('database.index') }}"
               @class(['active' => request()->routeIs('database.*')])
               @if(request()->routeIs('database.*')) aria-current="page" @endif>
                Database
            </a>

            <a href="{{ route('graph.index') }}"
               @class(['active' => request()->routeIs('graph.*')])
               @if(request()->routeIs('graph.*')) aria-current="page" @endif>
                Graph
            </a>

            <a href="{{ url('/contact') }}">Contact</a>
        </nav>
    </div>
</header>

<main class="page-container">
    @yield('content')
</main>


<footer class="site-footer">
    <p class="footer-title">
        &copy; {{ date('Y') }} ReNew — Laptop Catalogue Project
    </p>

    <div class="project-team">
        <p class="team-heading">Project team</p>

        <p>
            <strong>Berenice Olawale</strong>
            <span>Neptun code: I4G9NE</span>
        </p>

        <p>
            <strong>Ben Zouitine Meriem</strong>
            <span>Neptun code: EA6MCH</span>
        </p>
    </div>
</footer>


@stack('scripts')

</body>
</html>
