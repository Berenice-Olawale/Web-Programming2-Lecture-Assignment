<x-mainpage title="React">

<section class="page-heading">
    <h2>React CRUD – Notebooks</h2>
    <p>
        This page is a React application (built with Vite) that uses Axios
        to read and change the notebooks stored in a separate SQLite database file.
    </p>
</section>

<div id="react-root"></div>

@push('styles')
<style>
    .react-form {
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    .react-form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .react-form input,
    .react-form select {
        width: 100%;
        padding: 10px 12px;
        font: inherit;
        border: 1px solid var(--border);
        border-radius: 8px;
        background: #ffffff;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .row-actions {
        display: flex;
        gap: 8px;
        white-space: nowrap;
    }

    .record-count {
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
        cursor: pointer;
    }

    .btn:hover {
        background: var(--primary-hover);
    }

    .btn-small {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-grey {
        background: #667085;
    }

    .btn-danger {
        background: #b42318;
    }

    .field-error {
        color: #b42318;
        font-size: 14px;
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

@push('scripts')
    @vite('resources/js/react-crud/main.tsx')
@endpush

</x-mainpage>