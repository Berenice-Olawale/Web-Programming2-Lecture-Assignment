<x-mainpage title="Home">

<section class="hero">
    <div class="hero-content">
        <p class="eyebrow">YOUR NOTEBOOK CATALOGUE</p>

        <h2>Find the right laptop for your next idea.</h2>

        <p class="hero-description">
            Explore notebook specifications, compare hardware,
            and discover the processors and operating systems
            behind each device.
        </p>

        <a href="#catalogue" class="hero-button">
            Explore notebooks &rarr;
        </a>
    </div>
</section>

<section class="stats-grid" aria-label="Database statistics">
    <article class="stat-card">
        <span class="stat-label">Notebooks</span>
        <strong>{{ $notebookCount }}</strong>
        <span class="stat-description">Listed in our catalogue</span>
    </article>

    <article class="stat-card">
        <span class="stat-label">Processors</span>
        <strong>{{ $processorCount }}</strong>
        <span class="stat-description">Available in the database</span>
    </article>

    <article class="stat-card">
        <span class="stat-label">Operating systems</span>
        <strong>{{ $operatingSystemCount }}</strong>
        <span class="stat-description">Recorded in our database</span>
    </article>
</section>

<section id="catalogue" class="catalogue-section">
    <div class="section-heading">
        <div>
            <p class="eyebrow">BROWSE THE COLLECTION</p>
            <h2>Explore our notebooks</h2>
        </div>

        <a href="{{ route('database.index') }}" class="text-link">
            View database &rarr;
        </a>
    </div>

    <div class="laptop-grid">
        @forelse ($notebooks as $notebook)
            <article class="laptop-card">
                <div class="laptop-card-top">
                    <span class="device-label">NOTEBOOK</span>
                    <span class="device-id">
                        #{{ $notebook->id }}
                    </span>
                </div>

                <h3>
                    {{ $notebook->manufacturer }}
                    {{ $notebook->type }}
                </h3>

                <p class="laptop-subtitle">
                    {{ $notebook->processor?->manufacturer }}
                    {{ $notebook->processor?->type }}
                </p>

                <div class="spec-list">
                    <div class="spec-row">
                        <span>Display</span>
                        <strong>{{ $notebook->display }}</strong>
                    </div>

                    <div class="spec-row">
                        <span>Memory</span>
                        <strong>{{ $notebook->memory }} MB</strong>
                    </div>

                    <div class="spec-row">
                        <span>Storage</span>
                        <strong>{{ $notebook->harddisk }} GB</strong>
                    </div>

                    <div class="spec-row">
                        <span>Operating system</span>
                        <strong>
                            {{ $notebook->operatingSystem?->name ?? 'Not specified' }}
                        </strong>
                    </div>
                </div>

                <div class="price-row">
                    <span>Listed price</span>
                    <strong>
                        {{ number_format((float) $notebook->price, 0, ',', ' ') }}
                        Ft
                    </strong>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <h3>No notebooks found</h3>
                <p>There are currently no notebooks in the catalogue.</p>
            </div>
        @endforelse
    </div>
</section>


@push('styles')
<style>
    .hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(120deg, #17365b, #285b8c);
        color: white;
        padding: clamp(32px, 6vw, 66px);
        border-radius: 20px;
        margin-bottom: 28px;
    }

    .hero::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border: 1px solid rgba(255,255,255,.14);
        border-radius: 50%;
        right: -60px;
        bottom: -130px;
        box-shadow: 0 0 0 35px rgba(255,255,255,.04),
                    0 0 0 70px rgba(255,255,255,.03);
        pointer-events: none;
    }

    .hero-content {
        max-width: 700px;
        position: relative;
        z-index: 1;
    }

    .eyebrow {
        color: #6395ca;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
        margin-bottom: 10px;
    }

    .hero .eyebrow {
        color: #c4ddf7;
    }

    .hero h2 {
        font-size: clamp(32px, 5vw, 49px);
        line-height: 1.15;
        letter-spacing: -1.4px;
        margin-bottom: 18px;
        max-width: 650px;
    }

    .hero-description {
        max-width: 580px;
        color: #e0eaf5;
        font-size: 16px;
        margin-bottom: 26px;
    }

    .hero-button {
        display: inline-block;
        background: white;
        color: #17365b;
        text-decoration: none;
        padding: 12px 19px;
        border-radius: 9px;
        font-weight: 700;
        font-size: 14px;
        transition: transform .2s, background .2s;
    }

    .hero-button:hover {
        background: #edf4fc;
        transform: translateY(-2px);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 48px;
    }

    .stat-card {
        background: white;
        padding: 22px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
    }

    .stat-label, .stat-description {
        display: block;
    }

    .stat-label {
        color: var(--muted);
        font-size: 13px;
        font-weight: 600;
    }

    .stat-card strong {
        display: block;
        color: var(--primary);
        font-size: 34px;
        line-height: 1.4;
        margin: 5px 0;
    }

    .stat-description {
        color: var(--muted);
        font-size: 12px;
    }

    .section-heading {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 20px;
        margin-bottom: 22px;
    }

    .section-heading h2 {
        color: var(--primary);
        font-size: clamp(24px, 3vw, 30px);
        letter-spacing: -.5px;
    }

    .text-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
        margin-bottom: 5px;
    }

    .text-link:hover {
        text-decoration: underline;
    }

    .laptop-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .laptop-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 22px;
        box-shadow: var(--shadow);
        transition: transform .2s, box-shadow .2s;
        min-width: 0;
    }

    .laptop-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(23,54,91,.10);
    }

    .laptop-card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .device-label {
        background: #eaf1f9;
        color: var(--primary);
        border-radius: 5px;
        padding: 4px 8px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .device-id {
        color: #98a2b3;
        font-size: 12px;
    }

    .laptop-card h3 {
        color: var(--primary);
        font-size: 19px;
        line-height: 1.4;
        overflow-wrap: anywhere;
        margin-bottom: 5px;
    }

    .laptop-subtitle {
        min-height: 24px;
        color: var(--muted);
        font-size: 12px;
        overflow-wrap: anywhere;
        margin-bottom: 20px;
    }

    .spec-list {
        border-top: 1px solid var(--border);
    }

    .spec-row {
        display: flex;
        justify-content: space-between;
        align-items: start;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #eef1f5;
        font-size: 12px;
    }

    .spec-row span {
        color: var(--muted);
        flex-shrink: 0;
    }

    .spec-row strong {
        text-align: right;
        overflow-wrap: anywhere;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
        padding-top: 16px;
    }

    .price-row span {
        color: var(--muted);
        font-size: 12px;
    }

    .price-row strong {
        color: var(--accent);
        font-size: 20px;
    }

    .empty-state {
        grid-column: 1 / -1;
        background: white;
        padding: 35px;
        border-radius: var(--radius);
        text-align: center;
    }

    .empty-state p {
        color: var(--muted);
    }

    @media (max-width: 950px) {
        .laptop-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 620px) {
        .stats-grid, .laptop-grid {
            grid-template-columns: 1fr;
        }

        .section-heading {
            align-items: start;
            flex-direction: column;
            gap: 8px;
        }

        .hero {
            border-radius: 14px;
        }
    }
</style>
@endpush
</x-mainpage>
