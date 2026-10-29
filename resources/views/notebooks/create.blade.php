@extends('layouts.app')

@section('title', 'Add Notebook')

@section('content')

<section class="page-heading">
    <p class="eyebrow">ADMIN</p>
    <h2>Add notebook</h2>
</section>

<section class="card crud-form-card">
    <form action="{{ route('notebooks.store') }}" method="POST">
        @csrf

        @include('notebooks._form', ['notebook' => null])
    </form>
</section>

@endsection