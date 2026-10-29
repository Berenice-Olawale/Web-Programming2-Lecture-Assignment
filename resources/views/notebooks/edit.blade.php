@extends('layouts.app')

@section('title', 'Edit Notebook')

@section('content')

<section class="page-heading">
    <p class="eyebrow">ADMIN</p>
    <h2>Edit notebook</h2>
</section>

<section class="card crud-form-card">
    <form action="{{ route('notebooks.update', $notebook) }}" method="POST">
        @csrf
        @method('PUT')

        @include('notebooks._form')
    </form>
</section>

@endsection