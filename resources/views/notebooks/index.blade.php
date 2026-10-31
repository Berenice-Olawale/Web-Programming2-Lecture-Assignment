@extends('layouts.app')

@section('title', 'Manage Notebooks')

@section('content')

<section class="page-heading">
    <p class="eyebrow">ADMIN</p>
    <h2>Manage Notebooks</h2>
    <p>Add, edit or delete notebooks in the catalogue.</p>
</section>

<section class="card">
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="crud-toolbar">
        <span class="crud-count">{{ $notebooks->count() }} records</span>
        <a href="{{ route('notebooks.create') }}" class="btn">+ Add notebook</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Manufacturer</th>
                    <th>Model</th>
                    <th>Display</th>
                    <th>Memory (MB)</th>
                    <th>Storage (GB)</th>
                    <th>Processor</th>
                    <th>Operating System</th>
                    <th>Price (Ft)</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notebooks as $notebook)
                    <tr>
                        <td>{{ $notebook->id }}</td>
                        <td><strong>{{ $notebook->manufacturer }}</strong></td>
                        <td>{{ $notebook->type }}</td>
                        <td>{{ $notebook->display }}</td>
                        <td>{{ $notebook->memory }}</td>
                        <td>{{ $notebook->harddisk }}</td>
                        <td>
                            {{ $notebook->processor?->manufacturer }}
                            {{ $notebook->processor?->type }}
                        </td>
                        <td>{{ $notebook->operatingSystem?->name ?? 'Not specified' }}</td>
                        <td>{{ number_format((float) $notebook->price, 0, ',', ' ') }}</td>
                        <td>{{ $notebook->pieces }}</td>
                        <td class="crud-actions">
                            <a href="{{ route('notebooks.edit', $notebook) }}" class="btn btn-small">Edit</a>

                            <form action="{{ route('notebooks.destroy', $notebook) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this notebook?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">No notebooks found.</td>
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

    .crud-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .crud-count {
        color: var(--muted);
        font-size: 14px;
    }

    .btn {
        display: inline-block;
        padding: 10px 18px;
        font: inherit;
        font-size: 14px;
        color: #ffffff;
        background: var(--primary);
        border: 0;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn:hover {
        background: var(--primary-hover);
    }

    .btn-small {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-danger {
        background: #b42318;
    }

    .btn-danger:hover {
        background: #912018;
    }

    .crud-actions {
        display: flex;
        gap: 8px;
        white-space: nowrap;
    }

    .alert-success {
        background: #e7f6ec;
        color: #1e6b2e;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 16px;
    }
</style>
@endpush