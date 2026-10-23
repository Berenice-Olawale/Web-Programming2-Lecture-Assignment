@extends('layouts.app')

@section('title', 'Database')

@section('content')

<section class="page-heading">
    <p class="eyebrow">EXPLORE OUR DATA</p>
    <h2>Database Explorer</h2>
    <p>
        Explore notebook specifications, processor details,
        and available operating systems from our database.
    </p>
</section>

<section class="card database-section">
    <div class="section-title">
        <div>
            <p class="section-eyebrow">DEVICE CATALOGUE</p>
            <h3>Notebooks</h3>
        </div>
        <span class="count-badge">{{ $notebooks->count() }} records</span>
    </div>

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
                        <td><strong>{{ $notebook->manufacturer }}</strong></td>
                        <td>{{ $notebook->type }}</td>
                        <td>{{ $notebook->display }}</td>
                        <td>{{ $notebook->memory }}</td>
                        <td>{{ $notebook->harddisk }}</td>
                        <td>
                            {{ $notebook->processor?->manufacturer }}
                            {{ $notebook->processor?->type }}
                        </td>
                        <td>
                            {{ $notebook->operatingSystem?->name ?? 'Not specified' }}
                        </td>
                        <td class="price-cell">
                            {{ number_format((float) $notebook->price, 0, ',', ' ') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-cell">No notebooks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="card database-section">
    <div class="section-title">
        <div>
            <p class="section-eyebrow">HARDWARE COMPONENTS</p>
            <h3>Processors</h3>
        </div>
        <span class="count-badge">{{ $processors->count() }} records</span>
    </div>

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
                        <td><strong>{{ $processor->manufacturer }}</strong></td>
                        <td>{{ $processor->type }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-cell">No processors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="card database-section">
    <div class="section-title">
        <div>
            <p class="section-eyebrow">SOFTWARE INFORMATION</p>
            <h3>Operating Systems</h3>
        </div>
        <span class="count-badge">{{ $operatingSystems->count() }} records</span>
    </div>

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
                        <td><strong>{{ $system->name }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty-cell">No operating systems found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

@endsection

@push('styles')
<style>
    .eyebrow {
        color: var(--accent);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.7px;
        margin-bottom: 8px;
    }

    .database-section {
        margin-bottom: 26px;
        padding: 0;
        overflow: hidden;
    }

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 23px 24px;
        border-bottom: 1px solid var(--border);
    }

    .section-title h3 {
        margin: 0;
        font-size: 20px;
    }

    .section-eyebrow {
        color: var(--muted);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.3px;
        margin-bottom: 4px;
    }

    .count-badge {
        flex-shrink: 0;
        background: #eaf1f9;
        color: var(--primary);
        border-radius: 20px;
        padding: 6px 11px;
        font-size: 12px;
        font-weight: 700;
    }

    .database-section .table-wrapper {
        padding: 0 12px 8px;
    }

    .database-section table {
        min-width: 650px;
    }

    .database-section th {
        font-size: 12px;
    }

    .database-section td {
        font-size: 13px;
    }

    .price-cell {
        color: var(--accent);
        font-weight: 700;
        white-space: nowrap;
    }

    .empty-cell {
        color: var(--muted);
        text-align: center;
        padding: 25px;
    }

    @media (max-width: 600px) {
        .section-title {
            padding: 18px;
        }

        .database-section .table-wrapper {
            padding-left: 8px;
            padding-right: 8px;
        }
    }
</style>
@endpush
